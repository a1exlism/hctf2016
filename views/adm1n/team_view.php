<?php include_once('header.php'); ?>
	</head>
	<body>
	<div class="container">
		<div class="row">

			<div class="bs-component">

				<ul class="nav nav-tabs">
					<li class="active"><a href="#search" data-toggle="tab" aria-expanded="true">Search</a></li>
					<li class=""><a href="#ban" data-toggle="tab" aria-expanded="false">Ban</a></li>
					<li class=""><a href="#score" data-toggle="tab" aria-expanded="false">Score</a></li>
					<li class=""><a href="#challenge" data-toggle="tab" aria-expanded="false">Challenge</a></li>
					<li class=""><a href="#card" data-toggle="tab" aria-expanded="false">Card</a></li>
					<li><a class="btn btn-default" href="/hctf2016/adm1n/web_admin/index">Back to index</a></li>
				</ul>

				<div id="myTabContent" class="tab-content col-md-offset-2 col-md-8">

					<div class="tab-pane fade active in" id="search">
						<form class="form-horizontal" action="/hctf2016/adm1n/team/search" method="post">
							<fieldset>
								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Id(optional)</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="team_name">
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Token(optional)</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="team_token">
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>


					<div class="tab-pane fade" id="ban">
						<form class="form-horizontal" action="/hctf2016/adm1n/team/ban" method="post">
							<fieldset>
								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Option</label>
									<div class="col-lg-10">
										<select class="form-control" id="" name="method">
											<option>team_name</option>
											<option>team_token</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Value</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="value">
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button type="submit" class="btn btn-primary">Ban</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>


					<div class="tab-pane fade" id="score">
						<form class="form-horizontal" action="/hctf2016/adm1n/team/score" method="post">
							<fieldset>
								<div class="form-group">
									<div class="col-lg-10">
										<label for="" class="col-lg-2 control-label">Option</label>
										<select class="form-control" id="">
											<option>Team Name</option>
											<option>Team Token</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10">
										<label for="" class="col-lg-2 control-label">Value</label>
										<input type="text" class="form-control" name="value">
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10">
										<label for="" class="col-lg-2 control-label">Score</label>
										<input type="text" class="form-control" name="score">
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button type="submit" class="btn btn-primary">Score change</button>
									</div>
								</div>

							</fieldset>
						</form>
					</div>

					<div class="tab-pane fade" id="challenge">
						<form class="form-horizontal" action="/hctf2016/adm1n/team/open" method="post">
							<fieldset>
								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Challenge ID</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="id">
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button type="submit" class="btn btn-primary">Open</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>

					<div class="tab-pane fade" id="card">
						<form class="form-horizontal" action="/hctf2016/adm1n/team/card" method="post">
							<fieldset>
								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Option</label>
									<div class="col-lg-10">
										<select class="form-control" id="" name="method">
											<option>Team Name</option>
											<option>Team Token</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Value</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="" name="value">
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-lg-2 control-label">Card No</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="id">
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button type="submit" class="btn btn-primary">Give card</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>

				</div>
			</div>

		</div>
	</div>
<?php include_once('footer.php'); ?>