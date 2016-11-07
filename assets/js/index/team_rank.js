/**
 * Created by a1exlism on 16-11-3.
 */
$(function () {
	var startTime = new Date('2016-11-15 08:00:00').getTime();
	
	function getTimeLine() {
		function prefixZero(x) {
			if (x.length == 1) {
				return '0' + x;
			} else {
				return x;
			}
		}
		
		var d = new Date();
		var timeObj = {
			'month': prefixZero(d.getMonth() + 1),
			'date': prefixZero(d.getDate()),
			'hours': prefixZero(d.getHours()),
			'minutes': prefixZero(d.getMinutes())
		};
		return (timeObj.month + '-' + timeObj.date + ' ' + timeObj.hours + ':' + timeObj.minutes).toString();
	}
	
	var rankChart = echarts.init($('#rank-chart')[0]);
	var option = {
		backgroundColor: '#333',
		textStyle: {
			color: 'rgba(255, 255, 255, .8)'
		},
		color: ['#3cba54', '#f4c20d', '#db3236', '#4885ed', '#74AFAD', '#E44424', '#F6F6F6', '#C1E1A6', '#DF3D82', '#7045B5'],
		title: {
			text: 'Team Ranking',
			textStyle: {
				color: '#fff'
			},
			padding: [
				5,  // 上
				10,
				5,
				10
			]
		},
		tooltip: {
			trigger: 'axis',
			axisPointer: {
				lineStyle: {
					color: 'rgba(255, 255, 255, 0.6)',
					width: 1,
					opacity: .7
				}
			}
		},
		legend: {
			textStyle: {
				color: '#fff'
			},
			inactiveColor: '#aaa'
			// inactiveColor: '#aaa',
			// data: ['Team 1', 'Team 2', 'Team 3', 'Team 4', 'Team 5', 'Team 6', 'Team 7', 'Team 8', 'Team 9', 'Team 10']
			
			//  team names
		},
		grid: {
			left: '3%',
			right: '4%',
			bottom: '3%',
			containLabel: true
		},
		xAxis: {
			axisLine: {
				lineStyle: {
					color: '#eee'
				}
			},
			boundaryGap: false, //从0开始
			type: 'category',
			data: [getTimeLine()]
			
			//  update time
		},
		yAxis: {
			axisLine: {
				lineStyle: {
					color: '#aaa'
				}
			},
			splitLine: {
				lineStyle: {
					color: 'rgba(255, 255, 255, 0.6)'
				}
			},
			type: 'value'
		}
		// },
		// series: [
		// 	{
		// 		name: 'Team 1',
		// 		type: 'line',
		// 		step: 'start',
		// 		data: [120, 132, 77, 134, 90, 88, 210]
		// 	},
		// 	{
		// 		name: 'Team 2',
		// 		type: 'line',
		// 		step: 'start',
		// 		data: [20, 132, 283, 134, 130, 230, 210]
		// 	},
		// 	{
		// 		name: 'Team 3',
		// 		type: 'line',
		// 		step: 'start',
		// 		data: [77, 132, 101, 134, 90, 230, 999]
		// 	},
		// 	{
		// 		name: 'Team 4',
		// 		type: 'line',
		// 		step: 'middle',
		// 		data: [120, 199, 211, 234, 200, 430, 410]
		// 	},
		// 	{
		// 		name: 'Team 5',
		// 		type: 'line',
		// 		step: 'end',
		// 		data: [250, 438, 481, 424, 190, 930, 510]
		// 	},
		// 	{
		// 		name: 'Team 6',
		// 		type: 'line',
		// 		step: 'start',
		// 		data: [120, 132, 77, 134, 90, 88, 210]
		// 	},
		// 	{
		// 		name: 'Team 7',
		// 		type: 'line',
		// 		step: 'start',
		// 		data: [120, 132, 233, 134, 190, 830, 210]
		// 	},
		// 	{
		// 		name: 'Team 8',
		// 		type: 'line',
		// 		step: 'start',
		// 		data: [77, 132, 101, 134, 90, 230, 999]
		// 	},
		// 	{
		// 		name: 'Team 9',
		// 		type: 'line',
		// 		step: 'middle',
		// 		data: [220, 199, 201, 234, 290, 430, 410]
		// 	},
		// 	{
		// 		name: 'Team 10',
		// 		type: 'line',
		// 		step: 'end',
		// 		data: [450, 432, 401, 454, 590, 530, 510]
		// 	}
		// ]
	};
	
	
	var getData = function () {
		$.get('Team_ajax/get_ranks/10').done(function (data) {
			var nowT = getTimeLine();
			
			var series = [],
				legendData = [],
				seriesData = [],
				index = '';
			
			data = eval('(' + data + ')');  //  for json traverse
			
			if (data) {
				legendData = [];
				for (index in data) {
					legendData.push('')
					seriesData.push(data[index].total_score);
					series.push({
						name: data[index].team_name,
						type: 'line',
						step: 'start',
						data: seriesData
					});
					console.log('index: ' + index);
					console.log('team_name: ' + data[index].team_name);
					console.log('total_score: ' + data[index].total_score);
				}
			}
		})
	};
	getData();
	
	//  rander chart
	(function chartRender() {
		var nowTime = new Date().getTime();
		var timeBreak = parseInt((nowTime - startTime) / 1000);
		if (650 > timeBreak && timeBreak > 550) {
			//  todo: get data
		}
		setInterval(function () {
			var timeBreak = parseInt((nowTime - startTime) / 1000);
			if (650 > timeBreak && timeBreak > 550) {
				//  todo: get data
			}
		}, 600000);
		
		
		rankChart.setOption(option);
	})();


// --  pageination --
	function pagination() {
		this.rows = 0;
		this.fistPage = 0;
		this.lastPage = 0;
		this.perPage = 0; //  每页显示的数量 
		this.goto = function () {
			//  ajax 获取perPage量的数据
		}
		this.pageRander = function () {
			//  页面前端渲染
		}
	}
	
	function setPaginationColumn() {
		var totalRow;
	}
});
