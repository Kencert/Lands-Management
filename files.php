<!-- Copyright 2017 Kenedy Cheruiyot, i17/pu/0165/13. All rights reserved. -->
<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['ID'])){
  echo "<script>alert('Please login first!')</script>";
  echo"<script>window.open('index.php','_self')</script>";
}
$expire_time = 5*60; //expire time
if( $_SESSION['activity'] < time()-$expire_time ) {
  echo "<script> alert('Session expired')</script>";
  echo "<script>window.open ('index.php','_self')</script>";
    
  die();
    }
else {
  $_SESSION['activity'] = time(); // you have to add this line when logged in also;
    
  }

$level =sqlsrv_query( $conn, "SELECT access FROM Logins where Id_no = '" . ($_SESSION['ID']). "'  ");
$row = sqlsrv_fetch_array($level);


if ($row['access'] == "Admin"){
  echo "<script> window.location.href('files.php')</script>";
}
else {
  echo "<script>alert ('You Do Not Have Access.')</script>";
  echo "<script> window.open('index.php','_self')</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Home </title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<script async="" src="jquery.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url('download.jpg'); min-height: 100vh; background-position: center center; background-size: cover; position: relative;">

<header class = "main-header">
<?php
include 'menu.php'; 
?> 
</header>

<div class="container" style="background-color: #d2f3f3; width:100%;">
	<table width="100%"  margin="1">
        <tr>
    			<th colspan="12"><b>User Uploads.</b></th>
    	</tr>
    	<tr>
        <td><b><i>Num</i></b></td>
        <td><b><i>Details</i></b></td>
        <td><b><i>User Full Name</i></b></td>
    		<td><b><i>Id Number</i></b></td>
    		<td><b><i>Mobile Number</i></b></td>
				<td><b><i>Property Title</i></b></td>
        <td><b><i>File Name</i></b></td>
				<td><b><i>File Type</i></b></td>
				<td><b><i>View</i></b></td>
	
    	</tr>
    			<!-- PHP function that gets values from database and display on the table cell. -->
    			<?php
				include 'connection.php'; 
				$sql="SELECT * FROM tbl_uploads ";
				$result_set=sqlsrv_query($conn,$sql);
        $i=0;
				while($row=sqlsrv_fetch_array($result_set)){
          $i++;
						?>
         	<tr>
          <td><?php echo $i ?></td>
					<td><b><?php echo $row['Details'] ?></b></td>
          <td><b><?php echo $row['Fullname'] ?></b></td>
 					<td><b><?php echo $row['identification'] ?></b></td>
 					<td><b><?php echo $row['Mobile'] ?></b></td>
 					<td><b><?php echo $row['Title'] ?></b></td>
 					<td><b><?php echo $row['fileup'] ?></b></td>
 					<td><b><?php echo $row['type'] ?></b></td>
 					<td style="text-align: center;" >
 					<a href="uploads/<?php echo $row['fileup'] ?>" target="_blank">view file</a></td>
   				</tr>
   			  <?php
					}
						?>
    </table>
    
    		
 	
 </div> 
<?php
include 'footer.php';
?>

 </body>
 
 </html>

 