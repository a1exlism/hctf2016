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
		if (sname.indexOf('/') !== -1){
			var tmpArr = sname.split('/');
			sname = tmpArr[tmpArr.length -1];
		}
		if (stype === 'css') {
			$('link').each(function () {
				if (this.href.indexOf('font') !== -1) {
					statusCode = 1;
					return true;
					//  这个宏有问题, 单页面只能动态加载一个font内容!!!!
				}
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

	var mainContainer = $('#main-container');
	var getBulletin = function () {
		$(mainContainer).empty();
		$(mainContainer).load('Team/bulletin');
		getSource('team_bulletin', 'css');
		getSource('team_bulletin', 'js');
	};
	
	var getChanllenge = function () {
		$(mainContainer).empty();
		$(mainContainer).load('Team/challenge');
		getSource('../../fonts/crown/iconfont', 'css');
		getSource('team_challenge', 'css');
		getSource('team_challenge', 'js');
		getSource('../geetest/gt', 'js');
	};
	
	var getRank = function () {
		$(mainContainer).empty();
		$(mainContainer).load('Team/rank');
		getSource('../echarts/echarts', 'js');
		getSource('team_rank', 'css');
		getSource('team_rank', 'js');
	};
	
	var getSettings = function () {
		$(mainContainer).empty();
		$(mainContainer).load('Team/settings', function () {
			
			$('#team-ranking .msg-btn').click(function () {
				var sForm = $('#pass-change form');
				if (sForm.css('display') == 'none') {
					sForm.css('display', 'block');
				} else {
					sForm.css('display', 'none');
				}
			});
			
			$('#pass-change').find('.submit-btn').click(passChange);
			
		});
	};
	
	mainInit();
	
	$('#toggle-bulletin').click(getBulletin);
	$('#toggle-challenge').click(getChanllenge);
	$('#toggle-rank').click(getRank);
	$('#toggle-settings').click(function () {
		$('#team-solved .solved-body dl').empty();
		mainInit();
	});
	
	/* -- Team Settings -- */
	
	function mainInit() {
		getSettings();  //默认在Settings界面
		countdown();
		getName();
		getSolved();
		getTeamInfo();
	}
	
	setInterval(function () { //update in every 30seconds
		getSolved();
		getTeamInfo();
	}, 60000);
	
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
	
	function countdown() {
		function prefixZero(x) {
			if (x.length == 1) {
				return '0' + x;
			} else {
				return x;
			}
		}
		
		function getTime(deadline) {
			var leftTime = (deadline - new Date()) / 1000;
			var d, h, m, s;
			d = parseInt(leftTime / 3600 / 24);
			h = prefixZero('' + parseInt((leftTime - d * 24 * 3600) / 3600));
			m = prefixZero('' + parseInt((leftTime - d * 24 * 3600 - h * 3600) / 60));
			s = prefixZero('' + parseInt((leftTime - d * 24 * 3600 - h * 3600 - m * 60)));
			
			return {
				'leftTime': leftTime,
				'd': d,
				'h': h,
				'm': m,
				's': s
			};
		}
		
		
		var deadline = new Date('2016-11-15 10:00:00');
		var timeSpan = $('#toggle-time span')[0];
		var timeObj = getTime(deadline);
		if (timeObj.leftTime >= 0) {
			
			if (timeObj.d === 0 && timeObj.h < 8) {
				timeSpan.style.color = '#ea4435';
			}
			setInterval(function () {
				if (timeObj.leftTime < 0) {
					$('#toggle-time').text('Game Over');
				}
				timeObj = getTime(deadline);
				timeSpan.innerText = timeObj.d + 'D ' + timeObj.h + ':' + timeObj.m + ':' + timeObj.s;
			}, 1000);
		} else {
			$('#toggle-time').text('Game Over');
			return true;
			//  退出当前循环
		}
	}
	
	function getSolved() {
		$.ajax({
			url: 'Team_ajax/get_solved',
			method: 'get',
			dataType: 'json',
			success: function (data) {
				if (data) {
					$('#team-solved .solved-body dl').empty();
					$.each(data, function (index, value) {
						$('#team-solved .solved-body dl').append($('<dt>' +
							'<span class="cha-name">' + value.chaName + '</span>' +
							' | <span class="cha-type">' + value.chaType + '</span></dt>'));
						$('#team-solved .solved-body dl').append($('<dd>' +
							'Score: <span class="cha-score">' + value.chaScore + '</span>' +
							' | Solved at <span class="cha-solved-time">' + value.solvedTime + '</span>' +
							' | Sovled number: <span class="cha-solved-num">' + value.solvedNum + '</span></dd>'));
					});
				}
			}
		});
	}
	
	
	function getTeamInfo() {
		$.ajax({
			url: 'Team_ajax/get_team_info',
			method: 'get',
			dataType: 'json',
			success: function (data) {
				$('#team-ranking .team-level').find('span').html(data.level);
				$('#team-ranking .team-ranking').find('span').html(data.ranking);
				$('#team-ranking .team-score').find('span').html(data.score);
			}
		})
	};
	
	
	var submitBtn = $('#pass-change').find('.submit-btn');
	
	function msgShow(e, msg, status) {
		if (status === 1) {
			e.css('color', '#34a853');
		} else {
			e.css('color', '#ff7f70');
		}
		e.show();
		e.html(msg);
		setTimeout(function () {
			e.hide();
		}, 2000);
	}
	
	function passChange() {
		var oriPass = $('#ori-pass').val();
		var newPass = $('#new-pass').val();
		var msgE = $('#pass-change').find('.msg-show');
		if (oriPass == '' || newPass == '') {
			msgShow(msgE, 'Empty Input', 2);
			return false;
		}
		// console.log('ori-pass' + oriPass);
		// console.log('new-pass' + newPass);
		$.ajax({
			url: 'Team_ajax/pass_change',
			type: 'POST',
			dataType: 'json',
			data: {
				"ori_pass": oriPass,
				"new_pass": newPass
			},
			success: function (data) {
				if (data) {
					console.log(data);
					if (data.status === 'success') {
						msgShow(msgE, 'Success, Redirecting...', 1);
						setTimeout(function () {
							window.location.replace('team/logout');
						}, 200);
					} else {
						msgShow(msgE, 'Validation failed', 2);
					}
				}
			}
		})
	}
	
	
});
