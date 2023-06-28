<?php  

function Add($ProductID,$PurchasePrice,$PurchaseQuantity)
{
	$connection=mysqli_connect("localhost","root","","book_shop_db");
	$query="SELECT * FROM Book WHERE BookID='$ProductID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	
	if($count<1) 
	{
		echo "<p>No Record Found.</p>";
		exit();
	}

	$arr=mysqli_fetch_array($ret);
	$ProductName=$arr['BookName'];
	$Image1=$arr['BookImage'];

	if(isset($_SESSION['PurchaseFunction'])) 
	{
		$index=IndexOf($ProductID);

		if($index==-1) 
		{
			$size=count($_SESSION['PurchaseFunction']);

			$_SESSION['PurchaseFunction'][$size]['ProductID']=$ProductID;
			$_SESSION['PurchaseFunction'][$size]['ProductName']=$ProductName;
			$_SESSION['PurchaseFunction'][$size]['PurchasePrice']=$PurchasePrice;
			$_SESSION['PurchaseFunction'][$size]['PurchaseQuantity']=$PurchaseQuantity;
			$_SESSION['PurchaseFunction'][$size]['Image1']=$Image1;	
		}
		else
		{
			$_SESSION['PurchaseFunction'][$index]['PurchaseQuantity']+=$PurchaseQuantity;
		}
	}
	else
	{
		$_SESSION['PurchaseFunction']=array();

		$_SESSION['PurchaseFunction'][0]['ProductID']=$ProductID;
		$_SESSION['PurchaseFunction'][0]['ProductName']=$ProductName;
		$_SESSION['PurchaseFunction'][0]['PurchasePrice']=$PurchasePrice;
		$_SESSION['PurchaseFunction'][0]['PurchaseQuantity']=$PurchaseQuantity;
		$_SESSION['PurchaseFunction'][0]['Image1']=$Image1;
	}
	echo "<script>window.location='Purchase.php'</script>";
}

function Remove($ProductID)
{
	$index=IndexOf($ProductID);

	if($index!=-1) 
	{
		unset($_SESSION['PurchaseFunction'][$index]);
		echo "<script>window.location='Purchase.php'</script>";
	}
}


function CalculateTotalQuantity()
{
	$totalQty=0;

	if(!isset($_SESSION['PurchaseFunction'])) 
	{
		return 0;
	}

	$size=count($_SESSION['PurchaseFunction']);

	for ($i=0;$i<$size;$i++) 
	{ 
		$Quantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];
		$totalQty=$totalQty + ($Quantity);
	}
	return $totalQty;
}

function CalculateTax()
{
	$Tax=0;
	$TotalAmount=CalculateTotalAmount();
	$Tax=$TotalAmount * 0.05;

	return $Tax;
}

function CalculateNetAmount()
{
	$NetAmount=0;

	$TotalAmount=CalculateTotalAmount();
	$Tax=CalculateTax();

	$NetAmount=$TotalAmount + $Tax;

	return $NetAmount;
}

function ClearAll()
{
	unset($_SESSION['PurchaseFunction']);
	echo "<script>window.location='Purchase.php'</script>";
}


function CalculateTotalAmount()
{
	$totalamount=0;

	$size=count($_SESSION['PurchaseFunction']);

	for($i=0;$i<$size;$i++) 
	{ 
		$PurchasePrice=$_SESSION['PurchaseFunction'][$i]['PurchasePrice'];
		$PurchaseQuantity=$_SESSION['PurchaseFunction'][$i]['PurchaseQuantity'];
		$totalamount=$totalamount + ($PurchasePrice * $PurchaseQuantity);
	}
	return $totalamount;
}



function IndexOf($ProductID)
{
	if(!isset($_SESSION['PurchaseFunction'])) 
	{
		return -1;
	}

	$size=count($_SESSION['PurchaseFunction']);

	if($size==0) 
	{
		return -1;
	}

	for($i=0;$i<$size;$i++) 
	{ 
		if($ProductID == $_SESSION['PurchaseFunction'][$i]['ProductID']) 
		{
			return $i;
		}
	}
	return -1;
}

?>