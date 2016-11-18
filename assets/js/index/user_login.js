$(function () {
	
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
	
	//  todo: Optimize the Message pop-up
	/* Login/Register panel switch */
	
	var linkLogin = $('#login-form-link'),
		linkRegister = $('#register-form-link'),
		formLogin = $('#form-login'),
		formRegister = $('#form-register');
	
	$(linkLogin).click(function (event) {
		$(formLogin).delay(100).fadeIn(100);
		$(formRegister).fadeOut(100);
		$(linkRegister).removeClass('active');
		$(this).addClass('active');
		event.preventDefault();
	});
	
	$(linkRegister).click(function (event) {
		$(formRegister).delay(100).fadeIn(100);
		$(formLogin).fadeOut(100);
		$(linkLogin).removeClass('active');
		$(this).addClass('active');
		event.preventDefault();
	});
	
	/*--- Register input check ---*/
	var btnRegister = document.querySelector('#submit-register'),
		btnLogin = document.querySelector('#submit-login'),
		inputTeamName = document.getElementById('user-register'),
		inputSchool = document.getElementById('school'),
		inputPassword = document.getElementById('pass-register'),
		inputConfirm = document.getElementById('password-confirm'),
		inputPhoneNum = document.getElementById('phone');
	
	//  messages	
	
	var mask = $('#mask'),
		popupCaptcha = $('#popup-captcha');
	
	var msgtip = $('.msgtip');
	// var msgSucReg = $('.msgtip-success-register'),
	// 	msgFaiReg = $('.msgtip-fail-register'),
	// 	msgSucLog = $('.msgtip-success-login'),
	// 	msgFaiLog = $('.msgtip-fail-login');
	
	
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
	
	//  password confirm
	
	function passwdCheck() {
		
		if (inputPassword.value != inputConfirm.value) {
			//  judge classname
			if (btnRegister.classList.contains('submit-wrong')) {
				//  JS Hack 
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
					if (data && (data.status == "success")) {
						if (data.to_active && data.to_active === 1) {
							mailSend(data.checksum, email);
						}
						
					} else if (data && (data.status == "error")) {
						tmpShow(msgtip, 'error', data.message);
					}
				}
			});
		});
	};
	//  todo: next function 邮件重发
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
					tmpShow(msgtip, data.status, data.message);
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
				}, loginValidate);
			}
		});
	});
	
	var loginValidate = function (captchaObj) {
		captchaObj.appendTo("#popup-captcha");
		captchaObj.onSuccess(function () {
			captchaHide();
			var validate = captchaObj.getValidate(),
				loginUser = $('#user-login').val();
			var teamname = '',
				email = '';
			if (/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/.test(loginUser)) {
				//  username Login OR email Login
				email = loginUser;
			} else {
				teamname = loginUser;
			}
			
			$.ajax({
				url: "geetest/verifyLogin",
				type: "post",
				dataType: "json",
				data: {
					teamname: teamname,
					email: email,
					password: $('#pass-login').val(),
					geetest_challenge: validate.geetest_challenge,
					geetest_validate: validate.geetest_validate,
					geetest_seccode: validate.geetest_seccode
				},
				success: function (data) {
					if (data && (data.status == "success")) {
						tmpShow(msgtip, data.status, data.message);
						setTimeout(function () {
							window.location.href = 'team';
						}, 500);
					} else {
						tmpShow(msgtip, data.status, data.message);
					}
				}
			});
		});
	};
	
	function tmpShow(ele, status, message) {
		$(ele).empty();
		$(ele).append('<div class="' + status + '">' + message + '</div>');
		$(ele).show();
		var time = 2500;
		if (status == 'success') {
			time = 1500;
		}
		setTimeout(function () {
			$(ele).hide();
		}, time);
	}
	
	/* --- Geetest Mask --- */
	
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
		$(popupCaptcha).empty();
		$(mask).show();
		$(popupCaptcha).show();
	});
	
	$(btnRegister).click(function () {
		$(popupCaptcha).empty();
		$(mask).show();
		$(popupCaptcha).show();
	});
	
});
