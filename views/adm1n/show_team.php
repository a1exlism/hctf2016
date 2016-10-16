<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>
	<table>
	<tr>
		<td>id</td>
		<td>name</td>
		<td>token</td>
		<td>score</td>
		<td>level</td>
		<td>cheat</td>
	</tr>
	<?php foreach( $result as $value ):?>
	<tr>
		<td><?=$value['team_id'];?></td>
		<td><?=$value['team_name'];?></td>
		<td><?=$value['team_token'];?></td>
		<td><?=$value['total_score'];?></td>
		<td><?=$value['compet_level'];?></td>
		<td><?=$value['is_cheat'];?></td>
	</tr>
		<?php endforeach;?>
	</table>

</body>
</html>