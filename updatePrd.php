<?php
session_start();
//check whether the user has logged in or not
if ( ! isSet($_SESSION["loginProfile"] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: loginUI.php");
}
require("prdModel.php");
$prdDetail=array('prdID' => (int)$_POST['prdID'], 'name' => $_POST['name'],
				 'price' => (int)$_POST['price'],'detail' => $_POST['detail']);
$prdID = (int)$_POST['prdID'];
if ($prdID > 0 ) {
	updateProduct($prdID, $prdDetail);
} else {
	addProduct($prdDetail);
}
header("Location: prdmain.php");
?>

