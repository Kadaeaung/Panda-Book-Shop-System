<?php  
session_start();  
include('connect.php');
include('header1.php');
if(isset($_POST['btnSearch'])) 
{
	$SearchType=$_POST['rdosearch'];

	if($SearchType==="1") 
	{
		$OrderID=$_POST['cboOrderID'];

		$Squery="SELECT o.*, c.CustomerID,c.CustomerName 
				FROM orders o,customer c 
				WHERE o.OrderID='$OrderID'
				AND o.CustomerID=c.CustomerID";
	}
	elseif($SearchType==="2") 
	{
		$From=date('Y-m-d',strtotime($_POST['txtfrom']));
		$To=date('Y-m-d',strtotime($_POST['txtto']));

		 $Squery="SELECT o.*, c.CustomerID,c.CustomerName 
				FROM orders o,customer c 
				WHERE o.OrderDate BETWEEN '$From' AND '$To'
				AND o.CustomerID=c.CustomerID";
	}
}
elseif(isset($_POST['btnShowAll'])) 
{
	 $Squery="SELECT o.*, c.CustomerID,c.CustomerName 
			FROM orders o,customer c 
			WHERE o.CustomerID=c.CustomerID";
}
else
{
	$TodayDate=date('Y-m-d');

	 $Squery="SELECT o.*, c.CustomerID,c.CustomerName 
			FROM orders o,customer c 
			WHERE o.OrderDate='$TodayDate'
			AND o.CustomerID=c.CustomerID";
}

?>
<html>
<head>
<title>Order Search</title>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>	

<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css">
<script type="text/javascript" src="DatePicker/datepicker.js"></script>

</head>
<body>

<script>
	$(document).ready( function () {
		$('#tableid').DataTable();
	} );
</script>

<form action="Order_Search.php" method="post">

<fieldset>
<legend>Order Search & Report</legend>
<table cellpadding="5px">
<tr>
	<td>
		<input type="radio" name="rdosearch" value="1" checked/>Search by ID: <br/>
		<select name="cboOrderID">
		<option>Choose OrderID</option>
		<?php 
		$query="SELECT o.*,c.CustomerID,c.CustomerName 
				FROM orders o, customer c
				WHERE o.CustomerID=c.CustomerID";
		$ret=mysqli_query($connection,$query);
		$count=mysqli_num_rows($ret);

		for($i=0;$i<$count;$i++) 
		{ 
			$arr=mysqli_fetch_array($ret);

			$OrderID=$arr['OrderID'];
			$CustomerName=$arr['CustomerName'];

			echo "<option value='$OrderID'>" . $OrderID . ' - ' . $CustomerName . "</option>";
		}
		 ?>
		</select>
	</td>
	<td>
		<input type="radio" name="rdosearch" value="2"/>Search by Date:<br/>
		From :<input type="text" name="txtfrom" value="<?php echo date('Y-m-d') ?>" onFocus="showCalender(calender,this)" />
		To :<input type="text" name="txtto" value="<?php echo date('Y-m-d') ?>" onFocus="showCalender(calender,this)"/>
	</td>
	<td>
	<br/>
	<input type="submit" name="btnSearch" value="Search"/>
	<input type="submit" name="btnShowAll" value="Show All"/>
	<input type="reset" value="Cancel"/>
	</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Search Result :</legend>
<?php  
$result=mysqli_query($connection,$Squery);
$count=mysqli_num_rows($result);

if($count==0) 
{
	echo " <p>No Order Result Found.</p>";
	exit();
}
?>
<table id="tableid" class="display">
	<thead>
	<tr>
		<th>OrderID</th>
		<th>OrderDate</th>
		<th>CustomerName</th>
		<th>TotalAmount</th>
		<th>TotalQuantity</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
<?php
	for ($i=0;$i<$count;$i++) 
	{ 
		$arr=mysqli_fetch_array($result);

		$OrderID=$arr['OrderID'];
		$OrderDate=$arr['OrderDate'];
		$CustomerName=$arr['CustomerName'];
		$TotalAmount=$arr['TotalAmount'];
		$TotalQuantity=$arr['TotalQuantity'];
		$Status=$arr['Status'];

		echo "<tr>";
			echo "<td>$OrderID</td>";
			echo "<td>$OrderDate</td>";
			echo "<td>$CustomerName</td>";
			echo "<td>$TotalAmount</td>";
			echo "<td>$TotalQuantity</td>";
			echo "<td>$Status</td>";
			echo "<td> 
					
					<a href='Order_Accept.php?OrderID=$OrderID'>Accept</a> 
				 </td>";
		echo "</tr>";	
	}
?>
</tbody>
</table>

<!--Print Button ___________________________________-->

<script>var pfHeaderImgUrl = '';var pfHeaderTagline = 'Order%20Report';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
<a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>

<!--Print Button ___________________________________-->

</fieldset>
</form>

<!--Excel Export Button ___________________________________-->



<!--Excel Export Button ___________________________________-->

</body>
</html>
<?php include('footer.php'); ?>