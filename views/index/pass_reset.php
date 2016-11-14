<?php
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-11-14
 * Time: 上午1:15
 */
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HCTF | Pass Reset</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/darkly.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/index/forget.css') ?>">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8 vertical-center">
			<div class="form-group" id="pass-reset">
				<h1>Password Reset</h1>
				<div class="input-group">
					<span class="input-group-addon">New Password</span>
					<input type="password" class="form-control" placeholder="******">
					<span class="input-group-btn">
						<button id="submit" class="btn btn-default" type="button">Set</button>
          </span>
				</div>
			</div>
			<div id="msgtip">
				<div class="well well-sm success">
					<p></p>
				</div>
				<div class="well well-sm error">
					<p></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('assets/js/bootstrap/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/geetest/gt.js') ?>"></script>
<script src="<?php echo base_url('assets/js/index/forget.js') ?> "></script>
</body>
</html>

