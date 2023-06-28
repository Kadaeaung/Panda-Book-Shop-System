<?php
     include('Connect.php');
     if(isset($_REQUEST['BID']))
     {
     	$bid=$_REQUEST['BID'];
      $select="SELECT * FROM Book where BookID='$bid'";
      $query=mysqli_query($connection,$select);
      $count=mysqli_num_rows($query);
      if($count>0)
      {
        $data=mysqli_fetch_array($query);
        $bookname=$data['BookName'];
        $price=$data['Price'];
         $quantity=$data['Quantity'];
          $description=$data['Description'];
        
      }
    }

        if(isset($_POST['btnSave']))
        {
           
              $bname=$_POST['txtbookname'];
              $price=$_POST['txtprice'];
              $quantity=$_POST['txtquantity'];
              $description=$_POST['txtdescription'];
              $authorid=$_POST['cboAuthor']
              $publisherid=$_POST['cbopublisher']
              $categoryid=$_POST['cboCategory'];


              $update="UPDATE book SET BookName='$bname ,Price='$price' ,Quantity='$quantity',Description='$description',CategoryID='$categoryid',AuthorID='$authorid',PublisherID='$cbopublisherid' where bookid='$bookid'";
        }
      
     ?>

     <html>
     <head>
     	<title></title>
     </head>
     <body>
        <form action="Book_Entry.php" method="post" enctype="multipart/form-data">
                 
                  <div class="mt-10">
                    <input type="text" name="txtbookname" class="form-control" value="<?php   echo $bookname ?>" required  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Book Name'" required class="single-input">
                  </div>
                  <div class="mt-10">
                    <input type="number" name="txtprice" class="form-control" value="<?php  echo $price ?>" min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Price'" required class="single-input">
                  </div>
                  <div class="mt-10">
                    <input type="number" name="txtquantity" class="form-control" value="<?php  echo $quantity ?>"  min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Quantity'" required class="single-input">
                  </div>
                  <div class="mt-10">
                    <input type="file" class="form-control" name="fileBookImage"placeholder="Enter Quantity"  min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'BookImage'" required class="single-input">
                  </div>

                  <div class="mt-10">
                    <textarea name="txtdescription" class="form-control" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" required>
                      

                      <?php  echo $description ?>
                    </textarea>
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
                   <div class="icon"><i  aria-hidden="true"></i></div>
                    <div class="form-select" >


                      
                    <select name="cbopublisher" class="form-control">
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
                  <div class="mt-10">
                    <input type="submit" name="btnSave" value="Update" class="form-control" placeholder="Enter Save"  min="0" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Save'" required class="single-input">
                   
                
                  </div>

                  
                  <!-- For Gradient Border Use -->
                  <!-- <div class="mt-10">
                    <div class="primary-input">
                      <input id="primary-input" type="text" name="first_name" placeholder="Primary color" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Primary color'">
                      <label for="primary-input"></label>
                    </div>
                  </div> -->
                  
                </form>
     </body>
     </html>