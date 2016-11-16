<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HCTF | Mail Active</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/darkly.min.css') ?>">
	<style>
		h1, h2 {
			text-align: center;
		}

		.success {
			color: #5cb85c;
			display: none;
		}

		.error {
			color: #d9534f;
			display: none;
		}

	</style>
</head>
<body>
<h1>Active Page</h1>
<h2 class="success"></h2>
<h2 class="error"></h2>

<script src="<?php echo base_url('assets/js/bootstrap/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/index/mail_active.js') ?>"></script>

</body>
</html> 
