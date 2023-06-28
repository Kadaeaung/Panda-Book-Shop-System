<?php
session_start();  
include('Connect.php');
include('AutoID_Functions.php');
include('header1.php');

// if(!isset($_SESSION['Staff_ID'])) 
// {
// 	echo "<script>window.alert('Please Login to Continue')</script>";
// 	echo "<script>window.location='Staff_Login.php'</script>";
// }

if(isset($_POST['btnSave'])) 
{
	$bookid=$_POST['txtbookid'];
	$bookname=$_POST['txtbookname'];
	
	$price=$_POST['txtprice'];
	$quantity=$_POST['txtquantity'];
	$cboCategory=$_POST['cboCategory'];
	$cboAuthor=$_POST['cboAuthor'];
	$cboPublisher=$_POST['cboPublisher'];
	$txtDes=$_POST['txtDes'];
	
	
	

	//image upload ----------
	$Image=$_FILES['fileBookImage']['name'];
	$Folder="Images/";
	$FileName=$Folder. '_'. $Image;
	$copy=copy($_FILES['fileBookImage']['tmp_name'],$FileName);

	if (!$copy)
	{
		echo "<p>Cannot Upload</p>";
		exit();
	}


$select="Select * From Book where BookName='$bookname'";
$ret=mysqli_query($connection,$select);
$count=mysqli_num_rows($ret);

if($count>0)
{
	$row=mysqli_fetch_array($ret);
	echo "<script>window.alert('Book cannot Register!')</script>";
		echo "<script>window.location='Book_Entry.php'</script>";
exit();
}
		else{


	echo $query="INSERT INTO book
			(BookID,BookName,AuthorID,CategoryID,PublisherID,Price,BookImage,Description) 
			VALUES
			('$bookid','$bookname','$cboAuthor','$cboCategory','$cboPublisher','$price','$FileName','$txtDes')
			";
	$result=mysqli_query($connection,$query);
}
	if($result) //Check Condition True 
	{
		echo "<script>window.alert('Book Registration Completed.')</script>";
		echo "<script>window.location='Book_Entry.php'</script>";
	}
	else
	{
		echo "<p>Error in Book Entry : " . mysqli_error($connection) . "</p>";
	}
}

?>
<html>
<head>
	<title>Book Entry</title>
</head>
<body>

<div class="section-top-border">
						<div class="row">
							<div class="col-lg-8 col-md-8">
								<h3 class="mb-30">Book Entry</h3>
								<form action="Book_Entry.php" method="post" enctype="multipart/form-data">
									<div class="mt-10">
										<input type="text" name="txtbookid" class="form-control" value="<?php echo AutoID('Book','BookID','B-',6); ?>" required readonly  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Book ID'" required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="txtbookname" class="form-control" placeholder="Enter Book Name" required  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Book Name'" required class="single-input">
									</div>
									<div class="mt-10">
										<input type="number" name="txtprice" class="form-control" placeholder="Enter Price" min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Price'" required class="single-input">
									</div>
									
									<div class="mt-10">
										<input type="file" class="form-control" name="fileBookImage"placeholder="Enter Quantity"  min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'BookImage'" required class="single-input">
									</div>

									<div class="mt-10">
										<textarea name="txtDes" class="form-control" required  placeholder="Description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" required></textarea>
									</div> 
									

									<div class="input-group-icon mt-10">
										<div class="icon"><i  aria-hidden="true"></i></div>
										<div class="form-select" >


											
										<select name="cboCategory" class="form-control">
											<option>Choose Categroy</option>
											<?php 
											

							$query="SELECT * FROM Category";
							$ret=mysqli_query($connection,$query);
											$count=mysqli_num_rows($ret);

								for ($i=0; $i <$count ; $i++) 
											{ 
									$row=mysqli_fetch_array($ret);
									$CategoryID=$row['CategoryID'];
									$Category_Name=$row['CategoryName'];

												echo "<option value='$CategoryID'> $Category_Name </option>";
											}

											 ?>
										</select>
										</div>
									</div>
									

									<div class="input-group-icon mt-10">
										<div class="icon"><i  aria-hidden="true"></i></div>
										<div class="form-select" >


											
										<select name="cboAuthor" class="form-control">
		                                   <option>Choose Author Name</option>
	                               	<?php 
	                                    	$query="SELECT * FROM Author";
	                                        	$ret=mysqli_query($connection,$query);
	                                             	$count=mysqli_num_rows($ret);

		for ($i=0; $i <$count ; $i++) 
		{ 
			$row=mysqli_fetch_array($ret);
			$Author_ID=$row['AuthorID'];
			$Author_Name=$row['AuthorName'];

			echo "<option value='$Author_ID'> $Author_Name </option>";
		}

		 ?>
	</select>
										</div>
									</div>

									<div class="input-group-icon mt-10">
										<div class="icon"><i  aria-hidden="true"></i></div>
										<div class="form-select" >


											
										<select name="cboPublisher" class="form-control">
											<option>Choose Publisher</option>
											<?php 
											

							$query="SELECT * FROM Publisher";
							$ret=mysqli_query($connection,$query);
											$count=mysqli_num_rows($ret);

								for ($i=0; $i <$count ; $i++) 
											{ 
									$row=mysqli_fetch_array($ret);
									$PublisherID=$row['PublisherID'];
									$PublisherName=$row['PublisherName'];

												echo "<option value='$PublisherID'> $PublisherName </option>";
											}

											 ?>
										</select>
										</div>
									</div>
									
									<div class="mt-10">
										<input type="submit" name="btnSave" value="Save" class="form-control" placeholder="Enter Save"  min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Save'" required class="single-input">
										<input type="reset" value="Clear" name="btnClear" value="Save" class="form-control" placeholder="Enter Clear"  min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Clear'" required class="single-input">
								
									</div>

									
									<!-- For Gradient Border Use -->
									<!-- <div class="mt-10">
										<div class="primary-input">
											<input id="primary-input" type="text" name="first_name" placeholder="Primary color" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Primary color'">
											<label for="primary-input"></label>
										</div>
									</div> -->
									
								</form>
							</div>
							</div>
						</div>













</table>

<legend>Book Listing</legend>


<table id="tabledesign" cellspacing="15px">
<tr>
<th>BooKID</th>
<th>BooK_Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Category Name</th>

<th>Author Name</th>
<th>Publisher Name</th>
<th>Action</th>
</tr>
<?php 
$select="SELECT * FROM book b,category c,author a,Publisher p
where b.CategoryID=c.CategoryID
and b.AuthorID=a.AuthorID
and b.PublisherID=p.PublisherID";
	$ret=mysqli_query($connection,$select);
	$size=mysqli_num_rows($ret);

	if($size==0)
	{
		echo "<p>No Record</p>";
		//exit();
	}
for ($i=0; $i < $size; $i++) 
{ 
	$row=mysqli_fetch_array($ret);
	$Book_ID=$row['BookID'];
	$Book_Name=$row['BookName'];
	$Book_Amount=$row['Price'];
	$Book_Quantity=$row['Quantity'];
	$Category=$row['CategoryName'];
	$Author=$row['AuthorName'];
	$Publisher=$row['PublisherName'];
	

	echo "<tr>";

			echo "<td>$Book_ID</td>";
			echo "<td>$Book_Name</td>";
			echo "<td>$Book_Amount</td>";
			echo "<td>$Book_Quantity</td>";
			echo "<td>$Category</td>";
			echo "<td>$Author</td>";
				echo "<td>$Publisher</td>";

			
			echo "<td>
					  <a href='BookUpdate.php?BID=$Book_ID'>Edit</a>
					  <a href='Book_Delete.php?BID=$Book_ID'>Delete</a>
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
