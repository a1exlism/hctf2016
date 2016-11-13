$(function () {
	$('#submit').click(function () {
		$.ajax({
			url: 'user_ajax/forget_validate',
			type: 'post',
			dataType: 'json',
			data: {
				email: $('#forget').find('input').val()
			},
			success: function (data) {
				var msgTip = $('#msgtip');
				if (data) {
					if (data.status == 'success') {
						var success = $(msgTip).find('.success');
						//  发送邮件
						tmpShow(success, data.message);
					} else {
						var error = $(msgTip).find('.error');
						tmpShow(error, data.message);
					}
				}
			}
		})
	});
	function tmpShow(ele, message) {
		$(ele).empty();
		$(ele).append('<p>' + message + '</p>');
		$(ele).show();
		setTimeout(function () {
			$(ele).hide();
		}, 2500);
	}
	
});