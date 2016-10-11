<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>
<h1>LOGIN</h1>
<form action="/hctf2016/adm1n/web_admin/login/<?php echo $key?> " method="post">
	<input type="text" name="user" placeholder="Username">
	<br/>
	<input type="password" name="pass" placeholder="Password">
	<br/>
	<input type="submit" value="login">
</form>
</body>
</html>