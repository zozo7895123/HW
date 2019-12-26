<?php
session_start();
require("prdModel.php");

//檢查使用者是否有登入
if ( ! isSet($_SESSION["loginProfile"] )) {
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
    //呼叫userModel的getUserProfile所創的陣列的值
	echo "Hello ", $_SESSION["loginProfile"]["uName"],
	", Your ID is: ", $_SESSION["loginProfile"]["uID"],
	", Your Role is: ", $_SESSION["loginProfile"]["uRole"],"<HR>";
	//把資料庫的商品資料儲存到$result
	$result=getPrdList();
?>
<a href="showOrders.php">List My Orders</a><hr>
	<table width="200" border="1">
  <tr>
    <!--商品品項-->
    <td>id</td>
    <td>name</td>
    <td>price</td>
    <td>+</td>
  </tr>
<?php
//讀取DB的資料以字串當索引
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['prdID'] . "</td>";
	echo "<td>{$rs['name']}</td>";
	echo "<td>" , $rs['price'], "</td>";
	echo "<td><a href='addToCart.php?prdID=" , $rs['prdID'] , "'>Add</a></td></tr>";
}
?>
</table>
<a href="showCartDetail.php">Checkout cart</a><hr>

</body>
</html>
