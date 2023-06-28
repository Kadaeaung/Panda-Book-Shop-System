<?php
 session_start();
 session_destroy();

 echo "<script>window.alert('Logout Sucessful')</script>";
 echo "<script>window.location='Login.php'</script>";
?>