<?php include_once('header.php'); ?>
</head>
<body id="div-login">
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6 vcenter">
			<h1 style="text-align: center">LOGIN</h1>
			<form class="form-horizontal" action="/hctf2016/adm1n/web_admin/login/<?php echo $key ?> "
			      method="post">
				<fieldset>
					<div class="form-group">
						<label for="" class="col-lg-2 control-label">Username</label>
						<div class="col-lg-10">
							<input id="" type="text" class="form-control" name="user" placeholder="Username">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-lg-2 control-label">Password</label>
						<div class="col-lg-10">
							<input id="" type="password" class="form-control" name="pass" placeholder="Password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
</body>
</html>
