<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>
<form action="/hctf2016/adm1n/challenge/show" method="post">
	<input type="text" name="id" placeholder="id(选填)">
	<input type="submit" value="SHOW" >
</form>

<br />

<form action="/hctf2016/adm1n/challenge/add" method="post">
	<input type="text" name="score" placeholder="score">
	<input type="text" name="description" placeholder="description">
	<input type="text" name="level" placeholder="level">
	<input type="text" name="hit" placeholder="hit(选填)">
	<input type="text" name="api" placeholder="api(选填)">
	<input type="submit" value="INSERT">
</form>

<br />

<form action="/hctf2016/adm1n/challenge/change" method="post">
	<input type="text" name="id" placeholder="id">
	<input type="text" name="score" placeholder="score(选填)">
	<input type="text" name="description" placeholder="description(选填)">
	<input type="text" name="level" placeholder="level(选填)">
	<input type="text" name="hit" placeholder="hit(选填)">
	<input type="text" name="api" placeholder="api(选填)">
	<input type="submit" value="UPDATE">
</form>

<br />

<form action="/hctf2016/adm1n/challenge/delete" method="post">
	<input type="text" name="id" placeholder="id">
	<input type="submit" value="DELETE" >
</form>

<br />

<a href="/hctf2016/adm1n/web_admin/admin">back</a>

</body>
</html>