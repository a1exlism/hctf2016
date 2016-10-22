$(function () {
	/* -- Get Name-- */
	$.ajax({
		url: 'Team_ajax/get_teamname',
		method: 'get',
		dataType: 'text',
		success: function (data) {
			$('#team-name').html(data + '  ');
		}
	});
});
