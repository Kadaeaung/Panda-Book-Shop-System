<?php 
session_start();
  include('connect.php');
  if (isset($_SESSION['BID']))
  {
    
    echo "<script>alert('login again')
    window.location='Customer_Login.php'
    </script>";
  }
  include('AutoID_Functions.php');
  if (isset($_REQUEST['BID'])) 
  {
   $BID=$_REQUEST['BID'];
   $select="SELECT * FROM Book where BookID='$BID'";
   $result=mysqli_query($connection,$select);
   $count=mysqli_num_rows($result);
   if ($count) 
   {
     $arr=mysqli_fetch_array($result);
     $Product_ID=$arr['BookID'];
     $Book_Name=$arr['BookName'];
     $Book_Amount=$arr['Price'];
     $Book_Quantity=$arr['Quantity'];
     $BookImage=$arr['BookImage'];
     $Description=$arr['Description'];
   }
  
  }

  if(isset($_POST['btnadd']))
   {
    $BookID=$_POST['txtBookID'];
    $OrderID=$_POST['txtOrderID'];
    $Price=$_POST['txtPrice'];
    $Book_Quantity=$_POST['txtbuyquantity'];
    $BookImage=$_POST['Book_Image'];
    $OrderDate=date('Y/m/d');
    $TotalAmount=$Price*$BuyQuantity;

    $Order="INSERT INTO Orders VALUES
        ('$OrderID','$OrderDate','$BuyQuantity','$TotalAmount')";
    $result=mysqli_query($Order);
    if ($result) 
    {
      $BookDetail="INSERT INTO BookDetail VALUES ('$OrderID','$BookID')";
      $ret=mysqli_query($BookDetail);

      if ($ret) 
      {
        echo "<script>alert('Order Successful');</script>";
      }
      else
      {
        echo "<script>alert('Cannot Order');</script>";
      }
    }
  
  }
  include('header.php');
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title></title>
  </head>
  <body>
    <form action="shoppingcart.php" method="GET" enctype="multipart/form-data">
      <input type="hidden" name="txtBookID" value="<?php echo $BID; ?>">
      <input type="hidden" name="action" value="buy"/>
    <table align="center" width="1000px" height="300px">
      <tr>
        <td width="400px"><img src="<?php echo $BookImage?>" style="border:1px solid #000; margin:20px;" width="300px" height="300px"></td>
        <td>
          <table width="500px" height="100px" border="1px">
            <tr>
              <td width="300px">Book Name:</td>
              <td>
                <b><?php echo $Book_Name?></b>

                </td>
            </tr>

       
            <tr>
              <td>Book Amount:</td>
              <td>
                <b style="color:blue;"><?php echo $Book_Amount ?></b>
              </td>
            </tr>

            <tr>
              <td>Avaliable Quantity:</td>
              <td>
              <b><?php echo $Book_Quantity; ?>
              
            </b>
              </td>
            </tr>

            <tr>
              <td>Buying Quantity</td>
              <td>
                <input type="number" name="txtbuyquantity" min="1" max="<?php echo $Book_Quantity ?>" value="0">
              </td>
            </tr>
            <tr>
          
        <td>Description:</td>
        <td width="500px"><?php echo $Description;?></td>
      </tr>
      <tr>
        <td></td>
        <td>  <button><a href="BookDisplay.php">Back to Display</a></button>
          <input type="submit" name="btnadd" value="Add to Cart"/></td>
      </tr>
          </table>
        </td>
      </tr>
      
    </table>
    </form>
  </body>
  </html>
  <?php include('footer.php'); ?>