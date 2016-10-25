/**
 * Created by a1exlism on 16-10-18.
 */
$(function () {
	//  Team Router
	function addCSS(url) {
		$('<link>').attr({
			rel: 'stylesheet',
			type: 'text/css',
			href: url
		}).appendTo('head');
	}
	
	function addJS(url) {
		$('<script>').attr({
			src: url
		}).appendTo('body');
	}
	
	function isExist(sname, stype) {
		var typeReg = new RegExp(sname, 'gi');
		var statusCode = 0;
		if (stype === 'css') {
			$('link').each(function () {
				if (this.href.indexOf(sname) !== -1) {
					// alert('CSS已存在');
					statusCode = 1;
					return true;  //中断当前循环
				}
			});
		} else if (stype === 'js') {
			$('script').each(function () {
				
				if (this.src.indexOf(sname) !== -1) {
					// alert('JS已存在');
					statusCode = 1;
					return true;
				}
				
			});
		}
		return statusCode;
	}
	
	//  动态加载静态资源 css/js
	function getSource(sname, stype) {
		stype = stype || 'js';  //默认以js加载
		
		if (isExist(sname, stype) == 1) {
			return false;
		} else {
			$.ajax({
				url: 'Team_ajax/get_source',
				method: 'POST',
				dataType: 'json',
				data: {
					name: sname,
					type: stype
				},
				success: function (data) {
					var resultUrl = data.url.replace(/[\\]/g, '');
					if (data.type === 'js') {
						addJS(resultUrl);
					} else {
						addCSS(resultUrl);
					}
				}
			});
		}
	}
	
	var getBulletin = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/bulletin');
		getSource('team_bulletin', 'css');
		getSource('team_bulletin', 'js');
	};
	
	var getChanllenge = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/challenge');
		getSource('team_challenge', 'css');
		getSource('team_challenge', 'js');
	};
	
	var getRank = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/rank');
		getSource('team_rank', 'css');
		getSource('team_rank', 'js');
	};
	
	var getSettings = function () {
		$('#main-container').empty();
		$('#main-container').load('Team/settings');
	};
	
	getSettings();  //默认在Settings界面
	
	$('#toggle-bulletin').click(getBulletin);
	$('#toggle-challenge').click(getChanllenge);
	$('#toggle-rank').click(getRank);
	$('#toggle-settings').click(getSettings, getName);

	/* -- Team Settings -- */
	//  Get Name
	function getName() {
		$.ajax({
			url: 'Team_ajax/get_teamname',
			method: 'get',
			dataType: 'text',
			success: function (data) {
				$('#team-name').html(data + '  ');
				$('#team-settings h1').html('Team: ' + data);
			}
		});
	}
	
	getName();
	
	
	//  countdown
	(function countdown() {
		function prefixZero(x) {
			if (x.length == 1) {
				return '0' + x;
			} else {
				return x;
			}
		}
		
		var deadline = new Date('2016-11-10 10:00:00');
		var leftTime = (deadline - new Date()) / 1000;
		var timeSpan = $('#toggle-time span')[0];
		var d, h, m;
		if (leftTime >= 0) {
			
			if (parseInt((leftTime - d * 24 * 3600) / 3600) < 8) {
				
			}
			setInterval(function () {
				leftTime = (deadline - new Date()) / 1000;
				d = parseInt(leftTime / 3600 / 24);
				h = prefixZero('' + parseInt((leftTime - d * 24 * 3600) / 3600));
				m = prefixZero('' + parseInt((leftTime - d * 24 * 3600 - h * 3600) / 60));
				s = prefixZero('' + parseInt((leftTime - d * 24 * 3600 - h * 3600 - m * 60)));
				timeSpan.innerText = d + 'D ' + h + ':' + m + ':' + s;
			}, 1000);
		} else {
			return true;
			//  退出当前循环
		}
	}());
	
	function getTeamInfo() {
		//  team_info page load
		$.ajax({
			url: 'Team_ajax/get_teaminfo',
			method: 'get',
			dataType: 'json',
			success: function (data) {
				console.log(data);
			}
		})
	}
	
	//  延迟等待ajax调用完毕
	setTimeout(function () {
		$('#team-ranking .msg-btn').click(function () {
			var sForm = $('#pass-change form');
			if (sForm.css('display') == 'none') {
				sForm.css('display', 'block');
			} else {
				sForm.css('display', 'none');
			}
		});
	}, 50);
	
	var passChange = $.ajax({
		url: 'Team_ajax/'
	})
	
});
