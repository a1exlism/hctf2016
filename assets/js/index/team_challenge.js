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
		url: 'Team_ajax/get_solved_public',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			$('#solved-info ul').empty();
			if (data) {
				$.each(data, function (index, value) {
					$('#solved-info > ul').append($('<li>' +
						value.solvedTime + ' :<span class="teamName"> ' +
						value.teamName + '</span> solved ' +
						value.chaName + '</li>'));
				});
			}
		}
	});
}

function getCurrentChallenge() {
	$.ajax({
		url: 'Team_ajax/get_challenges',
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
				setDoneColor();
				loadChaDetails();
			}
		}
	});
}

function setDoneColor() {
	$.ajax({
		url: 'Team_ajax/get_done_names',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			if (data) {
				$('#challenge .prob-card').each(function (index, element) {
					var chaName = $(this).find('.card-body-top').text();
					if (data.indexOf(chaName) !== -1) {
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
	
	$('#challenge .prob-card').each(function (index, element) {
		$(element).bind('click', function () {
			var chaName = $(this).find('.card-body-top p').text();
			// alert(chaName);
			var chaInfo = getChaObj(chaName);
			// console.log(chaInfo);
			var chaPopup = $(
				'<div class="mask">' +
				'<div class="popup cha-info">' +
				'<h1>' + chaInfo.challenge_name + '</h1>' +
				'<p class="cha-sovles"><span>' + chaInfo.challenge_solves + '</span> Teams solved.</p>' +
				'<h3>description</h3>' +
				'<p class="cha-description">' + chaInfo.challenge_description + '</p>' + '<br>' +
				'<h3>Hint</h3>' +
				'<p class="cha-hit">' + chaInfo.challenge_hit + '</p>' +
				'<a class="popup-close glyphicon glyphicon-remove" href="javascript:0"></a>' + '<br>' +
				'<h4>flag submit</h4>' +
				'<div class="flags row">' +
				'<div class="col-xs-12">' +
				'<div class="input-group">' +
				'<input type="text" class="form-control">' +
				'<span class="input-group-btn">' +
				'<input class="btn btn-default" type="button" value="Submit">' +
				'</span>' +
				'</div>' +
				'</div>' +
				'</div>' +
				'</div>' +
				'</div>');
			$('#team-challenge').append($(chaPopup));
			setClose($('#team-challenge .mask'));

			return false;
		})
	});
};

function flagSubmit() {
	
}

function getTop10() {
	$.ajax({
		url: 'Team_ajax/get_ranks',
		method: 'post',
		dataType: 'json',
		data: {
			number: 10
		},
		success: function (data) {
			$('#team-challenge .sidebar p').remove();
			if (data) {
				$.each(data, function (index, value) {
					$('#team-challenge .sidebar').append($('<p class="team">' + value.team_name + '<span class="score">' + value.total_score + '</span></p>'));
				});
				
				$('#team-challenge .sidebar p').each(function (index, element) {
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

