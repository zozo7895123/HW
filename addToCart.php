<?php
session_start();
//check whether the user has logged in or not
if ( ! isSet($_SESSION["loginProfile"] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: loginUI.php");
}
require("orderModel.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Basic HTML Examples</title>
</head>
<body>
<?php
//取得哪個使用者
$uID=$_SESSION['loginProfile']['uID'];
//取得添加商品的ID
$prdID=(int)$_GET['prdID'];
addToCart($uID,$prdID);
header("Location: main.php");
?>

<a href="main.php">Back to main Page</a>

</body>
</html>
