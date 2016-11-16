$(function () {
	
	(function mailActive() {
		var query = window.location.href.split('/'),
			queryLen = query.length;
		
		var successMsg = $('.success')[0],
			errorMsg = $('.error')[0];
		
		$.ajax({
			url: '/hctf2016/index/active/mail_check',
			type: 'post',
			dataType: 'json',
			data: {
				'query': query[queryLen - 1]
			},
			success: function (data) {
				if (data && data.status === 'success') {
					tmpShow(successMsg, data.message, 1500);
				}
				else if (data.status === 'error_0') {
					tmpShow(errorMsg, data.message, 99999);
				}
				else {
					tmpShow(errorMsg, data.message, 1500);
				}
			}
		})
	})();
	
	
	function tmpShow(ele, message, time) {
		$(ele).empty();
		$(ele).text(message);
		$(ele).show();
		setTimeout(function () {
			window.location.href = '/hctf2016/index/login';
		}, time);
	}
});
