<?php
include 'connection.php'; 

$Fname = $_POST ['txtfname'];
$Lname = $_POST ['txtlname'];
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
$Address = $_POST['txtaddress'];
$Creator = $_POST ['creator'];
$time = date('dS-M-Y H:m:s', time() + 3*60*60 );

if( $conn === false ) {
  	echo "<script> alert ('Connection Error!.')</script>";
	}
//Select Query
	$tsql= " insert  into Property(Fname,Lname,Fullname,Address,IdNum,Email,Mobile,Nationality,Propertyid,Title,Size,Location,Dimensions,Block,Kinname,Kinrel,Kinnum,Kinbox,Kincode,Kintown,Kinid,Kinemail,Creator,Date) values 
('$Fname','$Lname','$Fullname','$Address','$ID','$Email','$Mobile','$Nation','$Propid','$Proptitle','$Propsize','$Proploc','$Dimen','$Block','$Kinname','$Kinrel','$Kinnum','$Kinbox','$Kincode','$Kintown','$KinID','$Kinemail','$Creator','$time')";
//Executes the query
	$getResults= sqlsrv_query( $conn, $tsql);
//Error handling
 
if ( $getResults){
  	echo "<script> alert ('Registration Successfull you can now proceed to Upload Files!')</script>";
  	echo "<script> window.open('fileupload.php?id=".$_POST['txtid']."','_self')</script>";
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

      $mail->Subject = $Fname.' '.$Lname.''. ' Property Registration';
      $mail->Body    = '<div style="width:100%;">
                  <div style="background-color:#eeeeee; width:80%; margin:0 auto; position:relative;">
                    <div style="padding:20px 20px 50px 20px;">
                          <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; line-height:30px; margin:0 0 20px 0;">
                             <div>
                    <div>Dear '.$Fname.',</div><br/>
                    <div>Your Property Details has been added Successfully for: '.$Proptitle.' Property.
                  </div>
                          </div>
                      
                          <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal; line-height:30px;">
                              Regards,<br />
                              <b>Intergral Group Solutions</b>
                          </div>
                      </div>    
                  </div>
              </div>';
      $mail->AltBody = 'Your Property Details for'.''.$Proptitle.''.'has been added Successfully';
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


        else {
	           echo "ERROR: Could not able to execute $tsql. " ;
          }

?> 
 