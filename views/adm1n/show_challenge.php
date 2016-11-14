<div class="row">
	<div class="col-md-offset-2 col-md-8">

		<table class="table table-hover">
			<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>type</th>
				<th>score</th>
				<th>description</th>
				<th>level</th>
				<th>hit</th>
				<th>api</th>
				<th>threshold</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($result as $value): ?>
				<tr>
					<td><a
							href="/hctf2016/adm1n/challenge/detail/<?= $value['challenge_id']; ?>"><?= $value['challenge_id']; ?></a>
					</td>
					<td><?= $value['challenge_name']; ?></td>
					<td><?= $value['challenge_type']; ?></td>
					<td><?= $value['challenge_score']; ?></td>
					<td><?= $value['challenge_description']; ?></td>
					<td><?= $value['challenge_level']; ?></td>
					<td><?= $value['challenge_hit']; ?></td>
					<td><?= $value['challenge_api']; ?></td>
					<td><?= $value['challenge_threshold']; ?></td>
				</tr>
			<?php endforeach; ?>


			</tbody>
		</table>

	</div>
</div>

<!---->
<!--	<tr>-->
<!--		<td>id</td>-->
<!--		<td>name</td>-->
<!--		<td>type</td>-->
<!--		<td>score</td>-->
<!--		<td>description</td>-->
<!--		<td>level</td>-->
<!--		<td>hit</td>-->
<!--		<td>api</td>-->
<!--		<td>threshold</td>-->
<!--	</tr>-->

