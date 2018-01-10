<!-- Copyright 2017 Kenedy Cheruiyot All rights reserved. -->
<?php 

session_start();
include 'connection.php'; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- HTML Standard in openning html tag meta tag and doctype. -->
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title> Land Management System </title>
   <!-- CSS file with styles appearance in document.
   Meta describes the contents in various types of views -->
   <link rel="stylesheet" type="text/css" href="style.css" media="screen"  />
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
	
<header class = "main-header">
<?php
include 'menu.php'; 
?> 

<body style="background-image: url('index.jpg'); min-height: 100vh; background-position: center center; background-size: cover;">
<div  style="width : 99% ;  margin-top: 110px; margin-left: 10px;margin-right: 10px;  height: 300px ;">
<div  style="background-image: url('IND.jpg'); width : 100% ; height: 100% ;background-size: cover; background-position: center;"></div>
</div>


<div class="container1" style="background-color: #d2f3f3; margin-top:10px; width: 100%;">

  
  <p> Welcome to Land Management System.  Register of Login to continue using our services. <br> Make sure you provice valid details while registering</p>
  <p class="login__signup">Have an account? &nbsp;<a href="login.php">Log In</a></p>
  <p class="login__signup"> Dont have an account? &nbsp;<a href="registration2.php">Sign Up</a></p>

		
		
		
    


</div>
<?php
include 'footer.php';
?>

</body>
</html>
<!-- PHP function validating the user information from the ones in the database. -->

<?php

if(isset($_POST['submit'])){
 	echo "<script>alert ('Welcome!')</script>";
 	echo "<script> window.open('registration2.php','_self')</script>";
}
?> 
 