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
[<a href="logout.php">logout</a>]
<p>Your Order detail is : 
</p>
<hr>
<?php
    //印出用戶資料
	echo "Hello ", $_SESSION["loginProfile"]["uName"],
	", Your ID is: ", $_SESSION["loginProfile"]["uID"],
	", Your Role is: ", $_SESSION["loginProfile"]["uRole"],"<HR>";
?>

	<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>Prd Name</td>
    <td>price</td>
    <td>Quantity</td>
    <td>Amount</td>
  </tr>
<?php
$result=getCartDetail($_SESSION["loginProfile"]["uID"]);
$total=0;
//印出每個購物車商品明細
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['serno'] . "</td>";
	echo "<td>{$rs['name']}</td>";
	echo "<td>" , $rs['price'], "</td>";
	echo "<td>" , $rs['quantity'], "</td>";
	$total += $rs['quantity'] *$rs['price'];
	echo "<td>" , $rs['quantity'] *$rs['price'] , "</td>";
	echo "</tr>";
}
echo "<tr><td>Total: $total</td></tr>";
?>
</table>
<!--輸入寄送地址-->
<hr>
<form action="checkout.php" method="post">
請輸入寄送地址: <input type="text" name="address"><br>
<input type="submit">
<a href="main.php">No, keep shopping</a>
</form>
</body>
</html>
