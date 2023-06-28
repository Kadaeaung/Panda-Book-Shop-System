<?php 
include('connect.php');
include('AutoID_Functions.php');
include('header.php');

if (isset($_POST['btnSave'])) 
{
 	$txtCustomerId=$_POST['txtcustomerid'];
 	$txtCusName=$_POST['txtCusName'];
 	$txtEmail=$_POST['txtEmail'];
 	$txtPassword=$_POST['txtPassword'];
	$txtPhone=$_POST['txtPhone'];
	
	$txtAddress=$_POST['txtAddress'];

	$query="SELECT Email FROM Customer
			WHERE Email='$txtEmail'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	if ($count>0) 
	{
		echo "<script>window.alert('Email Alredy Exist')</script>";
		echo "<script>window.location='Customer_Entry.php'</script>";
	}
	else
	{
		


	$query="INSERT INTO Customer
			(CustomerID,CustomerName,Email,Password,Phone,Address)
			VALUES
			('$txtCustomerId','$txtCusName','$txtEmail','$txtPassword','$txtPhone','$txtAddress')
			";
	$result=mysqli_query($connection,$query);

	if($result) //Check Condition True 
	{
		echo "<script>window.alert('Customer Registration Completed.')</script>";
		echo "<script>window.location='Customer_Entry.php'</script>";
	}
	else
	{
		echo "<p>Error in Staff Entry : " . mysqli_error($connection) . "</p>";
	}
	}
}
 ?>

 
<html>
<head>
	<title>Customer Login</title>
</head>
<form action="Customer_Entry.php" method="post" enctype="multipart/form-data">	
<legend align="center">Customer Information</legend>
<table cellpadding="5px" align="center">
<tr>
	<td>Customer ID</td>
	<td>
	<input type="text" name="txtcustomerid" class="form-control" value="<?php echo AutoID('customer','CustomerID','C-',6); ?>"  required readonly/>
	</td>
</tr>
<tr>
	<td>Customer Name</td>
	<td>
	<input type="text" name="txtCusName" class="form-control" placeholder=""  required />
	</td>
</tr>
<tr>
	<td>Email</td>
	<td>
	<input type="email" name="txtEmail" class="form-control" placeholder="" required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
	<input type="password" name="txtPassword" placeholder="" required />
	</td>
</tr>
<tr>
	<td>Phone</td>
	<td>
	<input type="text" name="txtPhone" class="form-control" placeholder="" required />
	</td>
</tr>

<tr>
	<td>Address</td>
	<td>
	<textarea name="txtAddress" class="form-control"></textarea>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="btnSave" class="btn btn-inverse large" value="Save"/>
		<input type="reset" class="btn btn-inverse large" value="Clear"/>
	</td>
</tr>

			
</table>

<hr>	

<fieldset>
<legend>Customer Listing</legend>
<?php 
	$select="SELECT * FROM Customer";
	$ret=mysqli_query($connection,$select);
	$size=mysqli_num_rows($ret);

	if($size==0)
	{
		echo "<p>No Record</p>";
		exit();
	}
 ?>

<table id="tabledesign" cellspacing="15px">
<tr>
<th>Customer_ID</th>
<th>Customer_Name</th>
<th>Email</th>
<th>Phone</th>
<th>Address</th>
<th>Action</th>
</tr>
<?php 
for ($i=0; $i < $size; $i++) 
{ 
	$row=mysqli_fetch_array($ret);
	$Customer_ID=$row['CustomerID'];
	$Customer_Name=$row['CustomerName'];
	$Email=$row['Email'];
	$Phone=$row['Phone'];
	$Address=$row['Address'];

	echo "<tr>";

			echo "<td>$Customer_ID</td>";
			echo "<td>$Customer_Name</td>";
			echo "<td>$Email</td>";
			echo "<td>$Phone</td>";
			echo "<td>$Address</td>";
			echo "<td>
					  <a href='Customer_Update.php?CustomerID=$Customer_ID'>Edit</a> | 
					  <a href='Customer_Delete.php?CustomerID=$Customer_ID'>Delete</a>
				</td>";
	echo"</tr>";

}
 ?>

</table>
</fieldset>
</form>
 <?php include('footer.php'); ?>

