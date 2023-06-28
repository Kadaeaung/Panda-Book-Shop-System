<?php  
include('Connect.php');
include('AutoID_Functions.php');


if(isset($_POST['btnSave'])) 
{
	$txtcategoryid=$_POST['txtcategoryid'];
	$txtcategoryname=$_POST['txtcategoryname'];
	$Status="Active";


	$query="INSERT INTO Category
			(CategoryID,CategoryName) 
			VALUES
			('$txtcategoryid','$txtcategoryname')
			";
	$result=mysqli_query($connection,$query);

	if($result) //Check Condition True 
	{
		echo "<script>window.alert('Category Registration Completed.')</script>";
		echo "<script>window.location='Category_Entry.php'</script>";
	}
	else
	{
		echo "<p>Error in Author Entry : " . mysqli_error($connection) . "</p>";
	}

}
include('header1.php');
?>
<html>
<head>
	<title>Cateogry Entry</title>
</head>
<body>
<form action="Category_Entry.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend><h2>Category Information</h2></legend>
<table cellpadding="5px" width="500px">
<tr>
<td>Category ID</td>
<td>
<input type="text"  class="form-control" name="txtcategoryid" value="<?php echo AutoID('category','categoryID','C-',6); ?>" required readonly />
</td>
</tr>
<tr>
	<td>Category Name</td>
	<td>
	<input type="text"  class="form-control" name="txtcategoryname" placeholder="Please Enter Category Name" required />
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
