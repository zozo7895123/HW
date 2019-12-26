<?php
session_start();
require("orderModel.php");

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
<title>Examples</title>
</head>
<body>
<p>This is the Shopping Cart Detail 
[<a href="logout.php">logout</a>]
</p>
<hr>
<?php
    //印出會員資料
	echo "Hello ", $_SESSION["loginProfile"]["uName"],
	", Your ID is: ", $_SESSION["loginProfile"]["uID"],
	", Your Role is: ", $_SESSION["loginProfile"]["uRole"],"<HR>";
	//把購物車清單存入$result
	$result=getCartDetail($_SESSION["loginProfile"]["uID"]);
?>
<a href="showOrders.php">List My Orders</a><hr>
	<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>Prd Name</td>
    <td>price</td>
    <td>Quantity</td>
    <td>Amount</td>
	<td>-</td>
  </tr>
<?php
$total=0;
//印出購物車商品細項 + 總共花費
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['serno'] . "</td>";
	echo "<td>{$rs['name']}</td>";
	echo "<td>" , $rs['price'], "</td>";
	echo "<td>" , $rs['quantity'], "</td>";
	$total += $rs['quantity'] *$rs['price'];
	echo "<td>" , $rs['quantity'] *$rs['price'] , "</td>";
	echo "<td><a href='removeFromCart.php?serno=" , $rs['serno'] , "'>Remove</a></td></tr>";
}
echo "<tr><td>Total: $total</td></tr>";
?>
</table>
<hr>
<a href="confirmOrder.php">Yes Checkout</a>  <a href="main.php">No, keep shopping</a>
</body>
</html>
