<?php
session_start();
include('connect.php');
$AdminID=$_REQUEST['AdminID'];
$delete="DELETE FROM Admin
		  Where AdminID='$AdminID'";

		  $ret=mysqli_query($connection,$delete);

		  if($ret)
		  {
		     echo "<script>window.alert('Admin Delete Success')</script>";
			 echo "<script>window.location='Admin_Entry.php'</script>";
		  }
		  else
		  {
		  	echo "<p>".mysqli_error($connection)."</p>";
		  }
 ?>