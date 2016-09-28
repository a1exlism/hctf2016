<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>
<form action="/hctf2016/adm1n/info/add" method="post">
	<input type="text" name="message" placeholder="input new message">
	<input type="submit" value="INSERT">
</form>
<br />
<form action="/hctf2016/adm1n/info/delete" method="post">
	<input type="text" name="id" placeholder="input bulletin_id">
	<input type="submit" value="DELETE">
</form>
<br />
<form action="/hctf2016/adm1n/info/change" method="post">
	<input type="text" name="c_id" placeholder="input bulletin_id">
	<input type="text" name="c_message" placeholder="input new message">
	<input type="submit" value="CHANGE">
</form>
<br />
<a href="/hctf2016/adm1n/web_admin/admin">back</a>
</body>
</html>