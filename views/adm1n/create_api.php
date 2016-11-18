<?php include_once('header.php'); ?>
</head>
<body>
<div class="container">
	<div class="row">

		<div class="bs-component">

			<ul class="nav nav-tabs">
				<li class="active"><a href="#create" data-toggle="tab" aria-expanded="true">Create</a></li>
				<li class=""><a href="#joinJSON" data-toggle="tab" aria-expanded="true">Join JSON</a></li>
				<li><a class="btn btn-default" href="/hctf2016/adm1n/web_admin/index">Back to index</a></li>
			</ul>

			<div id="myTabContent" class="tab-content col-md-offset-2 col-md-8">

				<div class="tab-pane fade active in" id="create">
					<form class="form-horizontal" action="/hctf2016/adm1n/createapi/api" method="post">
						<fieldset>
							<div class="form-group">
								<label for="" class="col-lg-2 control-label">API name</label>
								<div class="col-lg-10">
									<input name="apiname" type="text" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label for="" class="col-lg-2 control-label">Flag</label>
								<div class="col-lg-10">
									<input name="flag" type="text" class="form-control">
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

				<div class="tab-pane fade in" id="joinJSON">
					<form class="form-horizontal" action="/hctf2016/adm1n/createapi/join_json" method="post">
						<fieldset>

							<div class="form-group">
								<label for="" class="col-lg-2 control-label">Challenge ID</label>
								<div class="col-lg-10">
									<input name="id" type="text" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label for="" class="col-lg-2 control-label">File Name</label>
								<div class="col-lg-10">
									<input name="json" type="text" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button type="submit" class="btn btn-primary">Join JSON</button>
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
