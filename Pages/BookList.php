<<?php 
   include('connect.php'); 
   ?>

<html>
<head>
	<title></title>
</head>
<body>
       <form action="BookList.php" method="POST" >
          <table>
          	 <tr>
          	 	<td>Book</td>
          	 	<td>BookImage</td>
          	 	<td>Price</td>
          	 	<td>Quantity</td>
          	 	<td>Description</td>
          	 	<td>Action</td>
          	 </tr>

          	 <?php
          	 $select="Select * from book b, b.pubisher p ,author a 
          	 ";
          	 $query=mysqli_query($connect,$select);
          	 $count=mysqli_num_rows($query);
                        if($count>0)
                       {
                       	  for ($i=0; $i < count ;i++) 
                       	  { 
                       	        	$data=mysqli_fetch_array($query);
                       	$bookid=$data['bookid'];
                       	$bookname=$data['bookname'];
                       	$publisher=$data['publishername'];
                       	$price=$data['price'];
                       	$quantity=$data['quantity'];
                       	$description=$data['description'];

                       	echo "<tr>
                       	       <td>bookid</td>
                       	       <td>$bookname</td>
                       	       <td>$publishername</td>
                       	       <td>$price</td>
                       	       <td>$quantity</td>
                       	       <td>$description</td>
                       	       <td><a href='BookUpdate.php ?bid=$bookid'</a> Update| <a href='BookDelete.php'Delete</a>
                       	        <td> <a href='BookUpdate.php'</td>
                       	      </tr>";
                       	  }
                       	
                       }
          	 ?>
          </table>
       </form>
</body>
</html>