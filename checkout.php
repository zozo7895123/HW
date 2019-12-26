<?php
session_start();
//check whether the user has logged in or not
if ( ! isSet($_SESSION["loginProfile"] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: loginUI.php");
}
require("orderModel.php");
$address=$_POST['address'];
//完成下訂單 把status 變成 1 和 自動輸入下單日期
if (checkout($_SESSION["loginProfile"]["uID"],$address)) {
	echo "感謝! 訂單處理中..";
} else {
	echo "sorry, internal error, please try again..";	
}
?>
<a href="main.php">OK</a>
