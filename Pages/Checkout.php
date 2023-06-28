<?php  
session_start();  
include('connect.php');
include('AutoID_Functions.php');

include('shoppingcartfunction.php');
include('header.php');
if(!isset($_SESSION['cusid']))
{
	echo "<script>window.alert('Please login first to continue.')</script>";
	echo "<script>window.location='Customer_Login.php'</script>";
	exit();
}
else
{
	$CustomerID=$_SESSION['cusid'];
	$query="SELECT * FROM Customer WHERE CustomerID='$CustomerID'";
	$ret=mysqli_query($connection,$query);
	$row=mysqli_fetch_array($ret);
}

if(isset($_POST['btnConfirm'])) 
{

	$rdoDeliveryType=$_POST['rdoDeliveryType'];

	if($rdoDeliveryType == 1) 
	{
		$Address=$_POST['txtAddress'];
		$Phone=$_POST['txtPhone'];
	}
	else
	{
		$Address=$row['Address'];
		$Phone=$row['Phone'];
	}


	

	$txtOrderID=$_POST['txtOrderID'];
	$txtOrderDate=$_POST['txtOrderDate'];
	$txtTotalAmount=$_POST['txtTotalAmount'];
	$txtTotalQuantity=$_POST['txtTotalQuantity'];

	$rdoPaymentType=$_POST['rdoPaymentType'];
	$status="Pending";	
	$rdoDeliveryType=$_POST['rdoDeliveryType'];
	$deliveryaddress=$_POST['txtAddress'];
	$phone=$_POST['txtPhone'];

	$Orderquery="INSERT INTO orders
				(OrderID, CustomerID, TotalQuantity,TotalAmount,Status,PaymentPlan,DeliveryAddress,DeliveryPhone,DeliveryOption) 
				VALUES 
				('$txtOrderID','$CustomerID','$txtTotalQuantity','$txtTotalAmount','$status','$rdoPaymentType','$deliveryaddress','$phone','$rdoDeliveryType')";
	$result=mysqli_query($connection,$Orderquery);

	

	$size=count($_SESSION['ShoppingCartFunctions']);	

	for($i=0;$i<$size;$i++)
	{
		$BookID=$_SESSION['ShoppingCartFunctions'][$i]['BookID'];
		$BuyQty=$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
		$Price=$_SESSION['ShoppingCartFunctions'][$i]['Price'];

		$ODquery="INSERT INTO orderdetail
				  (OrderID, BookID, Quantity, Price) 
				  VALUES
				  ('$txtOrderID','$BookID','$BuyQty','$Price')
				  ";
		$result=mysqli_query($connection,$ODquery);

		$update="Update Book
		         set Quantity=Quantity-'$txtTotalQuantity'
		         Where BookID='$BookID'";
		         $updateret=mysqli_query($connection,$update);
		         
	}

	if($result) 
	{
		unset($_SESSION['ShoppingCartFunctions']);
		echo "<script>window.alert('Checkout Process Completed.')</script>";
		echo "<script>window.location='BookDisplay.php'</script>";
	}
	else
	{
		echo "<p>Something wrong in Checkout :" . mysqli_error($connection) . "</p>";
	}
}
?>
<html>
<head>
	<title>Secure Checkout</title>
	<script type="text/javascript">
		function showPayentTable()
		{
			document.getElementById('PaymentTable').style.visibility="visible";
		}
		function hidePayentTable()
		{
			document.getElementById('PaymentTable').style.visibility="hidden";
		}

		function showAddress()
		{
			document.getElementById('AddressTable').style.visibility="visible";
		}
		function hideAddress()
		{
			document.getElementById('AddressTable').style.visibility="hidden";
		}
	</script>
</head>
<body>
<form action="Checkout.php" method="post">

<fieldset>

<table>
<tr>
	<td>Customer Name</td>
	<td>: 
	<?php echo $_SESSION['cusname'] ?>
	</td>
</tr>

</table>
</fieldset>

<fieldset>
<legend>Checkout Details :</legend>
<table>
<tr>
	<td>Order No</td>
	<td>: 
	<input type="text" name="txtOrderID" value="<?php echo AutoID('orders','OrderID','ORD-',6) ?>" readonly/>
	</td>
</tr>
<tr>
	<td>Order Date</td>
	<td>: 
	<input type="text" name="txtOrderDate" value="<?php echo date('Y-M-d') ?>" readonly/>
	</td>
</tr>
<tr>
	<td>TotalAmount</td>
	<td> :
	<input type="number" name="txtTotalAmount" value="<?php echo CalculateTotalAmount() ?>" readonly/> MMK
	</td>
</tr>


<tr>
	<td>TotalQuantity</td>
	<td> :
	<input type="number" name="txtTotalQuantity" value="<?php echo CalculateTotalQuantity() ?>" readonly/> pcs
	</td>
</tr>

</table>
</fieldset>

<fieldset>
<legend>Payment Details</legend>
<table>
<tr>
	<td>
	Payment Type <br/>
	<input type="radio" name="rdoPaymentType" value="MPU" onClick="showPayentTable()" checked/>MPU
	<input type="radio" name="rdoPaymentType" value="VISA" onClick="showPayentTable()" />VISA
	<input type="radio" name="rdoPaymentType" value="COD" onClick="hidePayentTable()" />Cash on Delivery
	</td>
</tr>
<tr>
	<td>
	<table id="PaymentTable" name="PaymentTable">
	<tr>
		<td>
		Name <small>(as it appears on your card)</small><br/>
		<input type="text" name="txtNameOnCard" placeholder="Eg. Alex Murphy"/> <br/>	
		Card number <small>(no dashes or spaces)</small><br/>
		<input type="text" name="txtNameOnCard" placeholder="Eg. 12345678910"/> <br/>
		
		Security Code <small>(3 on back, Amex : 4 on front)</small> <br/>
		<input type="number" name="txtSecurityCode" placeholder="Eg.123"/> <br/>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Delivery Details</legend>
<table>

<tr>
	<td>
	Delivery Type <br/>
	<input type="radio" name="rdoDeliveryType" value="1" onClick="showAddress()" checked/>Others Address
	<input type="radio" name="rdoDeliveryType" value="2" onClick="hideAddress()" />Same Address
	</td>
</tr>

<tr>
	<td>
	<table id="AddressTable" name="AddressTable">
	<tr>
		<td>
		Deliver Phone : <br/>
		<input type="text" name="txtPhone" placeholder="Enter Phone Number"/> <br/>	
		Deliver Address : <br/>
		<textarea name="txtAddress" placeholder="Enter Address you want to deliver." cols="50"></textarea>
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td>
	<hr/>
	<input type="submit" name="btnConfirm" value="Confirm Order"/>
	<a href="Display.php">Continue Shopping</a>
	</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>(5) Shopping Cart Summary</legend>
<?php  
if(!isset($_SESSION['ShoppingCartFunctions'])) 
{
	echo "<p>Empty Cart.</p>";
	echo "<a href='Customer_Home.php'>Back</a>";
}
else
{
?>
<table border="1">
<tr>
	<th>Image</th>
	<th>ProductID</th>
	<th>Description</th>
	<th>Price</th>
	<th>BuyQuantity</th>
	<th>Sub_Total</th>
	<th>Action</th>
</tr>
<?php
$size=count($_SESSION['ShoppingCartFunctions']);

for($i=0;$i<$size;$i++) 
{ 
	$BookImage=$_SESSION['ShoppingCartFunctions'][$i]['BookImage'];
	$BookID=$_SESSION['ShoppingCartFunctions'][$i]['BookID'];
	$BookName=$_SESSION['ShoppingCartFunctions'][$i]['BookName'];
	$BookAmount=$_SESSION['ShoppingCartFunctions'][$i]['Price'];
	$BuyQty=$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];

	$Sub_Total=$BookAmount * $BuyQty;

	echo "<tr>";
	echo "<td><img src='$BookImage' width='200px' height='200px' /></td>";
	echo "<td>$BookID</td>";
	echo "<td>$BookName</td>";
	echo "<td>$BookAmount MMK</td>";
	echo "<td>$BuyQty pcs</td>";
	echo "<td>$Sub_Total MMK</td>";
	echo "<td>
			<a href='shoppingcart.php?BookID=$BookID&action=Remove'>Remove</a>
		  </td>";
	echo "</tr>";
}
?>
	<tr>
		<td colspan="7" align="right">
			<hr>
			Total Amount : <b><?php echo CalculateTotalAmount() ?></b> MMK <br/>
			
			Total Quantity : <b><?php echo CalculateTotalQuantity() ?> pcs</b>
			<hr>
		</td>
	</tr>
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