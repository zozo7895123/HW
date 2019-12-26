<?php
session_start();
include("dbconfig.php");
require("userModel.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Basic HTML Examples</title>
</head>
<body>
<?php
$ID=$_POST['ID'];
$PWD=$_POST['PWD'];
//用來判斷帳號是否重複
$result=userID($ID);
$error = 0;
while (	$rs=mysqli_fetch_assoc($result)) {
    if($rs['ID'] == $ID){
        $error = 1;
        break;
    }
}
if($error == 1){
    echo"there is same ID";
} else{
    echo"sucess";
}
addUser($ID,$PWD);
?>
<a href="loginUI.php">    Back to login Page</a>
</body>
</html>
