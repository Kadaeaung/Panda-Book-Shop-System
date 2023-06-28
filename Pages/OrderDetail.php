<?php  
session_start(); 
include('connect.php');
include('header.php');
//include('AutoID.php');

if(isset($_POST['btnConfirm'])) 
{
	$txtOrder_ID=$_POST['txtOrder_ID'];

	$query=mysqli_query($connection,"SELECT * FROM orderdetail WHERE OrderID='$txtOrder_ID'");

	while($row=mysqli_fetch_array($query)) 
	{
		$Product_ID=$row['ProductID'];
		$Quantity=$row['Product_Quantity'];

		$Update="UPDATE Product
				 SET Product_Quantity=Product_Quantity - '$Quantity'
				 WHERE ProductID='$ProductID'
				 ";
		$ret=mysqli_query($connection,$Update);
		if(!$ret) 
		{
echo "<script>window.alert('Orders are successfully Confirmed')</script>";
		echo "<script>window.location='OrderList.php'</script>";		}
	}

	$UpdateStatus="UPDATE orders
			 	   SET Status='Confirmed'
			 	   WHERE OrderID='$txtOrder_ID'
			 	   ";
	$ret=mysqli_query($connection,$UpdateStatus);

	if($ret) 
	{
		echo "<script>window.alert('Order are successfully Confirmed')</script>";
		echo "<script>window.location='OrderList.php'</script>";
	}
	else
	{
		echo "<p>Something wrong in Order :" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_GET['Order_ID'])) 
{
	$Order_ID=$_GET['Order_ID'];

	$query1="SELECT o.*, c.CustomerID,c.Customer_Name
			FROM orders o, customer c
			WHERE o.OrderID='$Order_ID'
			AND o.CustomerID=c.CustomerID
			";
	$result1=mysqli_query($connection,$query1);
	$row=mysqli_fetch_array($result1);

	$query2="SELECT o.*, od.*, p.ProductID,p.Product_Name,p.Product_Amount 
			FROM orders o, orderdetail od, Product p
			WHERE o.OrderID='$Order_ID'
			AND o.OrderID=od.OrderID
			AND od.ProductID=p.ProductID
			";
	$result2=mysqli_query($connection,$query2);
	$count=mysqli_num_rows($result2);
}
else
{
	$Order_ID="";
	echo "<script>window.alert('Error 404, No Purchase Order Found.')</script>";
	//echo "<script>window.location='Order_List.php'</script>";
}
include('header.php');
?>
<html>
<head>
	<title>Order Details</title>
</head>
<body>
<form action="OrderDetail.php" method="post">
<fieldset>
<legend>Order Report for : <?php echo $row['OrderID'] ?></legend>

<table align="center">
<tr>
	<td>
		<table align="center" border="1" width="100%">
		<tr>
			<td>
				Order_ID:
				<b><?php echo $row['OrderID'] ?></b>
			</td>
			<td>
				ReportDate:
				<b><?php echo date('Y-M-d') ?></b>
			</td>
		</tr>
		<tr>
			<td>
				CustomerName:
				<b><?php echo $row['Customer_Name'] ?></b>
			</td>
			<td>
				Order_Date:
				<b><?php echo $row['OrderDate'] ?></b>
			</td>
		</tr>
		<tr>
			<td>
				Status:
				<b><?php echo $row['Status'] ?></b>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table border="1" width="100%">
		<tr>
			<th>ProductName</th>
			<th>O_Price (MMK)</th>
			<th>O-Quantity (pcs)</th>
			<th>Sub-Total (MMK)</th>
		</tr>
		<?php  
		for ($i=0; $i < $count; $i++) 
		{ 
			$row2=mysqli_fetch_array($result2);

			echo "<tr>";
			echo "<td>" . $row2['Product_Name'] . "</td>";
			echo "<td>" . $row2['Product_Amount'] . "</td>";
			echo "<td>" . $row2['BuyQuantity'] . " </td>";
			echo "<td>" . $row2['Product_Amount'] * $row2['BuyQuantity']  . "</td>";
			echo "</tr>";
		}
		?>
		</table>
	</td>
</tr>
<tr>
	<td align="right">
	<hr>
	TotalAmount : <b><?php echo $row['TotalAmount'] ?></b> MMK <br/>

	<hr>
	<input type="hidden" name="txtOrder_ID" value="<?php echo $row['OrderID'] ?>"/>
	<?php 
	if($row['Status']==="Pending")
	{
		echo "<input type='submit' name='btnConfirm' value='Confirm'/>";
	}
	else
	{
		echo "<input type='submit' name='btnConfirm' value='Confirm' disabled/>";
	}
	?>
	</td>
</tr>
</table>	



</fieldset>

</form>
</body>
</html>
<?php 

include('footer.php');
 ?>