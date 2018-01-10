<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['ID'])){
  echo "<script>alert('Please login first!')</script>";
  echo"<script>window.open('userlist.php','_self')</script>";
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
 
if(isset($_GET['id']))
{
$id=$_GET['id'];
$_SESSION['mm'] = $id;
  $select=sqlsrv_query( $conn, "SELECT * FROM Allotment Where Propertyid = '$id'  ");
  while($userrow=sqlsrv_fetch_array($select))  {
      $Fname = $userrow ['Fname'];
      $Lname = $userrow ['Lname'];
      $Fullname = $userrow ['Fullname'];
      $Address = $userrow['Address'];
      $ID = $userrow ['IdNum'];
      $Email = $userrow ['Email'];
      $Mobile = $userrow ['Mobile'];
      $Nation = $userrow ['Nationality'];
      $Propid = $userrow ['Propertyid'];
      $Proptitle = $userrow ['Title'];
      $Propsize = $userrow ['Size'];
      $Proploc = $userrow ['Location'];
      $Dimen = $userrow ['Dimensions'];
      $Block = $userrow ['Block'];
      $Allottype =$userrow['Allottype'];
      $Creator = $userrow ['Creator'];
      }
?>
<?php } ?>
<?php

if(isset($_POST['submit'])){
  $Fname = $_POST ['txtfname'];
  $Lname = $_POST ['txtlname'];
  $Address= $_POST['txtadd'];
  $Fullname = $_POST ['txtfullname'];
  $ID = $_POST ['txtid'];
  $Email = $_POST ['txtemail'];
  $Mobile = $_POST ['txtmobile'];
  $Nation = $_POST ['txtnation'];
  $Propid = $_POST ['txtpropid'];
  $Proptitle = $_POST ['txttitle'];
  $Propsize = $_POST ['txtsize'];
  $Proploc = $_POST ['txtlocation'];
  $Dimen = $_POST ['txtdimen'];
  $Block = $_POST ['txtblock'];
  $Kinname = $_POST ['txtkinname'];
  $Kinrel = $_POST ['kinrel'];
  $Kinnum = $_POST ['txtkinnum'];
  $Kinbox = $_POST ['txtkinbox'];
  $Kincode = $_POST ['txtkincode'];
  $Kintown = $_POST ['txtkintown'];
  $KinID = $_POST ['txtkinnation'];
  $Kinemail = $_POST ['txtkinemail'];
  $Creator = $_POST ['creator'];
  $time = date('dS-M-Y H:i:s',time() + 3*60*60 );

        
 ?>
 <?php
        
if( $conn === false ) {
   echo "<script> alert ('Connection Error!.')</script>";
}
//Select Query

$tsql= "INSERT into Property(Fname,Lname,Fullname,Address,IdNum,Email,Mobile,Nationality,Propertyid,Title,Size,Location,Dimensions,Block,Creator,Date) values 
('$Fname','$Lname','$Fullname','$Address','$ID','$Email','$Mobile','$Nation','$Propid','$Proptitle','$Propsize','$Proploc','$Dimen','$Block','$Creator','$time') ";
$sql = "UPDATE Allotment SET status = 'Approved' Where Propertyid = '".($_SESSION['mm'])."' ";
//Executes the query
$Results = sqlsrv_query($conn,$sql);
$getResults= sqlsrv_query( $conn, $tsql );
//Error handling
if ($getResults){
  echo "<script> alert ('Records were updated successfully.')</script>";
  echo "<script> window.open('allotmentlist.php','_self')</script>";
  require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail -> SMTPDebug = 2;
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'landmanagement001';                 // SMTP username
    $mail->Password = 'kencert123';                           // SMTP password
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->From = ('landmanagement001@gmail.com');
    $mail->FromName = 'Lands Admin';
    $mail->addAddress($Email);               // Name is optional

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $Fname.' '.$Lname.''. ' Allotment Request';
    $htmlcontentdata = 

    $mail->msgHTML($htmlcontentdata);
    $mail->Body    = '<div style="width:100%;">
                  <div style="background-color:#eeeeee; width:80%; margin:0 auto; position:relative;">
                    <div style="padding:20px 20px 50px 20px;">
                          <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; line-height:30px; margin:0 0 20px 0;">
                             <div>
                    <div>Dear '.$Fname.',</div><br/>
                    <div>Your Allotment request has been approved for: '.$Proptitle.' Property.
                  </div>
                          </div>
                      
                          <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; line-height:30px;">
                              Regards,<br />
                              <b>Intergral Group Solutions</b>
                          </div>
                      </div>    
                  </div>
              </div>';
    $mail->AltBody = 'Your Allotment Request for '.$Proptitle.'has been Approved';
    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
      if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
              echo 'Message has been sent to the recipient';
                }
              }
          else {
              echo "ERROR: Could not able to execute $tsql. " ;
            }
          if ( $getResults == FALSE ){
              echo "<script> alert ('Could not execute Query!.')</script>";
                            }
                }
          ?> 

<!-- Copyright 2017 Kenedy Cheruiyot All rights reserved. -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- HTML Standard in openning html tag meta tag and doctype. -->
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Edit User Details</title>
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

<div class="container" style="background-color: lightblue;">

<form id ="form" name="Registration" method="post" action="allotedit.php">
   <table width="100%" border="1" align="center" style="border-radius: 30px;">
   <tr>
     <td align ='center' colspan = '6' style="border-top-right-radius:30px; border-top-left-radius: 30px;">
     <h1><b>Property Registered Details</b></h1>
     </td>
   </tr>
   <tr>
     <td>First Name:</td>
     <td><input type='text'  name = 'txtfname' required="text" value="<?php echo $Fname; ?>" /></td>
   </tr>
   <tr>
     <td>Last Name:</td>
     <td><input type='text'  name = 'txtlname' required="text" value="<?php echo $Lname; ?>" /></td>
   </tr>
   <tr>
     <td>Full Name:</td>
     <td><input type='text'  name = 'txtfullname' required="text" value="<?php echo $Fullname ?>" /></td>
   </tr>
   <tr>
     <td>Email Address:</td>
     <td><input type='email'  name = 'txtemail' required="email" value="<?php echo $Email ?>" /></td>
   </tr>
   <tr>
     <td>ID Number:</td>
     <td><input type='number'  name = 'txtid' required="number" value="<?php echo $ID ?>" /></td>
   </tr>
    <tr>
     <td>Address:</td>
     <td><input type='number'  name = 'txtadd' required="number" value="<?php echo $Address ?>" /></td>
   </tr>
    <tr>
     <td>Mobile Number:</td>
     <td><input type='number'  name = 'txtmobile' required="number" value="<?php echo $Mobile ?>" /></td>
   </tr> 
    <tr>
     <td>Nationality:</td>
     <td><input type='text'  name = 'txtnation' required="number" value="<?php echo $Nation ?>" /></td>
   </tr> 
    <tr>
     <td>Property ID:</td>
     <td><input type='number'  name = 'txtpropid' required="number" value="<?php echo $Propid ?>" /></td>
   </tr>
   <tr>
     <td>Property Title:</td>
     <td><input type='text'  name = 'txttitle'  value="<?php echo $Proptitle ?>" /></td>
   </tr>  
   <tr>
     <td>Property Size:</td>
     <td><input type='text'  name = 'txtsize'  value="<?php echo $Propsize; ?>" /></td>
   </tr>

   <tr>
     <td>Property Location:</td>
     <td><input type='text'  name = 'txtlocation'  value="<?php echo $Proploc; ?>" /></td>
   </tr>
   
   <tr>
     <td>Property Dimensions:</td>
     <td><input type='text'  name = 'txtdimen'  value="<?php echo $Dimen; ?>" /></td>
   </tr>
   
   <tr>
     <td>Block No:</td>
     <td><input type='text'  name = 'txtblock'  value="<?php echo $Block; ?>" /></td>
   </tr>
   <tr>
     <td>Kin Name:</td>
     <td><input type='text'  name = 'txtkinname'   /></td>
   </tr>
   <tr>
     <td>Kin Relation:</td>
     <td><input type='text'  name = 'kinrel'  /></td>
   </tr>
   <tr>
     <td>Kin Telephone:</td>
     <td><input type='number'  name = 'txtkinnum' /></td>
   </tr>
   <tr>
     <td>Kin Po Box:</td>
     <td><input type='number'  name = 'txtkinbox' /></td>
   </tr>
   <tr>
     <td>Kin Po Code:</td>
     <td><input type='number'  name = 'txtkincode'   /></td>
   </tr>
   <tr>
     <td>Kin Town:</td>
     <td><input type='text'  name = 'txtkintown'   /></td>
   </tr>
   <tr>
     <td>Kin ID:</td>
     <td><input type='number'  name = 'txtkinnation' /></td>
   </tr>
   <tr>
     <td>Kin Email:</td>
     <td><input type='email'  name = 'txtkinemail'  /></td>
   </tr>
   <tr>
     <td>Creator:</td>
     <td><select name = "creator" class="form-control">
                          <!-- PHP function to come up with a dropdown list of available candidates as an option. -->
                          <?php echo "<option >" .($_SESSION['ID']) . "</option>";  ?>
 
                          
                        </select>
    </td>
   </tr>
   
   
     <td align='center' colspan='6' style="border-bottom-right-radius:30px; border-bottom-left-radius: 30px;">
     <input type='submit'  name = 'submit' value = 'Approve Details' class="btn"  align='center' colspan='6'>
     <?php 
             $select=sqlsrv_query( $conn, "SELECT * FROM Allotment Where Propertyid = '" . ($_SESSION['mm']). "'  ");
              $userrow=sqlsrv_fetch_array($select);
               
               echo "<a href='print.php?id=".$userrow ['IdNum']."' >Print</a>";
              
           ?>
   </table>
    
</form>

</div>
<?php
include 'footer.php';
?>

</body>
</html>



