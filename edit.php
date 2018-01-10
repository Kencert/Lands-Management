<?php
session_start();
include 'connection.php'; 

 if (!isset($_SESSION['ID'])){
    echo "<script>alert('Please login first!')</script>";
    echo"<script>window.open('login.php','_self')</script>";
          }
$expire_time = 5*60; //expire time
  if( $_SESSION['activity'] < time()-$expire_time ) {
    echo "<script> alert('Session expired')</script>";
    echo "<script>window.open ('logout.php','_self')</script>";
    
    die();  
    }
  else {
    $_SESSION['activity'] = time(); // you have to add this line when logged in also;
    }

$select=sqlsrv_query( $conn, "SELECT * FROM Logins Where Id_no = '" . ($_SESSION['ID'])  . "' ");
while($userrow=sqlsrv_fetch_array($select))  {  
  $username=$userrow['uname'];
  $surname=$userrow['sname'];
  $home=$userrow['home'];
  $password=$userrow['password'];
  $email = $userrow ['user_mail'];
  $id = $userrow ['Id_no'];

?>

<?php } ?>
<!-- Copyright 2017 Kenedy Cheruiyot All rights reserved. -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- HTML Standard in openning html tag meta tag and doctype. -->
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Edit Details</title>
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

<div class="container" style="background-color: #d2f3f3;">

<form id ="form" name="Registration" method="post" action="edit.php">
   <table width="100%" border="1" align="center" style="border-radius: 30px;">
   <tr>
     <td align ='center' colspan = '6' style="border-top-right-radius:30px; border-top-left-radius: 30px;">
     <h1><b>Your Registered Details</b></h1>
     </td>
   </tr>
   <tr>
     <td>First Name:</td>
     <td><input type='text'  name = 'txtuname' required="text" value="<?php echo $username; ?>" /></td>
   </tr>
   <tr>
     <td>Sur Name:</td>
     <td><input type='text'  name = 'txtsname' required="text" value="<?php echo $surname; ?>" /></td>
   </tr>
   <tr>
     <td>Hometown:</td>
     <td><input type='text'  name = 'txthome' required="text" value="<?php echo $home ?>" /></td>
   </tr>
   <tr>
     <td>Email Address:</td>
     <td><input type='email'  name = 'txtemail' required="email" value="<?php echo $email ?>" /></td>
   </tr>
   <tr>
     <td>ID Number:</td>
     <td><input type='number'  name = 'txtid' required="number" value="<?php echo $id ?>" /></td>
   </tr>
   <tr>
     <td>Input Password:</td>
     <td><input type='password'  name = 'txtpass' required="password" value="<?php echo $password; ?>" /></td>
   </tr>
     <td align='center' colspan='6' style="border-bottom-right-radius:30px; border-bottom-left-radius: 30px;">
     <input type='submit'  name = 'submit' value = 'Update Details' class="btn"  align='center' colspan='6'>
     <input type='button'  name = 'delete' onclick="window.location='confirm.php'" value = 'Delete Records' class="btn" />
   </table>
    
</form>

</div>
<?php
include 'footer.php';
?>
</body>
</html>
<?php
include 'connection.php'; 
if(isset($_POST['submit'])){
  $name = $_POST ['txtuname'];
  $sname = $_POST ['txtsname'];
  $home = $_POST ['txthome'];
  $pass = $_POST ['txtpass'];
  $email = $_POST ['txtemail'];
  $id = $_POST ['txtid'];
      
if( $conn === false ) {
   echo "<script> alert ('Connection Error!.')</script>";
  }
//Select Query
$tsql= " Update Logins SET uname = '$name', sname = '$sname',home = '$home',password = '$pass',user_mail='$email', Id_no ='$id' Where Id_no = '" . ($_SESSION['ID']). "' ";
//Executes the query
$getResults= sqlsrv_query( $conn, $tsql );
//Error handling
if ($getResults){
  echo "<script> alert ('Records were updated successfully.')</script>";
  echo "<script> window.open('login.php','_self')</script>";
}
else {
  echo "ERROR: Could not able to execute $sql. " ;
}
if ( $getResults == FALSE )
    echo "<script> alert ('Could not execute Query!.')</script>";
}
?> 