<!-- Copyright 2017 Kenedy Cheruiyot, i17/pu/0165/13. All rights reserved. -->
<?php
 // Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['ID'])){
 	echo "<script>alert('Please login first!')</script>";
 	echo"<script>window.open('index.php','_self')</script>";
 }
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $_SESSION['mm'] = $id;}
  $expire_time = 5*60; //expire time
if( $_SESSION['activity'] < time()-$expire_time ) {
  echo "<script> alert('Session expired')</script>";
  echo "<script>window.open ('logout.php','_self')</script>";
  die();
  }
else {
  $_SESSION['activity'] = time(); // you have to add this line when logged in also;
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Property Files Uploading</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!-- Static header which contains navigational menus and menu links. -->
<header class = "main-header">
   
<?php
include 'menu.php'; 
?> 
</header>

<body style="background-image: url('download.jpg'); min-height: 100vh; background-position: center center; background-size: cover; position: relative;">
<div class="container" style="background-color: #d2f3f3;">
    <!-- form action refering to upload.php that has functions for file uploading on pressing submit. -->
	<form action="upload.php" method="post" enctype="multipart/form-data">
	<!-- Allows a user to navigate though their documents to upload files. -->
	
	<tr>
        <td>Brief Details:</td>
        <td><input type='text' name = 'details' placeholder="Enter Brief Details!"/></td><br>
        <td>User National ID:</td>
        <td><input type='number' name = 'txtid' required="" value="<?php echo $id; ?>" placeholder="Enter User  National Id!"/></td>
    </tr><br>
    
    
	     <input type="file" name="file"  />
	     
	     <button type="submit" name="btn-upload" class="btn">upload</button>
	</form>
	<label><a href="files.php" class="btn">View files Uploaded.</a></label>
    <br /><br />
    <!-- PHP function that gives feedback on upload status. -->
    <?php
	if(isset($_GET['success']))
	{
		?>
        <label>File Uploaded Successfully! </label>
        <?php
	}
	else if(isset($_GET['fail']))
	{
		?>
        <label>Problem While File Uploading !</label>
        <?php
	}
	else
	{
		?>
        <label>Upload files supporting registration:(acceptable formats: PDF, DOC, EXE, VIDEO, MP3, MP4)</label>
        <?php
	}
	?>
	
</div>
<?php
include 'footer.php';
?>
</body>
</html>