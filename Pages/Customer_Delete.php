<?php
session_start();
include('connect.php');

$Customer_ID=$_REQUEST['CustomerID'];
$delete="DELETE FROM Customer
		 Where CustomerID='$Customer_ID'";

		 $ret=mysqli_query($connection,$delete);

		 if($ret)
		  {
		     echo "<script>window.alert('Customer Delete Success')</script>";
			 echo "<script>window.location='Customer_Entry.php'</script>";
		 }
		  else
		  {
		  	echo "<p>".mysqli_error($connection)."</p>";
		  }
 ?>
