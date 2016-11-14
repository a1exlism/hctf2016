<div class="row">
	<div class="col-md-offset-2 col-md-8">

		<table class="table table-hover">
			<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>token</th>
				<th>score</th>
				<th>level</th>
				<th>cheat</th>
			</tr>
			</thead>
			<tbody>

			<?php foreach ($result as $value): ?>
				<tr>
					<td><?= $value['team_id']; ?></td>
					<td><?= $value['team_name']; ?></td>
					<td><?= $value['team_token']; ?></td>
					<td><?= $value['total_score']; ?></td>
					<td><?= $value['compet_level']; ?></td>
					<td><?= $value['is_cheat']; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>
