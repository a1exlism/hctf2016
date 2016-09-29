<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>
<?php foreach( $result as $value ):?>
	<table>
	<tr>
		<td>id:</td>
		<td> <?=$value['challenge_id'];?> </td>
	</tr>
	<tr>
		<td>score:</td>
		<td><?=$value['challenge_score'];?></td>
	</tr>
	<tr>
		<td>description</td>
		<td><?=$value['challenge_description']?></td>
	</tr>
	<tr>
		<td>level</td>
		<td><?=$value['challenge_level'];?></td>
	</tr>
	<tr>
		<td>hit</td>
		<td><?=$value['challenge_hit'];?></td>
	</tr>
	<tr>
		<td>api</td>
		<td><?=$value['challenge_api'];?></td>
	</tr>
	</table>
	<hr />
	<?php endforeach;?>
</body>
</html>