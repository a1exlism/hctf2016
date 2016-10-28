<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<script type="text/javascript">
function _update()
{
document.form.action="/hctf2016/adm1n/challenge/change";
document.form.submit();
}
function _delete()
{
document.form.action="/hctf2016/adm1n/challenge/delete";
document.form.submit();
}
</script>
</head>

<body>

<form name="form" method="post">
	<input type="text" name="id" value=<?php echo '"'.$result[0]['challenge_id'].'"';?>>
	<br>
	<input type="text" name="name" value=<?php echo '"'.$result[0]['challenge_name'].'"';?>>
	<br>
	<input type="text" name="type" value=<?php echo '"'.$result[0]['challenge_type'].'"';?>>
	<br>
	<input type="text" name="score" value=<?php echo '"'.$result[0]['challenge_score'].'"';?>>
	<br>
	<input type="text" name="description" value=<?php echo '"'.$result[0]['challenge_description'].'"';?>>
	<br>
	<input type="text" name="level" value=<?php echo '"'.$result[0]['challenge_level'].'"';?>>
	<br>
	<input type="text" name="hit" value=<?php echo '"'.$result[0]['challenge_hit'].'"';?>>
	<br>
	<input type="text" name="api" value=<?php echo '"'.$result[0]['challenge_api'].'"';?>>
	<br>
	<input type="text" name="api" value=<?php echo '"'.$result[0]['challenge_tres'].'"';?>>
	<br>
	<input type="button" value="UPDATE" onclick=_update()>
	<input type="button" value="DELETE" onclick=_delete()>
</form>
</html>