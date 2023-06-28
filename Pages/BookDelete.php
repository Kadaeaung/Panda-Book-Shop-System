<?php

    include('Connect.php');
    if(isset($_REQUEST['bid']))  
    {
    	$bookid=$_REQUEST['bid'];
    	$delete="Delete from Book where ProductID='$bookid'";
    	$query=mysqli_query($connection,$delete);
    	if($query)
    	{
    		echo "<script>altert('book delete successful') 
    		        window.location='booklist.php'
    		        </script>";

    	}
    	else
    	{
    		echo mysqli_error($connection); 
    	}
    }
   ?>