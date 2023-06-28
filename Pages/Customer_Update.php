<?php 	
session_start();
include('connect.php');
;

if(isset($_GET['CustomerID']))

{
	$CustomerID=$_GET['CustomerID'];
	$Select="SELECT * from Customer
			where CustomerID='$CustomerID'";

		$ret=mysqli_query($connection,$Select);
		$row=mysqli_fetch_array($ret);

	
 	$txtCusName=$row['CustomerName'];
 	$txtEmail=$row['Email'];
 	$txtPassword=$row['Password'];
	$txtPhone=$row['Phone'];
	$txtAddress=$row['Address'];
}

		if (isset($_POST['btnupdate']))
	    {
			$UCustomerID=$_POST['txtCustomerID'];
			$UCusName=$_POST['txtCustomerName'];
			$UEmail=$_POST['txtEmail'];
			$UPassword=$_POST['txtPassword'];
			
			$UPhone=$_POST['txtPhone'];
			
			$UAddress=$_POST['txtAddress'];

			$update="UPDATE Customer
					set CustomerName='$UCusName',
						Email='$UEmail',
						Password='$UPassword',
						
						Phone='$UPhone',
						
						Address='$UAddress'
					where CustomerID='$UCustomerID'";

					$U_ret=mysqli_query($connection,$update);
		if ($U_ret)
		{
			 echo "<script>window.alert('Customer Update Success!')</script>";
			 echo "<script>window.location='Customer_Entry.php'</script>";
		}
}
 ?>
<html>
<head>
<title>Customer Entry</title>
</head>
<body>
<form action="Customer_Update.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Enter Customer Info:</legend>
<table cellpadding="5px">
	<input type='hidden' class="form-control" name='txtCustomerID' value='<?php echo $CustomerID; ?>'/>
<tr>
	<td>CustomerName</td>
	<td>
	<input type="text" name="txtCustomerName" class="form-control" placeholder="" value='<?php echo $txtCusName;?>' required />
	</td>
</tr>
<tr>
	<td>Email</td>
	<td>
	<input type="email" name="txtEmail" class="form-control" placeholder="" value='<?php echo $txtEmail; ?>' required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
	<input type="password" name="txtPassword" class="form-control" placeholder=""  value='<?php echo $txtPassword; ?>' />
	</td>
</tr>

<tr>
	<td>Phone</td>
	<td>
	<input type="text" name="txtPhone" class="form-control" placeholder="" value='<?php echo $txtPhone; ?>' required />
	</td>
</tr>


<tr>
	<td>Address</td>
	<td>
	<textarea name="txtAddress" class="form-control">
		

		<?php echo  $txtAddress ;?>
	</textarea>

	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="btnupdate" value="Update"/>
		<input type="reset" value="Clear"/>
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>
