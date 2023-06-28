<?php 

include ('connect.php');

$ProductID=$_GET['PID'];

$select="delete from purchase where BookID='$BookID'";
$ret=mysqli_query($connection,$select);

echo "<script>alert('Remove');window.location.assign('purchase.php')</script>";

 ?>