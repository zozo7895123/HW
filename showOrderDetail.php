<?php
session_start();
require("orderModel.php");

//check whether the user has logged in or not
if ( ! isSet($_SESSION["loginProfile"] )) {
	//if not logged in, redirect page to loginUI.php
	header("Location: loginUI.php");
}

$ordID=(int)$_GET['ID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Examples</title>
</head>
<body>
<p>Your Order detail is : 
[<a href="logout.php">logout</a>]
</p>
<hr>
<?php
	echo "Hello ", $_SESSION["loginProfile"]["uName"],
	", Your ID is: ", $_SESSION["loginProfile"]["uID"],
	", Your Role is: ", $_SESSION["loginProfile"]["uRole"],"<HR>";
	//把訂單的細項儲入$result
	$result=getOrderDetail($ordID);
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
$total=0;
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

<a href="setShipped.php?id=<?php echo $ordID; ?>">OK, I got it!</a>
<hr>
<a href="admin.php">back</a>
</form>
</body>
</html>
