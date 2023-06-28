<?php  
include('Connect.php');
include('AutoID_Functions.php');
include('header1.php');

if(isset($_POST['btnSave'])) 
{
	$txtpublisherid=$_POST['txtpublisherid'];
	$txtpublishername=$_POST['txtpublishername'];
	$txtpublisherdate=$_POST['txtpublisherdate'];
	$txtaddress=$_POST['txtaddress'];
	$txtemail=$_POST['txtemail'];
	$txtPhone=$_POST['txtPhone'];
	$Status="Active";


	$query="INSERT INTO publisher
			(PublisherID,PublisherName,PublisherDate,Address,Email,Phone) 
			VALUES
			('$txtpublisherid','$txtpublishername','txtpublisherdate','txtaddress','txtemal','txtPhone')
			";
	$result=mysqli_query($connection,$query);

	if($result) //Check Condition True 
	{
		echo "<script>window.alert('Publisher Registration Completed.')</script>";
		echo "<script>window.location='Publisher_Entry.php'</script>";
	}
	else
	{
		echo "<p>Error in Publisher Entry : " . mysqli_error($connection) . "</p>";
	}

}
?>
<html>
<head>
	<title>Author Entry</title>
</head>
<body>
<form action="Publisher_Entry.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend><h2>Publisher Information</h2></legend>
<table cellpadding="5px" width="500px">
<tr>
<td>Publisher ID</td>
<td>
<input type="text"  class="form-control" name="txtpublisherid" value="<?php echo AutoID('publisher','PublisherID','P-',6); ?>" required readonly />
</td>
</tr>
<tr>
	<td>Publisher Name</td>
	<td>
	<input type="text"  class="form-control" name="txtpublishername" placeholder="Please Enter Publisher Name" required />
	</td>
</tr>
<tr>
	<td>Publisher Date</td>
	<td>
	<input type="text"  class="form-control" name="txtpublisherdate" placeholder="Please Enter Publisher date" required />
	</td>
</tr>

<tr>
	<td>Publisher Address</td>
	<td>
	<input type="text"  class="form-control" name="txtaddress" placeholder="Please Enter Publisher Address" required />
	</td>
</tr>

<tr>
	<td>Publisher Email</td>
	<td>
	<input type="text"  class="form-control" name="txtemail" placeholder="Please Enter Publisher Email" required />
	</td>
</tr>

<tr>
	<td>Publisher Phone</td>
	<td>
	<input type="text"  class="form-control" name="txtPhone" placeholder="Please Enter Publisher Phone" required />
	</td>
</tr>
<tr>
	<td>
<input type="submit" class="form-control" name="btnSave" value="Save"/>
		
	</td>
	<td>
		<input type="reset" class="form-control" value="Clear"/>
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>
<?php include('footer.php'); ?>
