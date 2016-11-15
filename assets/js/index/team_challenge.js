/**
 * Created by a1exlism on 16-10-20.
 */


var challenges;
function saveChallenges(data) {
	challenges = data;
	//  保存题目数据 json's code
}

function getSolvedPublic() {
	$.ajax({
		url: 'team_ajax/get_solved_public',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			var solvedInfo = $('#solved-info');
			$(solvedInfo).find('ul').empty();
			if (data) {
				$.each(data, function (index, element) {
					$(solvedInfo).find('ul').append($('<li>' +
						element.solvedTime + ' :<span class="teamName"> ' +
						element.teamName + '</span> solved ' +
						element.chaName + '</li>'));
				});
			}
		}
	});
}

function getCurrentChallenge() {
	$.ajax({
		url: 'team_ajax/get_challenges',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			if (data) {
				$('#challenge .prob-card').remove();
				saveChallenges(data);
				// console.log(challenges);
				$.each(data, function (index, value) {
					var solves = value.challenge_solves || '0';
					var probCard = $('<div class="col-xs-4 col-md-3 prob-card"></div>');
					var cardBar = $('<div class="card-bar">' +
						'<div class="card-bar-left">' + '<p>level <span>' + value.challenge_level + '</span></div>' +
						'<div class="card-bar-right doing"><p class="cha-score">' + value.challenge_score + '</p></div>' +
						'</div>');
					var cardBody = $(String.prototype.concat('<div class="card-body">',
						'<div class="card-body-top"><p>', value.challenge_name, '</p></div>',
						'<div class="card-body-bottom"><p>', value.challenge_type, '<span class="cha-solves">', solves,
						'</span></p></div>'));
					$(probCard).append(cardBar, cardBody);
					$('#challenge').append(probCard);
				});
				loadChaDetails();
				setDoneStyle();
			}
		}
	});
}

function setDoneStyle() {
	$.ajax({
		url: 'team_ajax/get_done_names',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			if (data) {
				$('#challenge .prob-card').each(function (index, element) {
					var chaName = $(this).find('.card-body-top').text();
					if (data.indexOf(chaName) !== -1) {
						// console.log(data);
						$(this).find('.card-bar-left').css('border-bottom', 'solid #99FFB2 1px');
						$(this).find('.card-bar-right').removeClass('doing').addClass('done');
					}
				})
			}
		}
	})
}

function loadChaDetails() {
	
	function getChaObj(name) {
		var challenges = window.challenges;
		var i;
		for (i in challenges) {
			if (challenges[i].challenge_name == name) {
				return challenges[i];
			}
		}
		return true;
	}
	
	function setClose(ele) {
		
		// Single Card Info Set close event
		$(ele).bind('click', function () {
			$(ele).remove();
		});
		
		$(ele).find('.popup').bind('click', function () {
			return false;
		});
		
		$(ele).find('.popup-close').bind('click', function (event) {
			$(ele).remove();
		});  //  阻止事件捕获
		
	}
	
	//  flags
	function handlerFlag(captchaObj) {
		
		captchaObj.appendTo("#popup-captcha");
		captchaObj.onSuccess(function () {
			captchaHide();
			var validate = captchaObj.getValidate();
			var flag = $('.flag-content').val();
			$.ajax({
				url: "geetest/verifyFlag", // 进行二次验证
				type: "post",
				dataType: "json",
				data: {
					flag: flag,
					geetest_challenge: validate.geetest_challenge,
					geetest_validate: validate.geetest_validate,
					geetest_seccode: validate.geetest_seccode
				},
				success: function (data) {
					
					if (data && data.status == 'success') {
						flagSubmit(flag);
					} else {
						alert('no flags has been submitted');
					}
				}
			});
		});
	}
	
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
	
	function flagSubmit(flag) {
		var teamCha = $('#team-challenge');
		var chaId = getChaObj($(teamCha).find('.cha-info h1').text()).challenge_id;
		// console.log(chaId);
		$.ajax({
			url: "check_flag/check",
			type: "post",
			dataType: "json",
			data: {
				id: chaId,
				flag: flag
			},
			success: function (data) {
				function notifyShow(staClass, msg) {
					var notify = $(teamCha).find('.flag-notify');
					notify.show();
					notify.text(msg);
					notify.addClass(staClass);
					setTimeout(function () {
						notify.hide();
					}, 2000);
				}
				
				if (data) {
					switch (data.statusCode) {
						case 0:
							notifyShow('flag-warning', 'Wrong flag, try again.');
							break;
						case 1:
							notifyShow('flag-danger', 'You are cheating!Contact Administrator!');
							setTimeout(function() {
								window.location.href="login";
							}, 800);
							break;
						case 2:
							notifyShow('flag-success', 'Correct flag, Congratulations!');
							//  score update for score chart
							$.ajax({
								url: 'team_ajax/score_update',
								type: 'post',
								dataType: 'json',
								data: {
									solved_time: getTimeLine()
								},
								success: function () {
									setTimeout(function () {
										$('.mask').remove();
										getChallenge();
									}, 800);
								}
							});
							break;
						case 3:
							notifyShow('flag-info', 'You solved this challenge.');
							break;
						default:
							notifyShow('flag-warning', 'This challenge is hidden now.');
							// setTimeout(getChallenge, 1000); todo: for testing
					}
				}
			}
		});
	}
	
	$('#challenge .prob-card').each(function (index, element) {
		$(element).bind('click', function () {
			
			var chaName = $(this).find('.card-body-top p').text();
			// alert(chaName);
			var chaInfo = getChaObj(chaName);
			var chaPopup = $(
				'<div class="mask">' +
				'<div class="popup cha-info">' +
				'<h1>' + chaInfo.challenge_name + '</h1>' +
				'<p class="cha-sovles"><span>' + chaInfo.challenge_solves + '</span> Teams solved.</p>' +
				'<h3>description</h3>' +
				'<p class="cha-description">' + chaInfo.challenge_description + '</p>' + '<br>' +
				'<h3>Hint</h3>' +
				'<p class="cha-hit">' + chaInfo.challenge_hit + '</p>' +
				'<a class="popup-close glyphicon glyphicon-remove" href="#"></a>' + '<br>' +
				'<h4>flag submit</h4>' +
				'<div class="flags row">' +
				'<div class="col-md-8">' +
				'<div class="input-group">' +
				'<input type="text" class="flag-content form-control">' +
				'<span class="input-group-btn">' +
				'<input id="flag-submit" class="btn btn-default" type="button" value="Submit">' +
				'</span>' +
				'</div>' +
				'</div>' +
				'<div class="col-md-8">' +
				'<p class="flag-notify"></p>' +
				'</div>' +
				'</div>' +
				'</div>' +
				'</div>');
			
			var teamCha = $('#team-challenge');
			$(teamCha).append($(chaPopup));
			setClose($(teamCha).find('.mask'));
			$('#mask').bind('click', captchaHide);
			
			$("#flag-submit").click(function () {
				$.ajax({
					url: "geetest/startCaptcha/t/" + (new Date()).getTime(),
					type: "get",
					dataType: "json",
					success: function (data) {
						initGeetest({
							gt: data.gt,
							challenge: data.challenge,
							offline: !data.success
						}, handlerFlag);
					}
				});
				captchaShow();
			});
			return false;
		})
	});
};

function getTop10() {
	$.ajax({
		url: 'team_ajax/get_ranks/10',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			var teamCha = $('#team-challenge');
			$(teamCha).find('.sidebar p').remove();
			if (data) {
				$.each(data, function (index, value) {
					$(teamCha).find('.sidebar').append($('<p class="team">' + value.team_name + '<span class="score">' + value.total_score + '</span></p>'));
				});
				
				$(teamCha).find('.sidebar p').each(function (index, element) {
					if ((index + 1) <= 3) {
						$(element).find('.score ').prepend('<i class="iconfont top-' + (index + 1) + '">&#xe614;</i>');
					}
				})
			}
		}
	});
}

function getChallenge() {
	getSolvedPublic();
	getCurrentChallenge();
	getTop10();
}

getChallenge();

setInterval(getChallenge, 40000); //update in every 40seconds

$('#toggle-challenge').click(getChallenge);


/*
 * -- GeeTest Module --
 */

function captchaHide() {
	$("#mask, #popup-captcha").hide();
	$('#popup-captcha').empty();
}

function captchaShow() {
	$("#mask, #popup-captcha").show();
}
