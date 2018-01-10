
<!-- Copyright 2017 Kenedy Cheruiyot All rights reserved. -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
 session_start();
 include 'connection.php'; 

    $expire_time = 5*60; //expire time

    $_SESSION['activity'] = time(); // you have to add this line when logged in also;
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
   
<div class="menu" style="margin-right: 500px; margin-top: 20px;">
      
    <ul>
       <li><a href="logout.php">Logout</a></li>
       </li><li><a href="search.php">Search</a></li>
  
      </ul> 
    
</div>

</header>


<div class="container" style="background-color: #d2f3f3;">

<form id ="form" name="Registration" method="post" action="registration2.php">
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
     <td>Input Password:</td>
     <td><input type='password'  name = 'txtpass' placeholder="Enter Password!" required="password" /></td>
   </tr>
   <tr>
     <td>Confirm Password:</td>
     <td><input type='password'  name = 'txtpass1' placeholder="Confirm Password!"  /></td>
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
include 'connection.php'; 

if(isset($_POST['submit'])){
  if ($_POST['txtpass'] == $_POST['txtpass1']){
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
$tsql= " insert into [Logins] (uname,sname,user_mail,password,Id_no,home,status) values('$name','$sname','$email',HASHBYTES('SHA1','$pass'),'$id','$home','Active')";
//Executes the query
$getResults= sqlsrv_query( $conn, $tsql );
//Error handling
 }
 else{
  echo "<script> alert('Passwords must match')</script>";
 }
if ( $getResults){
  
  $_SESSION['ID'] = $_POST['txtid'];

  echo "<script> alert ('Registration Successfull!')</script>";
  echo "<script> window.open('view.php','_self')</script>";
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
    $mail->AltBody = 'You have been added to the Lands MIS';
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
 