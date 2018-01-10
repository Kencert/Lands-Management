
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
// if (!isset($_SESSION['username'])){
 // echo "<script>alert('Please login first!')</script>";
  //echo"<script>window.open('index.php','_self')</script>";
// }
$level =sqlsrv_query( $conn, "SELECT access FROM Logins where Id_no = '" . ($_SESSION['ID']). "'  ");
$row = sqlsrv_fetch_array($level);


if ($row['access'] == "Admin"){
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
   <title> Registration</title>
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

<form id ="form" name="Registration" method="post" action="registration.php">
   <table width="100%" border="1" align="center" style="border-radius: 30px;">
   <tr>
     <td align ='center' colspan = '6' style="border-top-right-radius:30px; border-top-left-radius: 30px;" >
     <h1><b>Registration</b></h1></td>
   </tr>
   <tr>
     <td>First Name:</td>
     <td><input type='text'  name = 'txtuname' placeholder="Enter First Name!"  required="text" /></td>
   </tr>
   <tr>
     <td>Sur Name:</td>
     <td><input type='text'  name = 'txtsname' placeholder="Enter Sur Name!" required="text" /></td>
   </tr>
   <tr>
     <td>Email Address:</td>
     <td><input type='email'  name = 'txtemail' placeholder="Enter Email!" required="email" /></td>
   </tr>
   <tr>
     <td>ID Number:</td>
     <td><input type='number'  name = 'txtid' placeholder="Enter Idnumber!" required="number" /></td>
   </tr>
     <td>Hometown:</td>
     <td><input type='text'  name = 'txthome' placeholder="Enter Hometown!" required="text" /></td>
   </tr>
    <tr>
     <td>Status:</td>
     <td><select name = 'txtstat' required=""><option></option><option>Active</option><option>Blocked</option></select>
      
   </tr>
   <tr>
     <td>Access Level:</td>
     <td><select name = 'txtaccess' required=""><option></option><option>Admin</option><option>Read</option><option>Write</option><option>Modify</option></select>
      
   </tr>
   <tr>
     <td>Input Password:</td>
     <td><input type='password'  name = 'txtpass' placeholder="Enter Password!" required="password" /></td>
   </tr>
     <td align='center' colspan='6' style="border-bottom-right-radius:30px; border-bottom-left-radius: 30px;"><input type='submit'  name = 'submit' value = 'Register' class="btn"/>
         <p class="login__signup">Have an account? &nbsp;<a href="login.php">Login</a></p>
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
  $name = $_POST ['txtuname'];
  $sname = $_POST ['txtsname'];
  $home = $_POST ['txthome'];
  $pass = $_POST ['txtpass'];
  $email = $_POST ['txtemail'];
  $id = $_POST ['txtid'];
  $access = $_POST['txtaccess'];
  $stat = $_POST['txtstat'];

include 'connection.php'; 
  if( $conn === false ) {
    echo "<script> alert ('Connection Error!.')</script>";
    }
  //Select Query
  $tsql= " insert into [Logins] (uname,sname,user_mail,password,Id_no,home,access,status) values('$name','$sname','$email',HASHBYTES('SHA1','$pass'),'$id','$home','$access','$stat')";
  //Executes the query
  $getResults= sqlsrv_query( $conn, $tsql );
  //Error handling
 
  if ( $getResults){
    echo "<script> alert ('Registration Successfull!')</script>";
    echo "<script> window.open('userlist.php','_self')</script>";
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
        $mail->addAddress($email);               // Name is optional

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $name.''.$sname.''. ' Registered in Lands MIS';
        $mail->Body    = '<div style="width:100%;">
                  <div style="background-color:#eeeeee; width:80%; margin:0 auto; position:relative;">
                    <div style="padding:20px 20px 50px 20px;">
                          <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; line-height:30px; margin:0 0 20px 0;">
                             <div>
                    <div>Dear '.$name.',</div><br/>
                    <div>You Have been registered Successfully to Lands MIS Username: '.$id.' <br/> Password : '.$pass.'
                  </div>
                          </div>
                      
                          <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; line-height:30px;">
                              Regards,<br />
                              <b>Intergral Group Solutions</b>
                          </div>
                      </div>    
                  </div>
              </div>';
       $mail->AltBody = 'You Have been registered Successfully to Lands MIS Username: '.$id.' <br/> Password : '.$pass.'';
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
        if(!$mail->send()) {
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
              } else {
                echo 'Message has been sent to the recipient';
                    }
                }
            }
        ?> 
 