$(function () {
	
	/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
	// particlesJS.load('particles-js', './particles.json', function() {
	//   console.log('callback - particles.js config loaded');
	// });
	
	particlesJS('particles-js', {
		"particles": {
			"number": {
				"value": 40,
				"density": {
					"enable": true,
					"value_area": 800
				}
			},
			"color": {
				"value": ["#3cba54",
					"#f4c20d",
					"#db3236",
					"#4885ed"]
			},
			"shape": {
				"type": "circle",
				"stroke": {
					"width": 0,
					"color": "#000"
				},
				"polygon": {
					"nb_sides": 6
				},
				"image": {
					"src": "img/github.svg",
					"width": 100,
					"height": 100
				}
			},
			"opacity": {
				"value": 0.6,
				"random": false,
				"anim": {
					"enable": false,
					"speed": 1,
					"opacity_min": 0.1,
					"sync": false
				}
			},
			"size": {
				"comment": "particles的大小",
				"value": 3,
				"random": true,
				"anim": {
					"enable": false,
					"speed": 40,
					"size_min": 0.2,
					"sync": false
				}
			},
			"line_linked": {
				"enable": true,
				"distance": 150,
				"color": "#ffffff",
				"opacity": 0.4,
				"width": 1
			},
			"move": {
				"enable": true,
				"speed": 5,
				"direction": "none",
				"random": false,
				"straight": false,
				"out_mode": "out",
				"bounce": false,
				"attract": {
					"enable": true,
					"rotateX": 600,
					"rotateY": 1200
				}
			}
		},
		"interactivity": {
			"detect_on": "canvas",
			"events": {
				"onhover": {
					"comment": "hover效果",
					"enable": true,
					"mode": "grab"
				},
				"onclick": {
					"comment": "点击效果",
					"enable": true,
					"mode": "push"
				},
				"resize": true
			},
			"modes": {
				"grab": {
					"distance": 180,
					"line_linked": {
						"opacity": 0.6
					}
				},
				"bubble": {
					"distance": 800,
					"size": 80,
					"duration": 2,
					"opacity": 0.8,
					"speed": 3
				},
				"repulse": {
					"distance": 400,
					"duration": 0.4
				},
				"push": {
					"particles_nb": 2
				},
				"remove": {
					"particles_nb": 2
				}
			}
		},
		"retina_detect": true
	});
	
	/* Login/Register panel switch */
	
	$('#login-form-link').click(function (event) {
		$('#form-login').delay(150).fadeIn(150);
		$('#form-register').fadeOut(150);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		event.preventDefault(); //防止url被打开
	});
	$('#register-form-link').click(function (event) {
		$('#form-register').delay(150).fadeIn(150);
		$('#form-login').fadeOut(150);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		event.preventDefault();
	});
	
	/*--- Register input check ---*/
	var btnRegister = document.querySelector('#cover-submit-register'),
		btnLogin = document.querySelector('#cover-submit-login'),
		inputTeamName = document.getElementById('user-register'),
		inputSchool = document.getElementById('school'),
		inputPassword = document.getElementById('pass-register'),
		inputConfirm = document.getElementById('password-confirm'),
		inputPhoneNum = document.getElementById('phone');
	
	//  messages	
	
	var mask = $('#mask'),
		popupCaptcha = $('#popup-captcha');
	
	var msgSucReg = $('.msgtip-success-register'),
		msgFaiReg = $('.msgtip-fail-register'),
		msgSucLog = $('.msgtip-success-login'),
		msgFaiLog = $('.msgtip-fail-login');
	
	
	//  Warning Infomation
	function warningAdd() {
		btnRegister.classList.remove('btn-primary');
		btnRegister.classList.add('submit-wrong');
		btnRegister.disabled = true;
	}
	
	function warningRemove() {
		if (btnRegister.classList.contains('submit-wrong')) {
			btnRegister.value = 'Register Now';
			btnRegister.disabled = false;
			btnRegister.classList.remove('submit-wrong');
			btnRegister.classList.add('btn-primary');
		}
	}
	
	function emptyCheck(ele) {
		if (ele.value == '') {
			warningAdd();
			ele.addEventListener('blur', function () {
				warningAdd();
				btnRegister.value = 'Empty Input!';
			});
			ele.addEventListener('focus', warningRemove);
		}
	}
	
	
	//  password confirm
	
	function passwdCheck() {
		
		if (inputPassword.value != inputConfirm.value) {
			//  judge classname
			if (btnRegister.classList.contains('submit-wrong')) {
				//  JS Hack 方法
				// if (Array.prototype.indexOf.apply(btnRegister.classList, ['submit-wrong']) != -1) {
				return null;
			}
			
			btnRegister.value = 'Check your passwd!';
			warningAdd()
		}
	}
	
	inputPassword.addEventListener('blur', passwdCheck);
	inputPassword.addEventListener('focus', warningRemove);
	inputConfirm.addEventListener('focus', warningRemove);
	inputConfirm.addEventListener('blur', passwdCheck);
	
	/*
	 *
	 *   --  ajax asyn submit --
	 *
	 * */
	
	/* -- register -- */
	$(btnRegister).click(function () {
		$.ajax({
			url: "geetest/startCaptcha/t/" + (new Date()).getTime(),
			type: "get",
			dataType: "json",
			success: function (data) {
				$('#popup-captcha').find('.gt_mobile_holder').first().remove();
				initGeetest({
					gt: data.gt,
					challenge: data.challenge,
					offline: !data.success
				}, registerValidate);
			}
		});
	});
	
	var registerValidate = function (captchaObj) {
		captchaObj.appendTo("#popup-captcha");
		captchaObj.onSuccess(function () {
			captchaHide();
			var validate = captchaObj.getValidate();
			var email = $('#email').val();
			$.ajax({
				url: "geetest/register_check",
				type: "post",
				dataType: "json",
				data: {
					teamname: $('#user-register').val(),
					school: $('#school').val(),
					email: email,
					password: $('#pass-register').val(),
					phone: $('#phone').val(),
					geetest_challenge: validate.geetest_challenge,
					geetest_validate: validate.geetest_validate,
					geetest_seccode: validate.geetest_seccode
				},
				success: function (data) {
					if (data && (data.status === "success")) {
						if (data.to_active && data.to_active === 1) {
							mailSend(data.checksum, email);
						}
						
					} else if (data && (data.status === "error")) {
						//  json 数据处理
						//  清空所有子元素
						$(msgFaiReg).empty();
						for (var i in data) {
							if (i == 'status') {
								continue;
							}
							$(msgFaiReg).append('<p>' + data[i] + '</p>');
						}
						$(msgFaiReg).show();
						setTimeout(function () {
							$(msgFaiReg).hide();
						}, 2500);
					}
				}
			});
		});
	};
	
	//  email
	function mailSend(checksum, mailToSend) {
		$.ajax({
			url: 'login/mail_send',
			type: 'post',
			dataType: 'json',
			data: {
				email: mailToSend,
				checksum: checksum
			},
			success: function (data) {
				if (data) {
					if (data.status === 'success') {
						$(msgSucReg).show();
						setTimeout(function () {
							$('#login-form-link').click();
							$(msgSucReg).hide();
						}, 500);
					}
				}
			}
		})
	}
	
	/* -- login -- */
	$(btnLogin).click(function () {
		$.ajax({
			url: "geetest/startCaptcha/t/" + (new Date()).getTime(),
			type: "get",
			dataType: "json",
			success: function (data) {
				$(popupCaptcha).find('.gt_mobile_holder').first().remove();
				initGeetest({
					gt: data.gt,
					challenge: data.challenge,
					offline: !data.success
				}, handlerPopupLogin);
			}
		});
	});
	
	var handlerPopupLogin = function (captchaObj) {
		// 将验证码加到id为captcha的元素里
		captchaObj.appendTo("#popup-captcha");
		//拖动验证成功后两秒(可自行设置时间)自动发生跳转等行为
		captchaObj.onSuccess(function () {
			captchaHide();
			//  mask 隐藏
			var validate = captchaObj.getValidate();
			$.ajax({
				url: "geetest/verifyLogin", // 进行二次验证
				type: "post",
				dataType: "json",
				data: {
					// 二次验证
					username: $('#user-login').val(),
					password: $('#pass-login').val(),
					geetest_challenge: validate.geetest_challenge,
					geetest_validate: validate.geetest_validate,
					geetest_seccode: validate.geetest_seccode
				},
				success: function (data) {
					if (data && (data.status === "success")) {
						// $('#form-login').submit();
						postLogin();
					} else if (data && (data.status === "fail_2")) {
						$('.geetest-fail').show();
						setTimeout(function () {
							$('.geetest-fail').hide();
						}, 2500);
					}
				}
				
			});
		});
	};
	
	var postLogin = function () {
		$.ajax({
			url: 'user_ajax/login_check',
			type: 'post',
			dataType: 'json',
			data: {
				teamname: $('#user-login').val(),
				password: $('#pass-login').val()
			},
			success: function (data) {
				if (data && (data.status === "success")) {
					$('.msgtip-success-login').show();
					setTimeout(function () {
						window.location.href = 'team';
					}, 500);
				} else {
					$(msgFaiLog).show();
					setTimeout(function () {
						$(msgFaiLog).hide();
					}, 2500);
				}
			}
		});
	};
	
	/* --- 极验验证 --- 套用的mobi端 --- */
	
	function captchaHide() {
		$(mask).hide();
		$(popupCaptcha).hide();
	}
	
	$(mask).click(function () {
		captchaHide();
		$(btnLogin).show();
		$(btnRegister).show();
	});
	
	$(btnLogin).click(function () {
		$(mask).show();
		$(popupCaptcha).show();
	});
	
	$(btnRegister).click(function () {
		$(mask).show();
		$(popupCaptcha).show();
	});
	
});
