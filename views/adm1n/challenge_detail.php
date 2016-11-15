<?php include_once('header.php'); ?>
</head>
<body>

<div id="admin" class="container">
	<div class="row">
		<div class="bs-component">

			<ul class="nav nav-tabs">
				<!--				<li class="active"><a href="#show" data-toggle="tab" aria-expanded="true">Show</a></li>-->
				<li><a class="btn btn-default" href="/hctf2016/adm1n/web_admin/admin">Back to admin</a></li>
			</ul>

			<div id="myTabContent" class="tab-content col-md-offset-2 col-md-8">
				<div class="tab-pane fade active in">
					<form class="form-horizontal" name="d_form" method="post">
						<fieldset>
							<div class="col-lg-10">
								<div class="form-group">
									<label for="" class="col-lg-2 control-label">ID</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="id"
										       value=<?php echo '"' . $result[0]['challenge_id'] . '"'; ?>>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Name</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="name"
										       value=<?php echo '"' . $result[0]['challenge_name'] . '"'; ?>>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Type</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="type"
										       value=<?php echo '"' . $result[0]['challenge_type'] . '"'; ?>>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Score</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="score"
										       value=<?php echo '"' . $result[0]['challenge_score'] . '"'; ?>>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Description</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="description"
										       value=<?php echo '"' . $result[0]['challenge_description'] . '"'; ?>>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Level</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="level"
										       value=<?php echo '"' . $result[0]['challenge_level'] . '"'; ?>>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Hint</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="hit"
										       value=<?php echo '"' . $result[0]['challenge_hit'] . '"'; ?>>
									</div>
								</div>


								<div class="form-group">
									<label for="" class="col-lg-2 control-label">API</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="api"
										       value=<?php echo '"' . $result[0]['challenge_api'] . '"'; ?>>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Threshold</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="threshold"
										       value=<?php echo '"' . $result[0]['challenge_threshold'] . '"'; ?>>
									</div>
								</div>
								<!--
								id: <input type="text" name="id" value=
									<?php /*echo '"' . $result[0]['challenge_id'] . '"'; */ ?>>
								<br>
								name:<input type="text" name="name" value=
									<?php /*echo '"' . $result[0]['challenge_name'] . '"'; */ ?>>
								<br>
								type:<input type="text" name="type" value=
									<?php /*echo '"' . $result[0]['challenge_type'] . '"'; */ ?>>
								<br>
								score:<input type="text" name="score" value=
									<?php /*echo '"' . $result[0]['challenge_score'] . '"'; */ ?>>
								<br>
								description:<input type="text" name="description" value=
									<?php /*echo '"' . $result[0]['challenge_description'] . '"'; */ ?>>
								<br>
								level:<input type="text" name="level" value=
									<?php /*echo '"' . $result[0]['challenge_level'] . '"'; */ ?>>
								<br>
								hit:<input type="text" name="hit" value=
									<?php /*echo '"' . $result[0]['challenge_hit'] . '"'; */ ?>>
								<br>
								api:<input type="text" name="api" value=
									<?php /*echo '"' . $result[0]['challenge_api'] . '"'; */ ?>>
								<br>
								threshold:<input type="text" name="threshold" value=
									<?php /*echo '"' . $result[0]['challenge_threshold'] . '"'; */ ?>>
								<br>-->

								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btn btn-info" onclick= _update()>UPDATE</button>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn btn-danger" onclick= _delete()>DELETE</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>


<script type="text/javascript">
	
	function _update() 
	{
		document.d_form.action = "/hctf2016/adm1n/challenge/change";
		document.d_form.submit();
	}

	function _delete() 
	{
		document.d_form.action = "/hctf2016/adm1n/challenge/delete";
		document.d_form.submit();
	}
	
</script>
<?php include_once('footer.php'); ?>

