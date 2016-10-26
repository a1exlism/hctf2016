/**
 * Created by a1exlism on 16-10-19.
 */
function bulletinRander() {
	$.getJSON('team_ajax/get_bulletin', function (data) {
		$.each(data, function (index, value) {
			var trRow = $('<tr class="bulletin-row"></tr>');
			var tdTime = $('<td class="time">' + value.update_time + '</td>');
			var tdContent = $('<td class="content">' + value.bulletin_message + '</td>');
			trRow.append(tdTime);
			trRow.append(tdContent);
			$('#bulletin .bulletin-content tbody').append(trRow);
		});
	})
}

bulletinRander();