<?php  
session_start(); 
include('connect.php');
include('header.php');
//include('AutoID.php');



if(isset($_POST['btnSearch'])) 
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if($rdoSearchType == 1) 
	{
		$lstProductID=$_POST['lstProductID'];

		$query="SELECT o.*, c.CustomerID,c.Customer_Name 
				FROM orders o, customer c
				WHERE o.OrderID='$lstProductID'
				AND o.CustomerID=c.CustomerID
				";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
	}
	elseif($rdoSearchType == 2) 
	{
		$txtFrom=date('Y-m-d',strtotime($_POST['txtFrom']));
		$txtTo=date('Y-m-d',strtotime($_POST['txtTo']));

		$query="SELECT o.*, c.CustomerID,c.Customer_Name 
				FROM orders o, customer c
				WHERE o.OrderDate BETWEEN '$txtFrom' AND '$txtTo'
				AND o.CustomerID=c.CustomerID
				";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
	}
	else
	{
		$cboStatus=$_POST['cboStatus'];

		$query="SELECT o.*, c.CustomerID,c.Customer_Name 
				FROM orders o, customer c
				WHERE o.Status='$cboStatus'
				AND o.CustomerID=c.CustomerID
				";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
	}

}		
elseif(isset($_POST['btnShowAll'])) 
{
	$query="SELECT o.*, c.CustomerID,c.Customer_Name 
			FROM orders o, customer c
			WHERE o.CustomerID=c.CustomerID
			";
	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);

}
else
{
	$TodayDate=date('Y-m-d');

	$query="SELECT o.*, c.CustomerID,c.Customer_Name 
			FROM orders o, customer c
			WHERE o.OrderDate='$TodayDate'
			AND o.CustomerID=c.CustomerID
			";
	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);
	
}

?>
<html>
<head>
	<title>Order List</title>
	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css"/>
</head>
<body>
<form action="OrderList.php" method="post">
<fieldset>
<legend>Search Option :</legend>
<table cellpadding="5px">
<tr>
	<td>
	<input type="radio" name="rdoSearchType" value="1" checked/>Search By PurchaseID
	<br/>
	<input list="lstProductID" name="lstProductID">
		<datalist id="lstProductID">
		<?php  
		$POquery="SELECT * FROM orders";
		$ret=mysqli_query($connection,$POquery);
		$POcount=mysqli_num_rows($ret);

		for($z=0;$z<$POcount;$z++) 
		{ 
			$POrow=mysqli_fetch_array($ret);
			$Order_ID=$POrow['OrderID'];
			echo "<option value='$Order_ID'>";
		}
		?>
		</datalist>
	</td>
	<td>
		<input type="radio" name="rdoSearchType" value="2"/>Search By Date
		
		<b>From :</br>
		<input type="text" name="txtFrom" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly/>
		<b>To :
		<input type="text" name="txtTo" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly/>
	</td>
	<td>
		<input type="radio" name="rdoSearchType" value="3"/>Search By Status
	
		<select name="cboStatus">
			<option>Pending</option>
			<option>Confirmed</option>
		</select>
	</td>
	<td>
	<input type="submit" name="btnSearch" value="Search" class="btn btn primary"/><br><br>

	<input type="submit" name="btnShowAll" value="Show All" class="btn btn primary"/><br><br>
	<input type="reset" value="Clear" class="btn btn primary"/>
	</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Search Result :</legend>
<?php  
if($count<1) 
{
	echo "<p>No Purchase Order Found.</p>";
}
else
{
?>
	<table border="1" cellpadding="5px">
	<tr>
		<th>Order_ID</th>
		<th>Date</th>
		<th>CustomerName</th>
		<th>TotalQuantity</th>
		<th>TotalAmount</th>
		<th>Status</th>
		<th>~</th>
	</tr>
	<?php 
	for ($i=0;$i<$count;$i++) 
	{ 
		$row=mysqli_fetch_array($result);
		$Order_ID=$row['OrderID'];

		echo "<tr>";
		echo "<td>$Order_ID</td>";
		echo "<td>" . $row['OrderDate'] . "</td>";
		echo "<td>" . $row['Customer_Name'] . "</td>";
		echo "<td>" . $row['BuyQuantity'] . "</td>";
		echo "<td>" . $row['TotalAmount'] . "</td>";
		echo "<td>" . $row['Status'] . "</td>";
		echo "<td><a href='OrderDetail.php?Order_ID=$Order_ID'>Details</a></td>";
		echo "</tr>";
	}			
	 ?>
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