<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>

<form action="/hctf2016/adm1n/team/search" method="post">
	<input type="text" name="team_name" placeholder="id(选填)">
	<input type="text" name="team_token" placeholder="token(选填)">
	<input type="submit" value="search">
</form>
<br/>
<form action="/hctf2016/adm1n/team/ban" method="post">
	<select name="method">
		<option value="team_name">id</option>
		<option value="team_token">token</option>
	</select>
	<input type="text" name="value" >
	<input type="submit" value="ban" >
</form>
<br/>
<form action="/hctf2016/adm1n/team/score" method="post">
	<select name="method">
		<option value="team_name">id</option>
		<option value="team_token">token</option>
	</select>
	<input type="text" name="value" >
	<input type="text" name="score" placeholder="score">
	<input type="submit" value="change score" >
</form>
<br/>
<form action="/hctf2016/adm1n/team/open" method="post">
	<input type="text" name="id" placeholder="challenge_id">
	<input type="submit" value="open">
</form>
<br/>
<form action="/hctf2016/adm1n/team/card" method="post">
	<select name="method">
		<option value="team_name">id</option>
		<option value="team_token">token</option>
	</select>
	<input type="text" name="value" >
	<input type="text" name="id" placeholder="card_num">
	<input type="submit" value="give card">
</form>
<br/>

<a href="/hctf2016/adm1n/web_admin/index">back</a>

</body>
</html>