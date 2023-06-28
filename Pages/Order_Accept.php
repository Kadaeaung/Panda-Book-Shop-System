<?php
include('connect.php'); 
if(isset($_REQUEST['OrderID']))
{
	$orderid=$_REQUEST['OrderID'];
	$update="UPDATE Orders set Status='Confirmed' where OrderID='$orderid'";
	$query=mysqli_query($connection,$update);
	if($query)
	{
		echo "<script>alert('Order Confirmed')
		window.location='Order_Search.php'</script>";
	}
}
	

 ?>