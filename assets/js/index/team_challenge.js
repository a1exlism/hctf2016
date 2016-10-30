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

getChallenge();

setInterval(getChallenge, 30000); //update in every 30seconds

$('#toggle-challenge').click(getChallenge);