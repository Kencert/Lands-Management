<!-- Copyright 2017 Kenedy Cheruiyot, i17/pu/0165/13. All rights reserved. -->
<?php
 session_start();
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
 include 'connection.php'; 

 $level =sqlsrv_query( $conn, "SELECT access FROM Logins where Id_no = '" . ($_SESSION['ID']). "'  ");
 $row = sqlsrv_fetch_array($level);

if ($row['access'] == "Admin" ){
  echo "<script> window.location.href('userlist.php')</script>";
    }
 else {
    echo "<script>alert ('You Do Not Have Access.')</script>";
    echo "<script> window.open('index.php','_self')</script>";
      }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Users Registered</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url('download.jpg'); min-height: 100vh; background-position: center center; background-size: cover; position: relative;">
<!-- Static top menu header with menu links and navigational menus. -->
<header class = "main-header">
<?php
include 'menu.php'; 
?> 
</header>
 <form method="post" action="" name="form" id="form">   

 <input type="text" autofocus="autofocus" name="search_file" required="text" placeholder ="Search" id="search_file" style="width:500px; font-size:20px; margin-top: 110px; margin-bottom: 10px;"  /> 

        <input type="submit"  class="btn btn-primary" name="submit" value="Search">
</form>
 
<div class="container" style="background-color: #d2f3f3; margin-top: 20px; width: auto; height: auto;" >

  <table width="100%"  >
        <tr>
          <th colspan="8" style="border-top-right-radius: 30px; border-top-left-radius: 30px;"><b><b>Welcome: <?php echo $_SESSION['ID']; ?>!<br></b>Log History:</b></th>
        </tr>
        <tr>
          <td><b><i>Row Num</i></b></td>
          <td><b><i>ID Number</i></b></td>
          <td><b><i>User's First Name</i></b></td>
          <td><b><i>User's Second Name</i></b></td>
          <td><b><i>Home</i></b></td>
          <td><b><i>Access Level</i></b></td>
          <td><b><i>Log in time</i></b></td>
        </tr>
          <!-- PHP function that gets values from database and display on the table cell. -->
        <?php
          $conn = sqlsrv_connect( $serverName, $connectionOptions );
          if(isset($_POST['submit'])){
            $search_file = $_POST['search_file'];
            $select=sqlsrv_query( $conn, "SELECT * FROM Logs where Id_no like '%".$search_file."%' or uname like '%".$search_file."%'  or sname like '%".$search_file."%'  or timel like '%".$search_file."%' ");
          
            }   
          else{
            $select=sqlsrv_query( $conn, "SELECT * FROM Logs ");
              }
            $i=0;
          
          while($userrow=sqlsrv_fetch_array($select))  { 
            $i++;
            ?>
            <tr style="border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
              <td style="border-bottom-left-radius: 30px;"><?php echo $i ?></td>
              <td><?php echo  $userrow['Id_no']; ?></td>
              <td><b><?php echo $userrow['uname']  ?></b></td>
              <td><b><?php echo $userrow['sname'] ?></b></td>
              <td><b><?php echo $userrow['home'] ?></b></td>
              <td><b><?php echo $userrow ['access'] ?></b></td>
              <td><b><?php echo $userrow ['timel'] ?></b></td>
              <?php
              }
              ?>
            </tr>
  </table>
    
</div>
<?php
include 'footer.php';
?>
</body>
</html>