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
	
	function getData() {
		
		$.get('Team_ajax/get_top10').done(function (data) {
			
			if ($('#rank-chart').length > 0) {
				$('#rank-chart').remove();
			}
			//  asyn is trick.
			var divChart = $('<div id="rank-chart" style="height: 35rem;width: 100%;">');
			
			$('#main-container h1').after(divChart);
			
			var rankChart = echarts.init($('#rank-chart')[0]);
			
			data = eval('(' + data + ')');  //  for json traverse
			var xAxisData = ['', '', '', '', 'Last update: ', getTimeLine()],
				yAxisSeries = [],
			// yAxisMax = '',
			// yAxisMin = '',
			// yAxisSeriesData = [],
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
					type: 'value',
					max: 0,
					min: 100
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
				option.yAxis.max = getExtrem(data[0], 'max');
				option.yAxis.min = getExtrem(data[data.length - 1], 'min');
				rankChart.setOption(option);
			}
		})
	}
	
	function getExtrem(obj, status) {
		var ext = 0;
		var i, score;
		if (status == 'max') {
			for (i in obj) {
				score = obj[i];
				if (/score/g.test(i) && ext < score) {
					ext = score;
				}
			}
		} else if (status == 'min') {
			for (i in obj) {
				score = obj[i];
				if (/score/g.test(i) && ext > score) {
					ext = score;
				}
			}
		}
		return ext;
	}
	
	function getMin() {
		
	}
	
	function rankInit() {
		getData();
		setInterval(getData, 10 * 60 * 1000);
	}
	
	// --  pageination --
	
	function Pagination() {
		
		this.records = 0; //  rows
		this.fistPage = 1;
		this.lastPage = 1;
		this.perPages = 10;
		this.nowPage = 1;
		this.nowTop = 1;  //  top order
		this.loadPage = function (pageIndex, start) {
			$.get('Team_ajax/get_ranks10/' + pageIndex * 10).done(function (data) { //ranks从0开始
				data = JSON.parse(data);
				var index, pagination, paginationBody;
				pagination = $('#pagination');
				paginationBody = $(pagination).find('.table tbody');
				
				if ($(paginationBody).find('li').length > 0) {
					$(paginationBody).empty();
				}
				
				for (index in data) {
					var teamInfo = $(
						'<tr>' +
						'<td>' + parseInt(pageIndex * 10 + parseInt(index) + 1) + '</td>' +
						'<td><a target="_blank" href="teams/search/' + data[index].team_name + '">' + data[index].team_name + '</a></td>' +
						'<td>' + data[index].total_score + '</td>' +
						'</tr>');
					$(paginationBody).append($(teamInfo));
				}
				
				if (pageIndex == undefined || pageIndex == 0) {
					$.each($(paginationBody).find('tr'), function (index, element) {
						if (index < 3) {
							$(element).addClass('top-' + (index + 1));
						}
					});
				}
			});
		};
		this.createPagination = function (nums) {
			var pagUl = $('#pagination').find('.pagination');
			var i = 1;
			while (nums-- > 0) {
				var li = $('<li><a href="#">' + parseInt(i++) + '</a></li>');
				$(pagUl).append(li);
			}
		};
	}
	
	var pagObj = new Pagination();
	
	//  rank data	layer
	function rankDataInit() {
		$.get('Team_ajax/get_ranks_nums').done(function (data) {
			data = JSON.parse(data); // strings2obj
			pagObj.records = data.nums;
			pagObj.lastPage = parseInt(data.nums / pagObj.perPages) + 1;
			pagObj.nowTop = parseInt(pagObj.records / 10 - 1) * 10 + 1;
			pagObj.loadPage(pagObj.nowPage - 1, pagObj.nowTop);
			pagObj.createPagination(pagObj.lastPage);
			var pagination = $('#pagination');
			pagination.find('.pagination li').each(function (index, element) {
				$(element).click(function (event) {
					pagination.find('tbody').empty();
					pagObj.nowPage = parseInt(index) + 1;
					pagObj.nowTop = pagObj.nowPage * 10 + 1;
					pagObj.loadPage(pagObj.nowPage - 1, pagObj.nowTop);
					event.preventDefault();
				})
			});
		});
	}
	
	rankInit();
	rankDataInit();
	
	$('#toggle-rank').click(function () {
		rankInit();
		rankDataInit();
	});
});
