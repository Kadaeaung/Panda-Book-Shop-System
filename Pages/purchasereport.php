<?php 
	include('connect.php');

	if (isset($_POST['btnsearch']))
	{
	 $SearchType=$_POST['rdosearch'];
		if ($SearchType==="1") 
		{
			$cboPurchaseID=$_POST['cboPurchaseID'];

			$query="SELECT p.PurchaseID,p.PurchaseDate,p.TotalAmount,p.TotalQuantity,s.SupplierID,s.Supplier_Name
				From purchase p,supplier s
				where p.PurchaseID='$cboPurchaseID'
				and s.SupplierID=p.SupplierID
				";
		}
		else if ($SearchType==="2") 
		{
			$cboPurchaseID=$_POST['cboPurchaseID'];

				$query="SELECT p.*,s.SupplierID,s.Supplier_Name,pr.ProductID,
				pr.Product_Name,pd.ProductID,pd.purchaseID
				From purchase p,supplier s,product pr,purchasedetail pd
				where s.SupplierID=p.SupplierID
				and pd.productID=pr.productID
				and s.SupplierID=p.SupplierID
				and p.PurchaseID='$cboPurchaseID'";
		}
		
	}

	elseif (isset($_POST['btnshowall'])) 
	{
		$query="SELECT  p.*,s.SupplierID,s.Supplier_Name
				From purchase p,supplier s
				where s.SupplierID=p.SupplierID";
	}

	else
	{
		$TodayDate=date('Y-m-d');

		$query="SELECT p.*,s.SupplierID,s.Supplier_Name,pr.BookID,
				pr.Book_Name,pd.BID,pd.purchaseID
				From purchase p,supplier s,book b,purchasedetail pd
				where s.SupplierID=p.SupplierID
				and pd.BookID=b.BookID
				and s.SupplierID=p.SupplierID
				and p.PurchaseDate='$TodayDate'";
	}
 ?>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="purchasereport.php" method="post">
		<table cellpadding="5px">
		<tr>
			<td>
				<input type="radio" name="rdosearch" value="1" checked>Search by ID: <br/>
				<select name="cboPurchaseID">
				<option>Choose PurchaseID</option>
				<?php 
				
				$query1="SELECT * from Purchase";

				$ret1=mysqli_query($connection,$query1);
				$count1=mysqli_num_rows($ret1);

				for ($i=0; $i <$count1 ; $i++) 
				{ 
					$arr=mysqli_fetch_array($ret1);

					$PurchaseID=$arr['PurchaseID'];
					$SupplierName=$arr['Supplier_Name'];

					echo "<option value='$PurchaseID'>".$PurchaseID."</option>";
				}
				 ?>
				</select>
			</td>
			<td>
				<input type="radio" name="rdosearch" value="2" checked>Search by Date: <br/>
				From:<input type="text" name="txtfrom" value="<?php echo date('Y-m-d') ?>"/>
				To:<input type="text" name="txtto" value="<?php echo date('Y-m-d') ?>"/>
			</td>
			<td>
				<input type="submit" name="btnsearch" value="Search">
				<input type="submit" name="btnshowall" value="Show All">
				<input type="reset" value="Cancel">
			</td>
		</tr>
		</table>
		<?php 
			$result=mysqli_query($connection,$query);
			$count=mysqli_num_rows($result);

			if ($count==0) 
			{
				echo "<p>No Purchase Result Found.</p>";
				//exit();
			}
		 ?>
		 <table>
		 	<tr>
		 		<th>Purchase ID</th>
		 		<th>Purchase Date</th>
		 		<th>Supplier Name</th>
		 		<th>Total Amount</th>
		 		<th>Total Quantity</th>
		 	</tr>
		 	<?php 
		 		for ($i=0; $i <$count ; $i++) 
		 		{ 
		 			$arr=mysqli_fetch_array($result);

		 			$PurchaseID=$arr['PurchaseID'];
		 			$PurchaseDate=$arr['PurchaseDate'];
		 			$Supplier_Name=$arr['Supplier_Name'];
		// 			$Product_Name=$arr['Product_Name'];
		 			$TotalAmount=$arr['TotalAmount'];
		 			$TotalQuantity=$arr['Qty'];
		 			echo "<tr>";
		 			echo "<td>$PurchaseID</td>";
		 			echo "<td>$PurchaseDate</td>";
		 			echo "<td>$Supplier_Name</td>";
//		 			echo "<td>$Product_Name</td>";
		 			echo "<td>$TotalAmount</td>";
		 			echo "<td>$TotalQuantity</td>";
		 			echo "</tr>";
		 		}
		 	 ?>
		 </table>
	</form>
</body>
</html>

