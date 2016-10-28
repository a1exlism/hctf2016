/**
 * Created by a1exlism on 16-10-20.
 */

function getSolvedPublic() {
	$.ajax({
		url: 'Team_ajax/get_solved_public',
		method: 'get',
		dataType: 'json',
		success: function (data) {
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

getSolvedPublic();

$('#toggle-challenge').click(getSolvedPublic);