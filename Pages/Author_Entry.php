<?php  
include('Connect.php');
include('AutoID_Functions.php');
include('header1.php');

if(isset($_POST['btnSave'])) 
{
	$authorid=$_POST['txtauthorid'];
	$authorname=$_POST['txtauthorname'];
	$Status="Active";


	$query="INSERT INTO Author
			(AuthorID,AuthorName) 
			VALUES('$authorid','$authorname')";
	$result=mysqli_query($connection,$query);

	if($result) //Check Condition True 
	{
		echo "<script>window.alert('Author Registration Completed.')</script>";
		echo "<script>window.location='Author_Entry.php'</script>";
	}
	else
	{
		echo "<p>Error in Author Entry : " . mysqli_error($connection) . "</p>";
	}

}

?>
<html>
<head>
	<title>Author Entry</title>
</head>
<body>
<form action="Author_Entry.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend><h2>Author Information</h2></legend>
<table cellpadding="5px" width="500px">
<tr>
<td>Author ID</td>
<td>
<input type="text"  class="form-control" name="txtauthorid" value="<?php echo AutoID('author','AuthorID','A-',6); ?>" required readonly />
</td>  
</tr>
<tr>
	<td>Author Name</td>
	<td>
	<input type="text"  class="form-control" name="txtauthorname" placeholder="Please Enter Author Name" required />
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