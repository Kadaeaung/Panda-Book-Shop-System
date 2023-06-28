<?php 	
session_start();
include('connect.php');

if(isset($_GET['AdminID']))

{
	$AdminID=$_GET['AdminID'];
	$Select="SELECT * from Admin
			where AdminID='$AdminID'";

		$ret=mysqli_query($connection,$Select);
		$row=mysqli_fetch_array($ret);

		$AdminID=$row['AdminID'];
		$AdminName=$row['AdminName'];
		$Email=$row['Email'];
		$Password=$row['Password'];
		$NRC=$row['NRC'];
		$Phone=$row['Phone'];
		$Position=$row['Position'];
		$Address=$row['Address'];
}

		if (isset($_POST['btnupdate']))
	    {
			$UAdminID=$_POST['txtAdminID'];
			$UAdminName=$_POST['txtAdminName'];
			$UEmail=$_POST['txtEmail'];
			$UPassword=$_POST['txtPassword'];
			$UNRC=$_POST['txtNRC'];
			$UPhone=$_POST['txtPhone'];
			$UPosition=$_POST['txtPosition'];
			$UAddress=$_POST['txtAddress'];

			$update="UPDATE Admin
					set AdminName='$UAdminName',
						Email='$UEmail',
						Password='$UPassword',
						NRC='$UNRC',
						Phone='$UPhone',
						Position='$UPosition',
						Address='$UAddress'
					where AdminID='$UAdminID'";

					$U_ret=mysqli_query($connection,$update);
		if($U_ret)
		{
			
			 echo "<script>
			 	alert('Admin Update Success!')
			 	window.location='Admin_Entry.php'
			 	</script>";
		}
}
 ?>
<html>
<head>
<title>Admin Entry</title>
</head>
<body>
<form action="Admin_Update.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Enter Admin Info:</legend>
<table cellpadding="5px">
	<input type='hidden' class="form-control" name='txtAdminID' value='<?php echo $AdminID; ?>'/>
<tr>
	<td>AdminName</td>
	<td>
	<input type="text" name="txtAdminName" class="form-control" placeholder="" value='<?php echo $AdminName;?>' required />
	</td>
</tr>
<tr>
	<td>Email</td>
	<td>
	<input type="email" name="txtEmail" class="form-control" placeholder="" value='<?php echo $Email; ?>' required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
	<input type="password" name="txtPassword" class="form-control" placeholder=""  value='<?php echo $Password; ?>' />
	</td>
</tr>

<tr>
	<td>NRC</td>
	<td>
	<input type="text" name="txtNRC" class="form-control" placeholder="" value='<?php echo $NRC; ?>' required />
	</td>
</tr>
<tr>
	<td>Phone</td>
	<td>
	<input type="text" name="txtPhone" class="form-control" placeholder="" value='<?php echo $Phone; ?>' required />
	</td>
</tr>
<tr>
	<td>Position</td>
	<td>
	<input type="text" name="txtPosition" class="form-control" placeholder="" value='<?php echo $Position; ?>' required />
	</td>
</tr>

<tr>
	<td>Address</td>
	<td>
	<textarea name="txtAddress" class="form-control" value='<?php echo  $Address ;?>'></textarea>

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
