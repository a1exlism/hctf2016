<?php include_once('header.php'); ?>
</head>
<body>
<div class="container">
	<div class="row">

		<div class="bs-component">

			<ul class="nav nav-tabs">
				<li class="active"><a href="#insert" data-toggle="tab" aria-expanded="true">Insert</a></li>
				<li class=""><a href="#change" data-toggle="tab" aria-expanded="false">Change</a></li>
				<li class=""><a href="#delete" data-toggle="tab" aria-expanded="false">Delete</a></li>
				<li><a class="btn btn-default" href="/hctf2016/adm1n/web_admin/index">Back to index</a></li>
			</ul>

			<div id="myTabContent" class="tab-content col-md-offset-2 col-md-8">

				<div class="tab-pane fade active in" id="Insert">
					<form class="form-horizontal" action="/hctf2016/adm1n/info/add">
						<fieldset>
							<div class="form-group">
								<label for="" class="col-lg-2 control-label">Message</label>
								<div class="col-lg-10">
									<input name="message" type="text" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button type="submit" class="btn btn-primary">Insert</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>

				<div class="tab-pane fade" id="change">
					<form class="form-horizontal" action="/hctf2016/adm1n/info/change">
						<fieldset>
							<div class="form-group">
								<label for="" class="col-lg-2 control-label">Bulletin ID</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="c_id">
								</div>
							</div>
							
							<div class="form-group">
								<label for="" class="col-lg-2 control-label">New Message</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="c_message">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>

				<div class="tab-pane fade" id="delete">
					<form class="form-horizontal" action="/hctf2016/adm1n/info/delete">
						<fieldset>

							<div class="form-group">
								<label for="" class="col-lg-2 control-label">Bulletin ID</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="id">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button type="submit" class="btn btn-primary">Delete</button>
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


