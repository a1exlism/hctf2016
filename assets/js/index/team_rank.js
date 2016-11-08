/**
 * Created by a1exlism on 16-11-3.
 */
$(function () {
	var startTime = new Date('2016-11-15 08:00:00').getTime();
	
	function getTimeLine(minAgo) {
		minAgo = minAgo || 0;
		function prefixZero(x) {
			if (x.toString().length == 1) {
				return '0' + x;
			} else {
				return x;
			}
		}
		
		var d = new Date(new Date().getTime() - minAgo * 60 * 1000);
		var timeObj = {
			'month': prefixZero(d.getMonth() + 1),
			'date': prefixZero(d.getDate()),
			'hours': prefixZero(d.getHours()),
			'minutes': prefixZero(d.getMinutes())
		};
		return (timeObj.month + '-' + timeObj.date + ' ' + timeObj.hours + ':' + timeObj.minutes).toString();
	}
	
	var rankChart = echarts.init($('#rank-chart')[0]);
	
	
	function getData() {
		$.get('Team_ajax/get_top10').done(function (data) {
			
			data = eval('(' + data + ')');  //  for json traverse
			var xAxisData = ['', '', '', '', 'Last update: ', getTimeLine()],
				yAxisSeries = [],
				yAxisSeriesData = [],
				legendData = [];
			
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
						5,  // top
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
					inactiveColor: '#aaa',
					// data: ['Team 1', 'Team 2', 'Team 3', 'Team 4', 'Team 5', 'Team 6', 'Team 7', 'Team 8', 'Team 9', 'Team 10']
					data: legendData
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
					data: xAxisData
					// data : [getTimeLine(50), getTimeLine(40), getTimeLine(30), getTimeLine(20), getTimeLine(10), getTimeLine()]
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
					// }
				},
				series: yAxisSeries
			};
			
			if (data) {
				for (index in data) {
					var obj = data[index];
					legendData.push(obj.team_name);
					yAxisSeries.push({
						name: obj.team_name,
						type: 'line',
						step: 'middle',
						data: [obj.score_a, obj.score_b, obj.score_c, obj.score_d, obj.score_e, obj.total_score]
					});
				}
				rankChart.setOption(option);
			}
		})
	}
	
	getData();

	setInterval(getData, 10 * 60 * 1000);

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
