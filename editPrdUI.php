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
	$prdID=(int)$_GET['prdID'];
	$rs=NULL;
	if($result=getPrdDetail($prdID)) {
		$rs=mysqli_fetch_assoc($result);
	}
	//如果沒有任何的商品項目把 prdID 設成-1 讓 updatePrd.php可以run addProduct的函式
	if (! $rs) {
		$rs['prdID']=-1;
		$rs['name']='';
		$rs['price']=0;
		$rs['detail']='';
	}

?>
<form action="updatePrd.php" method="post">
	<table width="200" border="1">
  <tr>
    <td>id: <input type="hidden" name="prdID" value="<?php echo htmlspecialchars($rs['prdID']);?>"></td></tr>
    <tr><td>name:<input type="text" name="name" value="<?php echo htmlspecialchars($rs['name']);?>"></td></tr>
    <tr><td>price:<input type="text" name="price" value="<?php echo htmlspecialchars($rs['price']);?>"></td></tr>
    <tr><td>detail:<input type="text" name="detail" value="<?php echo htmlspecialchars($rs['detail']);?>"></td></tr>
<tr><td><input type="submit"><td></tr>
</form>

</table>
<a href="prdMain.php">back</a><hr>

</body>
</html>
