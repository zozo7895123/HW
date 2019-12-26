<?php
require_once("dbconfig.php");
//回傳 userOrder 欄位的資料
function getOrderList($uID) {
	global $db;
	$sql = "SELECT ordID, orderDate, status FROM userOrder WHERE uID=?";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "s", $uID); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}
//回傳userOrder的ordID、uID
function getConfirmedOrderList() {
	global $db;
	$sql = "SELECT ordID, uID, orderDate FROM userOrder WHERE status=1";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	//mysqli_stmt_bind_param($stmt, "s", $uID); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}
//取得購物車(未結帳)訂單的ordID
function _getCartID($uID) {
	//get an unfished order (status=0) from userOrder
	global $db;
	$sql = "SELECT ordID FROM userorder WHERE uID=? and status=0";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "s", $uID); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
	$result = mysqli_stmt_get_result($stmt); //get the results
	
	if ($row=mysqli_fetch_assoc($result)) {
		return $row["ordID"];
	} else {
		//當搜尋不到status = 0 的時候，就創造一個新的
		$sql = "insert into userOrder ( uID, status ) values (?,0)";
		$stmt = mysqli_prepare($db, $sql); //prepare sql statement
		mysqli_stmt_bind_param($stmt, "s", $uID); //bind parameters with variables
		mysqli_stmt_execute($stmt);  //執行SQL
		$newordID=mysqli_insert_id($db);
		return $newordID;
	}
}
//添加商品到購物車清單
function addToCart($uID, $prdID) {
	global $db;
	$ordID= _getCartID($uID);
	$sql = "insert into orderItem (ordID, prdID, quantity) values (?,?,1);";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ii", $ordID, $prdID); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
}
//移除掉購物車的商品
function remove($serno) {
	global $db;
	$sql = "delete from orderItem where serno = $serno;";
	mysqli_query($db,$sql) or die("MySQL query error"); 
}
//完成下訂單 把status 變成 1 和 自動輸入下單日期
function checkout($uID, $address) {
	global $db;
	$ordID= _getCartID($uID);
	$sql = "update userorder set orderDate=now(),address=?,status=1 where ordID=?;";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "si", $address, $ordID); //bind parameters with variables
	return mysqli_stmt_execute($stmt);  //執行SQL
}
//更新訂單 status = 2 (管理員確認過的訂單)
function shipout($ordID) {
	global $db;
	$sql = "update userorder set status=2 where ordID=?;";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $ordID); //bind parameters with variables
	return mysqli_stmt_execute($stmt);  //執行SQL
}
//取得加入購物車的商品資料
function getCartDetail($uID) {
	global $db;
	$ordID= _getCartID($uID);
	$sql="select orderItem.serno, product.name, product.price, orderItem.quantity from orderItem, product where orderItem.prdID=product.prdID and orderItem.ordID=?";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $ordID); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}
//回傳訂單的細項
function getOrderDetail($ordID) {
	global $db;
	$sql="select orderItem.serno, product.name, product.price, orderItem.quantity from orderItem, product where orderItem.prdID=product.prdID and orderItem.ordID=?";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $ordID); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}
?>










