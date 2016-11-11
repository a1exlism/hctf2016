$(function () {
	$('#submit').click(function () {
		$.ajax({
			url: 'user_ajax/validate',
			type: 'post',
			dataType: 'json',
			data: {
				email: $('#forget input').val()
			},
			success: function (data) {
				console.log(data);
			}
		})
	})
});