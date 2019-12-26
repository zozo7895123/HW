<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login UI</title>
</head>
<body>
<p>Login UI</p>
<hr>
<p>Enter ID and Password to login</p>
<!-- 把 ID、PWD 傳到loginControl.php -->
<form method="post" action="loginControl.php" >
ID: <input type="text" name="ID" > <br>
Password: <input type="password" name="PWD" > <br>
<input type="submit">
<a href="registerUI.php">addUser</a><hr>
</form>
<hr>
</body>
</html>
