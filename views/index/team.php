<?php
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-10-18
 * Time: 上午12:41
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Team | HCTF 2016</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/index/team.css') ?>">
</head>
<body>
<!--	Navigation Bar  -->

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/hctf2016/">HCTF 2016</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a id="toggle-settings" href="#">Dashboard</a></li>
				<li><a id="toggle-bulletin" href="#">Bulletin</a></li>
				<li><a id="toggle-challenge" href="#">Challenge</a></li>
				<li><a id="toggle-rank" href="#">Ranking</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a id="toggle-time">Countdown: <span>Timing</span></a></li>
				<li class="dropdown">
					<a href="javascript:0" class="dropdown-toggle" data-toggle="dropdown"><span
							id="team-name">TeamName</span><span
							class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="team/logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div id="main-container">
	</div>

	<!-- bootstrap & jquery -->
	<script src="<?php echo base_url('assets/js/bootstrap/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js') ?>"></script>

	<script src="<?php echo base_url('assets/js/index/team_main.js') ?>"></script>
</body>
</html>
