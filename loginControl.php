<?php
session_start();
require("userModel.php");
//接收loginUI.php 傳的ID PWD
$ID=$_POST['ID'];
$pwd=$_POST['PWD'];
//把user資料儲存到全域的$_SESSION['loginProfile']
$_SESSION['loginProfile'] = getUserProfile( $ID, $pwd);
//如果輸入的資料可以從資料庫取得就可以登入
if (getUserProfile( $ID, $pwd)) {
	//判斷是不是admin
	if ($_SESSION['loginProfile']['uRole']==9) {
		header("Location: admin.php");
	} else {
		header("Location: main.php");
	}
} else {
	echo "login failed <br>";
	echo "<a href='loginUI.php'>Login again</a>";
}
?>
