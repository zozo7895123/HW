<?php
require_once("dbconfig.php");
//會回傳user的資料 
function getUserProfile($ID, $passWord) {
	global $db;
	$sql = "SELECT name, role  FROM user WHERE ID=? and password=?";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ss", $ID, $passWord); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
			
	if ($row=mysqli_fetch_assoc($result)) {
		//return user profile
		$ret=array('uID' => $ID, 'uName' => $row['name'], 'uRole' => $row['role']);
	} else {
		//ID, password are not correct
		$ret=NULL;
	}
	return $ret;

}

//註冊新用戶
function addUser($id, $password){
	global $db;
	$sql = "insert into user (ID, password, name, role) values (?,?,'客戶',1);";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ss", $id, $password);
	mysqli_stmt_execute($stmt); 
	
}
//獲取userID去判斷是否有ID重複
function userID($ID) {
	global $db;
	$sql = "SELECT ID FROM user";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_execute($stmt);  //執行SQL
    $result = mysqli_stmt_get_result($stmt); //get the results
	return $result;
}

?>










