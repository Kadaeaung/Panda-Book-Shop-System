<?php  

function AddShoppingCart($BookID,$Quantity)
{
	include('connect.php');
	$query="SELECT * FROM Book WHERE BookID='$BookID'";
	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);

	if($count < 1) 
	{
		echo "<p>Book ID not found.</p>";
		exit();
	}
	$row=mysqli_fetch_array($result);
	$BookName=$row['BookName'];
	$Price=$row['Price'];
	$BookImage=$row['BookImage'];

	if(isset($_SESSION['ShoppingCartFunctions'])) 
	{
		$Index=IndexOf($Book_ID);
		
		if($Index == -1) 
		{
			$size=count($_SESSION['ShoppingCartFunctions']);

			$_SESSION['ShoppingCartFunctions'][$size]['BookID']=$BookID;
			$_SESSION['ShoppingCartFunctions'][$size]['BookName']=$BookName;
			$_SESSION['ShoppingCartFunctions'][$size]['Price']=$Price;
			$_SESSION['ShoppingCartFunctions'][$size]['Quantity']=$Quantity;
			$_SESSION['ShoppingCartFunctions'][$size]['BookImage']=$BookImage;
		}
		else
		{
			$_SESSION['ShoppingCartFunctions'][$Index]['Quantity']+=$BuyQty;
		}
	}
	else
	{
		$_SESSION['ShoppingCartFunctions']=array(); //Create Session Array

		$_SESSION['ShoppingCartFunctions'][0]['BookImage']=$BookImage;
		$_SESSION['ShoppingCartFunctions'][0]['BookID']=$BookID;
		$_SESSION['ShoppingCartFunctions'][0]['BookName']=$BookName;
		$_SESSION['ShoppingCartFunctions'][0]['Price']=$Price;
		$_SESSION['ShoppingCartFunctions'][0]['Quantity']=$Quantity;
	}
	echo "<script>window.location='shoppingcart.php'</script>";
}

function RemoveShoppingCart($ProductID)
{
	$Index=IndexOf($ProductID);
	unset($_SESSION['ShoppingCartFunctions'][$Index]);
	$_SESSION['ShoppingCartFunctions']=array_values($_SESSION['ShoppingCartFunctions']);

	echo "<script>window.location='shoppingcart.php'</script>";
}

function ClearShoppingCart()
{	
	unset($_SESSION['ShoppingCartFunctions']);
	echo "<script>window.location='shoppingcart.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$size=count($_SESSION['ShoppingCartFunctions']);

	for($i=0;$i<$size;$i++) 
	{ 
		$ProductAmount=$_SESSION['ShoppingCartFunctions'][$i]['Price'];
		$BuyQty=$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
		$TotalAmount+=($ProductAmount * $BuyQty);
	}
	return $TotalAmount;
}


function CalculateTotalQuantity()
{
	$TotalQuantity=0;
	$size=count($_SESSION['ShoppingCartFunctions']);

	for ($i=0; $i <$size ; $i++) 
	{ 
		$BuyQty=$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
		$TotalQuantity+=$BuyQty;
	}
	return $TotalQuantity;
}

function IndexOf($ProductID)
{
	if (!isset($_SESSION['ShoppingCartFunctions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['ShoppingCartFunctions']);

	if ($size < 1) 
	{
		return -1;
	}

	for ($i=0;$i<$size;$i++) 
	{ 
		if($ProductID == $_SESSION['ShoppingCartFunctions'][$i]['BookID']) 
		{
			return $i;
		}
	}
	return -1;
}

?>