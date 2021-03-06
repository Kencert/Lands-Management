<!-- Copyright 2017 Kenedy Cheruiyot, i17/pu/0165/13. All rights reserved. -->
<!-- PHP function that initializes connection. -->
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


//Establishes the connection
  $level =sqlsrv_query( $conn, "SELECT access FROM Logins where Id_no = '" . ($_SESSION['ID']). "'  ");
  $row = sqlsrv_fetch_array($level);


  if ($row['access'] == "Admin" or $row['access']== "Read" or $row['access']== "Modify"){
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
<title>Allotment Requests</title>
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
          <th colspan="8" style="border-top-right-radius: 30px; border-top-left-radius: 30px;"><b><b>Welcome: <?php echo $_SESSION['ID']; ?>!<br></b>Allotment Request:</b></th>
        </tr>
        <tr>
          <td><b><i>Row Num</i></b></td>
          <td><b><i>Property ID</i></b></td>
          <td><b><i>First Name</i></b></td>
          <td><b><i>Second Name</i></b></td>
          <td><b><i>Mobile Number</i></b></td>
          <td><b><i>Email</i></b></td>
          <td><b><i>Property Title</i></b></td>
          <td><b><i>Property Location</i></b></td>
          <td><b><i>Allotment Type</i></b></td>
          <td><b><i>Date Added</i></b></td>
          <td><b><i>Allotment Status</i></b></td>
          <?php 
            if ($row['access'] == "Admin"){ ?>
              <td><b><i>Creator</i></b></td>
              <?php }?>
        </tr>

          <!-- PHP function that gets values from database and display on the table cell. -->
        <?php
          $conn = sqlsrv_connect( $serverName, $connectionOptions );
             if(isset($_POST['submit'])){
                $search_file = $_POST['search_file'];
                $select=sqlsrv_query( $conn, "SELECT * FROM Allotment where  status = 'Pending' and Fname like '%".$search_file."%' or Lname like '%".$search_file."%'  or Email like '%".$search_file."%'  or Title like '%".$search_file."%' ");
                }   
              else{
                 $select=sqlsrv_query( $conn, "SELECT * FROM Allotment where  Status= 'Pending' or status= 'Rejected'");
                  }
                $i=0;
                while($userrow=sqlsrv_fetch_array($select))  { 
                  $i++;
                  ?>
          <tr style="border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">

            <td style="border-bottom-left-radius: 30px;"><?php echo $i ?></td>
            <td><?php echo  $userrow['Propertyid']; ?></td>
            <td><b><?php echo $userrow['Fname']  ?></b></td>
            <td><b><?php echo $userrow['Lname'] ?></b></td>
            <td><b><?php echo $userrow['Mobile'] ?></b></td>
            <td><b><?php echo $userrow ['Email'] ?></b></td>
            <td><b><?php echo $userrow ['Title'] ?></b></td>
            <td><b><?php echo $userrow ['Location'] ?></b></td>
            <td><b><?php echo $userrow['Allottype'] ?></b></td>
            <td><b><?php echo $userrow['Date'] ?></b></td>
            <td><b><?php echo $userrow['status'] ?></b></td>
                        
            <?php 
            if ($row['access'] == "Admin"){ ?>
              <td><b><?php echo $userrow['Creator'] ?></b></td>
              <?php echo "<td><a href='allotedit.php?id=".$userrow['Propertyid']."' >Approve</a></td>";
              
              ?>
              <?php echo "<td><a href='allotedit1.php?id=".$userrow['Propertyid']."' >Reject</a></td>";
              }
              ?>
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