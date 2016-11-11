<?php
//echo json_encode($this->data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Team | <?php echo($this->data['name']); ?> </title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/darkly.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/index/teams.css') ?>">
</head>
<body>
<div class="contriner">
	<div class="row">
		<h1><?php echo $this->data['name']; ?></h1>
		<div class="col-md-offset-1 col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Basic Info</h3>
				</div>
				<div class="panel-body basic-info">
					<ul class="list-group">
						<li class="list-group-item">
							<!--							<span class="badge">14</span>-->
							<span>Team name: </span><span><?php echo $this->data['name']; ?></span>
						</li>
						<li class="list-group-item">
							<span>School : </span><span><?php echo $this->data['school']; ?></span>
						</li>
						<li class="list-group-item">
							<span>Score: </span><span><?php echo $this->data['score']; ?></span>
						</li>
						<li class="list-group-item">
							<span>Level: </span><span><?php echo $this->data['level']; ?></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-offset-1 col-md-5">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Team solved</h3>
				</div>
				<div class="panel-body solved-info">
					<table class="table table-hover">
						<?php
						foreach ($this->data['solved'] as $key => $val) {
							echo "<li>Solved ".$val['chaName']."[".$val['chaScore']."] at ".$val['solvedTime'];
						}
						?>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
</body>
</html>
