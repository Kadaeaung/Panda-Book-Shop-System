<?php 
session_start(); 
include('connect.php');
include('AutoID_Functions.php');
include('Purchase_Functions.php');
include('header1.php');
/*if(!isset($_SESSION['StaffID'])) 
{
	echo "<script>window.alert('Please login first to continue.')</script>";
	echo "<script>window.location='Staff_Login.php'</script>";
}*/

if(isset($_GET['btnSave'])) 
{
	$cboSupplierID=$_GET['cboSupplierID'];

	$StaffID=1; //Call from Staff SESSION 

	/*if() 
	{
		# Check ComboBox
	}*/

	$txtpurchaseID=$_GET['txtpurchaseID'];
	$txtpurchaseDate=$_GET['txtpurchaseDate'];
	
	$TotalAmount=CalculateTotalAmount();
	$NetAmount=CalculateNetAmount(); //Call NetAmount Fun:
	$TotalQuantity=CalculateTotalQuantity();	 //Call TotalQuantity Fun:
	$Status="Pending";

	$insert_Pur="INSERT INTO `purchase`
				(`PurchaseID`, `PurchaseDate`, `SupplierID`, `StaffID`,`TotalAmount`, `NetAmount`, `TotalQuantity`, `Status`) 
				VALUES
				('$txtpurchaseID','$txtpurchaseDate','$cboSupplierID','$StaffID','$TotalAmount','$NetAmount','$TotalQuantity','$Status')";
	$ret=mysqli_query($connection,$insert_Pur);

	$size=count($_SESSION['PurchaseFunction']);

	for($i=0;$i<$size;$i++) 
	{ 
		$ProductID=$_SESSION['PurchaseFunction'][$i]['ProductID'];
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['PurchasePrice'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];

		$inser_PDetail="INSERT INTO Purchasedetail
						(PurchaseID,BookID,PurchasePrice,PurchaseQuantity)
						VALUES 
						('$txtpurchaseID','$ProductID','$PurchasePrice','$PurchaseQuantity')";
		$ret=mysqli_query($connection,$inser_PDetail);

		$update_Qty="UPDATE Book
					 SET Quantity=Quantity + '$PurchaseQuantity'
					 WHERE BookID='$ProductID'";
		$ret=mysqli_query($connection,$update_Qty);
	}

	if($ret) 
	{
		unset($_SESSION['PurchaseFunction']);

		echo "<script>window.alert('Purchase Process Complete.')</script>";
		echo "<script>window.location='Purchase.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Purchase : " . mysqli_error($connection) . "</p>";
	}
}


if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if($action==='add') 
	{
		$ProductID=$_GET['cboProductID'];
		$PurchasePrice=$_GET['txtpurchaseprice'];
		$PurchaseQuantity=$_GET['txtpurchasequantity'];
		Add($ProductID,$PurchasePrice,$PurchaseQuantity);
	}
	elseif($action==='remove') 
	{
		$ProductID=$_GET['ProductID'];
		Remove($ProductID);
	}
	elseif($action==='clearall') 
	{
		ClearAll();
	}
}


?>

<script>
$(document).ready( function () {
	$('#tableid').DataTable();
} );
</script>

							</div>
						</div>
					</div>						
				
<form action="Purchase.php" method="get">
<input type="hidden" name="action" value="add"/>
<fieldset>
<legend>Enter Product Purchase Info:</legend>
<table align="center" cellpadding="5px">
<tr>
	<td>PurchaseID</td>
	<td>
	<input type="text" name="txtpurchaseID" value="<?php echo AutoID('purchase','PurchaseID','PUR-',6) ?>" readonly required/>
	</td>
</tr>
<tr>
	<td>PurchaseDate</td>
	<td>
	<input type="text" name="txtpurchaseDate" value="<?php echo date('Y-m-d') ?>" readonly required/>
	</td>
</tr>
<tr>
	<td>TotalAmount</td>
	<td>
	<input type="number" name="txttotalamount" value="<?php echo CalculateTotalAmount() ?>" required readonly/> MMK
	</td>
</tr>
<tr>
	<td>NetAmount</td>
	<td>
	<input type="number" name="txtnetamount" value="<?php echo CalculateNetAmount() ?>"  readonly/> MMK
	</td>
</tr>
<tr>
	<td>TotalQuantity</td>
	<td>
	<input type="number" name="txttotalqty" value="<?php echo CalculateTotalQuantity() ?>"  readonly/> pcs
	</td>
</tr>
<tr>	
	<td colspan="2">
		<hr>
	</td>
</tr>
<tr>
	<td>ProductID</td>
	<td>
	<select name="cboProductID">
	<option>---Select BookID---</option>
	<?php  
	$query="SELECT * FROM Book";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);

	for($i=0;$i<$count;$i++) 
	{ 
		$arr=mysqli_fetch_array($ret);
		$ProductID=$arr['BookID'];
		$ProductName=$arr['BookName'];
		echo "<option value='$ProductID'>" . $ProductID . ' ~ ' . $ProductName . "</option>";
	}

	?>
	</select>
	</td>
</tr>
<tr>
	<td>Purchase Price</td>
	<td>
	<input type="number" name="txtpurchaseprice" placeholder="0" /> MMK
	</td>
</tr>
<tr>
	<td>Purchase Quantity</td>
	<td>
	<input type="number" name="txtpurchasequantity" placeholder="0" /> MMK
	</td>
</tr>
<tr>
	<td></td>
	<td>
	<input type="submit" name="btnAdd" value="Add"/>
	<input type="reset" value="Clear"/>
	</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Purchase Detail :</legend>

<?php  
if(!isset($_SESSION['PurchaseFunction'])) 
{
	echo "<p>No Purchase Record Found.</p>";
	exit();
}
?>

<table align="center" border="1" cellpadding="3px">
<tr>
	<th>Image</th>
	<th>ProductID</th>
	<th>ProductName</th>
	<th>Purchase Price</th>
	<th>Purchase Qty</th>
	<th>Sub Total</th>
	<th>Action</th>
</tr>
<?php

	$size=count($_SESSION['PurchaseFunction']);

	for ($i=0;$i<$size;$i++) 
	{ 	
		$Image1=$_SESSION['PurchaseFunction'][$i]['Image1'];
		$ProductID=$_SESSION['PurchaseFunction'][$i]['ProductID'];
		$ProductName=$_SESSION['PurchaseFunction'][$i]['ProductName'];
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['PurchasePrice'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];
		$SubTotal=$PurchasePrice * $PurchaseQuantity;

		echo "<tr>";
		echo "<td><img src='$Image1' width='100px' height='100px'/></td>";
		echo "<td>$ProductID</td>";
		echo "<td>$ProductName</td>";
		echo "<td>$PurchasePrice MMK</td>";
		echo "<td>$PurchaseQuantity Pcs</td>";
		echo "<td>$SubTotal MMK</td>";

		echo "<td><a href='Purchase.php?action=remove&ProductID=$ProductID'>Remove</a></td>";

		echo "</tr>";
	}
?>
<tr>
	<td colspan='7' align="right">

		<select name="cboSupplierID">
		<option value="0">---Select SupplierID---</option>
		<option value='1'>1 - MK</option>
		</select> |

		<input type="submit" name="btnSave" value="Save"/> |

		<a href="Purchase.php?action=clearall">Clear All</a> 

	</td>
</tr>
</table>

</fieldset>
</form>
				</div>	
			</section>

			<!-- End blog Area -->
			

			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>About Us</h6>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
								</p>
								<p class="footer-text">
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								</p>								
							</div>
						</div>
						<div class="col-lg-5  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Newsletter</h6>
								<p>Stay update with our latest</p>
								<div class="" id="mc_embed_signup">
									<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
										<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
			                            	<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
			                            	<div style="position: absolute; left: -5000px;">
												<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
											</div>

										<div class="info pt-20"></div>
									</form>
								</div>
							</div>
						</div>						
						<div class="col-lg-2 col-md-6 col-sm-6 social-widget">
							<div class="single-footer-widget">
								<h6>Follow Us</h6>
								<p>Let us be social</p>
								<div class="footer-social d-flex align-items-center">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-dribbble"></i></a>
									<a href="#"><i class="fa fa-behance"></i></a>
								</div>
							</div>
						</div>							
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->	

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>			
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>	
			<script src="js/waypoints.min.js"></script>
			<script src="js/jquery.counterup.min.js"></script>					
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>

<?php include('footer.php'); ?>

