/**
 * Created by a1exlism on 16-10-20.
 */

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

				$.each(data, function (index, value) {
					var solves = value.challenge_solves || '0';
					var probCard = $('<div class="col-xs-6 col-md-3 prob-card"></div>');
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
	getTop10();
}

getCurrentChallenge();  //获取题目
getChallenge();

setInterval(getChallenge, 40000); //update in every 30seconds

$('#toggle-challenge').click(getChallenge);