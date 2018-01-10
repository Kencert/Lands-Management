
<!-- Copyright 2017 Kenedy Cheruiyot All rights reserved. -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

 session_start();
 include 'connection.php'; 
  if (!isset($_SESSION['ID'])){
    echo '<script language="javascript">';
    echo 'alert("Please Login first!.")';
    echo '</script>';
    echo"<script>window.open('index.php','_self')</script>";
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
    $level =sqlsrv_query( $conn, "SELECT access FROM Logins where Id_no = '" . ($_SESSION['ID']). "'  ");
    $row = sqlsrv_fetch_array($level);
    if ($row['access'] == "Admin" or $row['access'] == "Write" or $row['access'] == "Modify"){
        echo "<script> window.location.href('registration.php')</script>";
        }
    else {
        echo "<script>alert ('You Do Not Have Access.')</script>";
        echo "<script> window.open('index.php','_self')</script>";
          }
        ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- HTML Standard in openning html tag meta tag and doctype. -->
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Setup</title>
   <!-- CSS file with styles appearance in document.
   Meta describes the contents in various types of views -->
   <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
  

<body style="background-image: url('download.jpg'); min-height: 100vh;  background-position: center center;  background-size: cover;  position: relative;"><!-- Main header as class defined in css script-->
<header class = "main-header">
<?php
include 'menu.php'; 
?> 
</header>


<div class="container" style="background-color: #d2f3f3;">

<form id ="form" name="Registration" method="post" action="setups.php">
   <table width="100%" border="1" align="center" style="border-radius: 30px;">
   <tr>
     <td align ='center' colspan = '6' style="border-top-right-radius:30px; border-top-left-radius: 30px;" >
     <h1><b>Setups</b></h1></td>
   </tr>
   <tr>
     <td>Type:</td>
     <td><select name="type"><option></option><option>County</option><option>Subcounty</option><option>Market Centers</option><option>Zone</option></select></td>
   </tr>
   <tr>
     <td>Population Density:</td>
     <td><select name="popu"><option></option><option>Dense</option><option>Sparse</option><option>Clustered</option></select></td>
   </tr>
   <tr>
     <td>Name:</td>
     <td><input type='text'  name = 'txtname' placeholder="Enter Name!" required="text" /></td>
   </tr>
   <tr>
     <td>Location Description:</td>
     <td><input type='text'  name = 'txtloc' placeholder="Enter Location!" required="" /></td>
   </tr>
   
     
     <td align='center' colspan='6' style="border-bottom-right-radius:30px; border-bottom-left-radius: 30px;"><input type='submit'  name = 'submit' value = 'Register' class="btn"/>
         <p class="login__signup">View Setups &nbsp;<a href="setuplist.php">Setups</a></p>
     </td>
  
   </table>
    
    
    
    
</form>

</div>
<?php
include 'footer.php';
?>
</body>
</html>
<!-- PHP function validating the user information from the ones in the database. -->

<?php
if(isset($_POST['submit'])){
  $type = $_POST ['type'];
  $name = $_POST ['txtname'];
  $location = $_POST ['txtloc'];
  $popu = $_POST ['popu'];
include 'connection.php'; 
if( $conn === false ) {
    echo "<script> alert ('Connection Error!.')</script>";
        }
//Select Query
$tsql= " insert into Setups (Type,Location,Population,Name) values('$type','$location','$popu','$name') ";
//Executes the query
$getResults= sqlsrv_query( $conn, $tsql );
//Error handling
 
if ( $getResults){
  echo "<script> alert ('Registration Successfull!')</script>";
  echo "<script> window.open('setuplist.php','_self')</script>";
}
}
?> 
 