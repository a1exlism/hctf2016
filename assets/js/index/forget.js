$(function () {
	var forget = $("#forget"),
		passReset = $('#pass-reset');

	var mask = $('#mask'),
		popupCaptcha = $('#popup-captcha'),
		submitMail = $(forget).find("#submit"),
		submitPass = $(passReset).find("#submit"),
		msgTip = $('#msgtip');

	var successMsg = $(msgTip).find('.success'),
		errorMsg = $(msgTip).find('.error');
	
	var mailToSend = '';
	
	$(submitMail).click(function () {
		$(popupCaptcha).empty();
		$.ajax({
			url: "Geetest/startCaptcha/t/" + (new Date()).getTime(),
			type: "get",
			dataType: "json",
			success: function (data) {
				initGeetest({
					gt: data.gt,
					challenge: data.challenge,
					offline: !data.success
				}, mailValidate);
			}
		});
	});
	
	var mailValidate = function (captchaObj) {
		captchaObj.appendTo("#popup-captcha");
		captchaObj.onSuccess(function () {
			captchaHide();
			var validate = captchaObj.getValidate();
			mailToSend = $('#forget').find('input').val();
			$.ajax({
				url: "Geetest/mail_check",
				type: "post",
				dataType: "json",
				data: {
					email: mailToSend,
					geetest_challenge: validate.geetest_challenge,
					geetest_validate: validate.geetest_validate,
					geetest_seccode: validate.geetest_seccode
				},
				success: function (data) {
					if (data && (data.status == "success")) {
						mailSend(data.checksum, data.email);
					} else {
						tmpShow(errorMsg);
					}
				}
				
			});
		});
	};
	
	function mailSend(checksum, email) {
		$.ajax({
			url: 'forget/mail_send',
			type: 'post',
			dataType: 'json',
			data: {
				email: mailToSend,
				checksum: checksum
			},
			success: function (data) {
				if (data) {
					if (data.status === 'success') {
						tmpShow(successMsg, data.message);
					}
				}
			}
		})
	}
	
	/* --- pass reset --- */
	var passChange = function () {
		var query = window.location.href.split('/'),
			queryLen = query.length;
		$.ajax({
			url: '/hctf2016/index/user_ajax/pass_reset',
			type: 'post',
			dataType: 'json',
			data: {
				'query-1': query[queryLen - 2],
				'query-2': query[queryLen - 1],
				'pass': $(passReset).find('input')[0].value
			},
			success: function (data) {
				if(data && data.status === 'success') {
					tmpShow(successMsg, data.message);
					setTimeout(function () {
						window.location.href = '/hctf2016/index/login';
					}, 1000);
				} else {
					tmpShow(errorMsg, data.message);
				}
			}
		})
	};
	$(submitPass).click(passChange);
	
	/* --- utilities --- */
	function captchaHide() {
		$(mask).hide();
		$(popupCaptcha).hide();
	}
	
	$(mask).click(function () {
		$(mask).hide();
		$(popupCaptcha).hide();
		$(popupCaptcha).empty();
	});
	
	$(submitMail).click(function () {
		$(mask).show();
		$(popupCaptcha).show();
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