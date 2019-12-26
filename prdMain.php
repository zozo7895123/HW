<?php
session_start();
require("prdModel.php");

//check whether the user has logged in or not
if ( ! isSet($_SESSION["loginProfile"] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: loginUI.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Basic HTML Examples</title>
</head>
<body>
<p>This is the MAIN page 
[<a href="logout.php">logout</a>]

</p>
<hr>
<?php
	echo "Hello ", $_SESSION["loginProfile"]["uName"],
	", Your ID is: ", $_SESSION["loginProfile"]["uID"],
	", Your Role is: ", $_SESSION["loginProfile"]["uRole"],"<HR>";
	//把商品資料存入$result
	$result=getPrdList();
?>
	<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>price</td>
    <td>+</td>
  </tr>
<?php
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['prdID'] . "</td>";
	echo "<td>{$rs['name']}</td>";
	echo "<td>" , $rs['price'], "</td>";
	echo "<td><a href='editPrdUI.php?prdID=" , $rs['prdID'] , "'>Edit</a> --";
	echo "<a href='delPrd.php?prdID=" , $rs['prdID'] , "'>Delete</a></td></tr>";
}
?>
</table>
<?php
echo "<a href='editPrdUI.php?prdID=" , $rs['prdID'] , "'>add new product</a>";
echo "<a href='admin.php'>---Back to admin Page</a>";
?>

</body>
</html>
