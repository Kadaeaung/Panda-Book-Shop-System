<?php  
include("connect.php");
include("AutoID_Functions.php");


if(isset($_POST['btnSave'])) 
{
	
	$txtStaffName=$_POST['txtAdminName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];
	$txtNRC=$_POST['txtNRC'];
	$txtPhone=$_POST['txtPhone'];
	$txtPosition=$_POST['txtPosition'];
	$txtAddress=$_POST['txtAddress'];
	$Status="Active";
	

	$query="Select Email from admin where Email='$txtEmail'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	if ($count>0)
	{
		echo "<script>window.alert('Email Alredy Exist')</script>";
		echo "<script>window.location='Staff_Entry.php'</script>";

	}
	else
	{
		
		$query="INSERT INTO Admin
				(AdminName,Email,Password,NRC,Phone,Position,Address) 
				VALUES
				('$txtStaffName','$txtEmail','$txtPassword','$txtNRC','$txtPhone','$txtPosition','$txtAddress')
				";
		$result=mysqli_query($connection,$query);

		if($result) //Check Condition True 
		{
			echo "<script>window.alert('Admin Registration Completed.')</script>";
			echo "<script>window.location='Admin_Entry.php'</script>";
		}
		else
		{
			echo "<p>Error in Admin Entry : " . mysqli_error($connection) . "</p>";
		}
	}
}
include('header.php');
?>
<html>
<head>
<title>Admin Entry</title>
</head>
<body>
<form action="Admin_Entry.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Enter Admin Info:</legend>
<table cellpadding="5px">
<tr>
	<td>AdminName</td>
	<td>
	<input type="text" name="txtAdminName" class="form-control" placeholder="Enter Admin Full Name" required />
	</td>
</tr>
<tr>
	<td>Email</td>
	<td>
	<input type="email" name="txtEmail" class="form-control" placeholder="Type Correct Email" required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
	<input type="password" name="txtPassword" class="form-control" placeholder="Type Correct Password" required />
	</td>
</tr>

<tr>
	<td>NRC</td>
	<td>
	<input type="text" name="txtNRC" class="form-control" placeholder="Enter admin NRC" required />
	</td>
</tr>
<tr>
	<td>Phone</td>
	<td>
	<input type="text" name="txtPhone" class="form-control" placeholder="09------" required />
	</td>
</tr>

<tr>
	<td>Position</td>
	<td>
	<input type="text" name="txtPosition" class="form-control" placeholder="Enter your position" required />
	</td>
</tr>
<tr>
	<td>Address</td>
	<td>
	<textarea name="txtAddress" class="form-control" required > </textarea>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="btnSave" value="Save"/>
		<input type="reset" value="Clear"/>
	</td>
</tr>
</table>

<hr>

<fieldset>
<legend>Admin Listing</legend>
<?php 
	$select="SELECT * FROM Admin";
	$ret=mysqli_query($connection,$select);
	$size=mysqli_num_rows($ret);

	if($size==0)
	{
		echo "<p>No Record</p>";
		exit();
	}
 ?>
 <table width="90%" border="1">
 	<tr>
 		<th>AdminID</th>
 		<th>Admin Name</th>
 		<th>Email</th>
 		<td>NRC</th>
 		<th>Phone</th>
 		<th>Position</th>
 		<th>Address</th>
 		<th>Action</th>
	</tr>
	<?php 
	for($i=0;$i<$size;$i++)
	{
		$row=mysqli_fetch_array($ret);
		
		$AdminID=$row['AdminID'];
		$AdminName=$row['AdminName'];
		$Email=$row['Email'];
		$Phone=$row['Phone'];
		$NRC=$row['NRC'];
		$Position=$row['Position'];
		$Address=$row['Address'];
		
		echo"<tr>";
			echo "<td>$AdminID</td>";
			echo "<td>$AdminName</td>";
			echo "<td>$Email</td>";
			echo "<td>$Phone</td>";
			echo "<td>$NRC</td>";
			echo "<td>$Position</td>";
			echo "<td>$Address</td>";
			echo "<td>
					  <a href='Admin_Update.php?AdminID=$AdminID'>Edit</a>|
					  <a href='Admin_Delete.php?AdminID=$AdminID'>Delete</a>
				</td>";
		echo"</tr>";
	}
	?>
 </table>
 </fieldset>

</form>
</body>
</html>
<?php 
include('footer.php');
 ?>
