<?php
session_start();
include('Connect.php');

$Book_ID=$_REQUEST['BookID'];
$delete="DELETE FROM Book
		  Where BookID='$Book_ID'";

		  $ret=mysqli_query($connection,$delete);

		  if($ret)
		  {
		     echo "<script>window.alert('Delete Successful!')</script>";
			 echo "<script>window.location='Book_Entry.php'</script>";
		  }
		  else
		  {
		  	echo "<p>".mysqli_error($connection)."</p>";
		  }
 ?>
