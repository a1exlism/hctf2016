<?php include_once('header.php'); ?>
</head>
<body>
<div id="admin" class="container">
	<div class="row">

		<div class="bs-component">

			<ul class="nav nav-tabs">
				<li class="active"><a href="#show" data-toggle="tab" aria-expanded="true">Show</a></li>
				<li class=""><a href="#add" data-toggle="tab" aria-expanded="false">Add</a></li>

				<li><a class="btn btn-default" href="/hctf2016/adm1n/web_admin/admin">Back to admin</a></li>
			</ul>

			<div id="myTabContent" class="tab-content col-md-offset-2 col-md-8">

				<div class="tab-pane fade active in" id="show">

					<form class="form-horizontal" action="/hctf2016/adm1n/challenge/show" method="post">
						<fieldset>
							<div class="form-group">
								<label for="" class="col-lg-2 control-label">Id(optional)</label>
								<div class="col-lg-10">
									<input type="text" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button type="submit" class="btn btn-primary">Show</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>

				<div class="tab-pane fade" id="add">
					<form class="form-horizontal" action="/hctf2016/adm1n/challenge/add" method="post">
						<fieldset>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="name" placeholder="name">
								<input type="text" class="form-control" name="type" placeholder="type">
								<input type="text" class="form-control" name="score" placeholder="score">
								<input type="text" class="form-control" name="description" placeholder="description">
								<input type="text" class="form-control" name="level" placeholder="level">
								<input type="text" class="form-control" name="threshold" placeholder="threshold(选填)">
								<input type="text" class="form-control" name="hit" placeholder="hit(选填)">
								<input type="text" class="form-control" name="api" placeholder="api(选填)">
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button type="submit" class="btn btn-primary">Insert</button>
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


<?php include_once('footer.php'); ?>
