<?php 
		session_start();
	include('connect.php');
	if (isset($_POST['btnlogin']))
	{
		$Email=$_POST['txtemail'];
		$password=$_POST['txtpassword'];

		$select="SELECT * FROM Admin where Email='$Email' and Password='$password'";

		$query=mysqli_query($connection,$select);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			echo "<script>
					alert('Admin Login Successful');
					window.location='Order_Search.php'
				</script>";
		}
		else
		{

			$select="SELECT * FROM Customer where Email='$Email' and Password='$password'";

		$query=mysqli_query($connection,$select);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			$data=mysqli_fetch_array($query);
			$customerid=$data['CustomerID'];
			$customername=$data['CustomerName'];
			$_SESSION['cusid']=$customerid;
			$_SESSION['cusname']=$customername;

			echo "<script>
					alert('Customer Login Successful');
					window.location='BookDisplay.php'
				</script>";
		}
		else
		{
			echo "<script>alert('Invalid Login');
					window.location='Login.php'
				</script>";
		}
		}
		}
	include('header2.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="Login.php" method="POST">
		<table border="1px" width="300px" height="200px" align="center">
		
		<tr>
			<td colspan="2px" align="center">
			<h2>Login Form</h2>
			</td>

		</tr>

		<tr>
			<td>Email Address</td>
			<td>
				<input type="email" name="txtemail" required placeholder="Enter Email">
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input	type="password" name="txtpassword" required placeholder="Enter Password">
			</td>
			<tr>
				<td>
					<a href="Admin_Entry.php">Register</a>
				</td>
				<td>
					<input type="submit" name="btnlogin" value="Login">
				</td>
			</tr>
		</tr>
	</table>
	</form>
</body>
</html>
<?php include('footer.php'); ?>