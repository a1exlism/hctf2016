$(function () {
	
	var mask = $('#mask'),
		popupCaptcha = $('#popup-captcha'),
		submitBtn = $("#submit"),
		msgTip = $('#msgtip');
	var successMsg = $(msgTip).find('.success'),
		errorMsg = $(msgTip).find('.error');
	
	var mailToSend = '';
	
	$(submitBtn).click(function () {
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
						mailSend(data.checksum);
					} else {
						tmpShow(errorMsg, data.message);
					}
				}

			});
		});
	};
	
	function mailSend(checksum) {
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
					if (data.status == 'success') {
						tmpShow(successMsg, data.message);
					}
				}
			}
		})
	}
	
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
	
	$(submitBtn).click(function () {
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