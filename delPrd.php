<?php
session_start();
//check whether the user has logged in or not
if ( ! isSet($_SESSION["loginProfile"] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: loginUI.php");
}
require("prdModel.php");
$prdID=(int)$_GET['prdID'];

deleteProduct($prdID);
header("Location: prdmain.php");
	
?>

