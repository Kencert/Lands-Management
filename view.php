<?php
session_start();
 if (!isset($_SESSION['ID'])){
  echo "<script>alert('Please login first!')</script>";
  echo"<script>window.open('index.php','_self')</script>";
 }
include 'connection.php'; 
$select=sqlsrv_query( $conn, "SELECT * FROM Logins Where Id_no = '" . ($_SESSION['ID']) . "' ");
while($userrow=sqlsrv_fetch_array($select))  {
  $username=$userrow['uname'];
  $surname=$userrow['sname'];
  $home=$userrow['home'];
  $password=$userrow['password'];
  $email = $userrow ['user_mail'];
  $id = $userrow ['Id_no'];
  ?>
<script>
function printContent(el){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}
</script>
<div id = "container" class = "container" style="background-color: #d2f3f3">
  <h3><u>Personal Details</u></h3>
  <p> First Name : <span><?php echo $username; ?></span></p>
  <p>Sur Name : <span><?php echo $surname; ?></span></p>
  <p>Home Town : <span><?php echo $home; ?></span></p>
  <p>ID Number : <span><?php echo $id; ?></span></p>
  <p>Email Address : <span><?php echo $email; ?></span></p>
</div>
<input type='button'  name = 'edit' onclick="window.location='edit.php'" value = 'Edit Record' class="btn" />
<button onclick="printContent('container')" class="btn" >Print Content </button>

<?php } ?>
<!-- Copyright 2017 Kenedy Cheruiyot All rights reserved. -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- HTML Standard in openning html tag meta tag and doctype. -->
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Personal Details</title>
   <!-- CSS file with styles appearance in document.
   Meta describes the contents in various types of views -->
   <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
  

<body style="background-image: url('download.jpg'); min-height: 100vh; background-position: center center; background-size: cover; position: relative;">
<!-- Main header as class defined in css script-->
<header class = "main-header">
<?php
include 'menu.php'; 
?> 
</header>
<?php
include 'footer.php';
?>

</body>
</html>
