<?php 
include('connect.php');
include('header.php');
?>
<html>
<head>
  <title></title>
</head>
<body>
  <fieldset>
    <legend>Book Display</legend>
    <table style=" margin-left:300px;  " 
           cellpadding="40">
      <?php 
      $query="SELECT * FROM book ORDER BY BookID DESC";
      $ret=mysqli_query($connection,$query);
      $count=mysqli_num_rows($ret);
      if ($count==0) 
      {
        echo "<p>No Book Found.</p>";
        exit();
      }
      else
      {
        for ($a=0; $a <$count ; $a+=3) 
        { 
          $query1="SELECT * FROM book 
          ORDER BY BookID DESC LIMIT $a,3";
          $ret1=mysqli_query($connection,$query1);
          $count1=mysqli_num_rows($ret1);

          echo "<tr>";
          for ($i=0; $i <$count1 ; $i++) 
          { 
            $data=mysqli_fetch_array($ret1);
            $BookID=$data['BookID'];
            $BookName=$data['BookName'];
            $BookImage=$data['BookImage'];
            echo "<td>
            <img src='$BookImage' width='200px' height='200px'><br>
            $BookName<br>
            <a href='BookDetail.php?BID=$BookID'>Detail</a>
                </td>";
          }
          echo "</tr>";
        }
      }
      ?>
    </table>
  </fieldset>
</body>
</html>
<?php include('footer.php') ?>