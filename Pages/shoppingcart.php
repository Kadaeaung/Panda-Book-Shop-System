<?php  
session_start();
include('connect.php');
include('shoppingcartfunction.php');
include('header.php');
if (!isset($_SESSION['cusid'])) 
{
		echo "<script>window.alert('Customer Login First!')</script>";
		echo "<script>window.location='Login.php'</script>";
}
if (isset($_GET['btnadd']))
	 {
	 	$BookID=$_GET['txtBookID'];
	 	echo $Product="SELECT * FROM book 
	  where BookID='$BookID'";
	 $result=mysqli_query($connection,$BooK);
	 $count=mysqli_num_rows($result);
	
	 
	 	 $arr=mysqli_fetch_array($result);
	 	 
	 	 $Quantity=$arr['Product_Quatity'];
	 	 
	 	$BookID=$_GET['txtBookID'];
		$OrderID=$_GET['txtOrderID'];
		$Price=$_GET['txtPrice'];
		$Book_Quantity=$_GET['txtbuyquantity'];
		$BookImage=$_GET['Product_Image'];
		$OrderDate=date('Y/m/d');
		$TotalAmount=$Price*$BuyQuantity;

}

if(isset($_REQUEST['action'])) 
{
	$Action=$_REQUEST['action'];

	if($Action === "buy")
	{
		$BookID=$_REQUEST['txtBookID'];
		$txtbuyquantity=$_REQUEST['txtbuyquantity'];
		AddShoppingCart($BookID,$txtbuyquantity);
	}
	else if($Action === "Remove")
	{
		$BookID=$_REQUEST['BookID'];
		RemoveShoppingCart($BookID);
	}
	else
	{
		ClearShoppingCart();
	}
}
else
{
	$Action="";
}


?>
<html>
<head>
	<title>Shopping Cart</title>
</head>
<body>
<form action="shoppingcart.php" method="get">
<fieldset>
<legend>Your Shopping Cart :</legend>

<?php  
if(!isset($_SESSION['ShoppingCartFunctions'])) 
{
	echo "<p>Shopping Cart is Empty:</p>";
	echo "<a href='Display.php'>Continue Shopping</a>";
}
else
{
?>
<table border="1">
<tr>
	<th>Image</th>
	<th>ID</th>
	<th>BookName</th>
	<th>Price <small>(MMK)</small></th>
	<th>BuyQty <small>(pcs)</small></th>
	<th>Sub-Total <small>(MMK)</small></th>
	<th>Action</th>
</tr>
<?php  
$size=count($_SESSION['ShoppingCartFunctions']);

for ($i=0;$i<$size;$i++) 
{	 
	$BookImage=$_SESSION['ShoppingCartFunctions'][$i]['BookImage'];
	$BookID=$_SESSION['ShoppingCartFunctions'][$i]['BookID'];
	$BookName=$_SESSION['ShoppingCartFunctions'][$i]['BookName'];
	$BookAmount=$_SESSION['ShoppingCartFunctions'][$i]['Price'];
	$BuyQty=$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
	$SubTotal=$_SESSION['ShoppingCartFunctions'][$i]['Price']*$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];

	echo "<tr>";
	echo "<td><img src='$BookImage' width='200px' height='200px'/></td>";
	echo "<td>$BookID</td>";
	echo "<td>$BookName</td>";
		echo "<td>$BookAmount</td>";
	echo "<td>$BuyQty</td>";
	echo "<td>$SubTotal</td>";
	echo "<td><a href='shoppingcart.php?BookID=$BookID&action=Remove'>Remove</a></td>";
	echo "</tr>";
}
?>
<tr>
	<td colspan="7" align="right">
	Sub-Total : <b><?php echo CalculateTotalAmount() ?></b> <br/>

	<hr/>

	<a href="BookDisplay.php">Continue Shopping</a> |
	<a href="Checkout.php">Make Checkout</a> |
	</td>
</tr>
</table>
<?php 
}
?>

</fieldset>

</form>
</body>
</html>
<?php 
include('footer.php');
 ?>