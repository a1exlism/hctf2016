<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login/Register | HCTF 2016</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/index/user_login.css') ?>">
</head>
<body class="container-fluid" style="padding:0;">
<div id="particles-js"></div>
<!-- Navigation Bar -->
<nav id="navbar" class="navbar navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a class="navbar-brand" href="about">About</a>
		</div>
	</div>
</nav>
<!-- login/register -->
<div class="row" id="login-div">
	<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
		<!-- 添加面板 -->
		<div class="panel panel-login">
			<div class="panel-body">
				<!-- panel header -->
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6" style="border-right: 1px solid rgba(255,255,255, 0.35);">
							<a href="#" class="active" id="login-form-link">Login</a>
						</div>
						<div class="col-xs-6">
							<a href="#" class="" id="register-form-link">Register</a>
						</div>
					</div>
					<hr>
				</div>
				<!-- panel body -->
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-8 col-xs-offset-2 col-md-8 col-md-offset-2">
							<!-- Login -->
							<!--								<form id="form-login" action="User_ajax/login_check" method="post" role="form">-->
							<form id="form-login" action="login/login" method="post" role="form">
								<div class="form-group">
									<input type="text" class="form-control" name="teamname" id="user-login" placeholder="Teamname"
									       tabindex="1">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password" id="pass-login" placeholder="Password"
									       tabindex="2">
								</div>
								<!--
										<div class="form-group text-center">
											<input type="checkbox" tabindex="3" name="remember" id="remember" style="display:none">
											<label for="remember" onselectstart="return false;">Remember Me</label>
										</div>
								-->
								<div class="form-group">
									<div class="row">
										<div class="col-xs-8 col-xs-offset-2 col-lg-10 col-lg-offset-1">
											<!--											<input type="submit" value="Login In" id="cover-submit-login"-->
											<input type="button" value="Login In" id="cover-submit-login"
											       tabindex="3" class="btn btn-success form-control">
										</div>

									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-12">
											<div class="text-center">
												<a href="forget" class="forget-password">Forget Password?</a>
											</div>
										</div>
									</div>
									<!-- msgtip Login -->
									<div class="msgtip">
										<div class="msgtip-success-login">
											<p>Login success</p>
										</div>
										<div class="msgtip-fail-login">
											<p>Login failed.</p><br>
											<p>Wrong username || password</p>
										</div>
										<div class="geetest-fail">
											<p>Login failed.</p><br>
											<p>极验HTTP500,请重试.</p>
										</div>
									</div>
								</div>
							</form>
							<!-- Register -->
							<form id="form-register" action="login/register" method="post" role="form">
								<div class="form-group">
									<input type="text" name="teamname" id="user-register" tabindex="1" class="form-control"
									       placeholder="Team Name" value=""/></div>
								<div class="form-group">
									<input type="text" name="school" id="school" tabindex="2" class="form-control"
									       placeholder="School Name" value=""/></div>
								<div class="form-group">
									<input type="email" name="email" id="email" tabindex="3" class="form-control"
									       placeholder="Email Address" value=""/></div>
								<div class="form-group">
									<input type="password" name="password" id="pass-register" tabindex="4" class="form-control"
									       placeholder="Password"/></div>
								<div class="form-group">
									<input type="password" name="password-confirm" id="password-confirm" tabindex="5" class="form-control"
									       placeholder="Confirm Password"/></div>
								<div class="form-group">
									<input type="text" name="phone" id="phone" tabindex="6" class="form-control"
									       placeholder="Phone Number" value=""/></div>

								<div class="form-group">
									<div class="row">
										<div class="col-xs-8 col-xs-offset-2 col-md-8 col-md-offset-2">
											<input type="button" id="cover-submit-register" tabindex="7"
											       class="form-control btn btn-primary" value="Register Now"/>
										</div>
										<!-- msgtip register -->
										<div class="msgtip">
											<div class="msgtip-success-register">
												<p>Register success</p>
											</div>
											<div class="msgtip-fail-register">
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="mask"></div>
<div id="popup-captcha"></div>

<!-- bootstrap & jquery -->
<script src="<?php echo base_url('assets/js/bootstrap/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js') ?>"></script>

<!-- 极验: 引入封装了failback的接口--initGeetest -->
<script src="<?php echo base_url('assets/js/geetest/gt.js') ?>"></script>

<!-- background & self_config -->
<script src="<?php echo base_url('assets/js/index/particles.js') ?> "></script>
<script src="<?php echo base_url('assets/js/index/user_login.js') ?> "></script>
</body>
</html>
