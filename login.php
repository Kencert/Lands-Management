<!-- Copyright 2017 Kenedy Cheruiyot All rights reserved. -->
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- HTML Standard in openning html tag meta tag and doctype. -->
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title> Land Management System </title>
   <!-- CSS file with styles appearance in document.
   Meta describes the contents in various types of views -->
   <link rel="stylesheet" type="text/css" href="style.css" media="screen"  />
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
	

<body style="background-image: url('download.jpg'); min-height: 100vh; background-position: center center; background-size: cover; position: relative;">


<div class="container" style="background-color: #d2f3f3; margin-top: 120px;">

<img src="log.jpg" style="width:120px;  height:120px;  margin-top: -10px;  margin-bottom: 10px;  border-radius: 50%;  border-top-left-radius: 50%;border-top-right-radius: 50%;  border-bottom-right-radius: 50%;  border-bottom-left-radius: 50%;">
<form id ="form" name="login" method="post" action="login.php">
   <table width="100%" border="1" align="center" style="border-radius: 30px;">
   <tr >
     <td align ='center' colspan = '6' style="border:none; " >
     <h1><b>Log In</b></h1></td>
   </tr>
   <tr>
     <td>ID Number:</td>
     <td><input type='number'  name = 'txtid' placeholder="Enter Idnumber!" required="number" /></td>
   </tr>
   <tr>
     <td>Input Password:</td>
     <td><input type='password'  name = 'txtpass' placeholder="Enter Password!" required="password" /></td>
   </tr>
     <td align='center' colspan='6' style="border-bottom-right-radius:30px; border-bottom-left-radius: 30px;"><input type='submit'  name = 'submit' value = 'Log In' class="btn" />
         <p class="login__signup">Don't have an account? &nbsp;<a href="registration2.php">Sign up</a></p>
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
  $name = $_POST ['txtid'];
  $pass = $_POST ['txtpass'];

				
if( $conn == false ) {
  echo "<script> alert ('Connection Error!.')</script>";
}
//Select Query
else{
  $tsql= "SELECT * from Logins where Id_no = '$name' AND password = HASHBYTES('SHA1','$pass')  " ;
  $time = date('dS-M-Y h:i:s', time() + 3*60*60 );
  $sql =  "UPDATE [Logins] set timel ='$time' where Id_no = '$name' AND password = HASHBYTES('SHA1','$pass')  ";
  $select=sqlsrv_query( $conn, "SELECT * FROM Logins where Id_no = '$name' AND password = HASHBYTES('SHA1','$pass') ");
while($userrow=sqlsrv_fetch_array($select))  {
  $Fname = $userrow ['uname'];
  $Lname = $userrow ['sname'];
  $ID = $userrow ['Id_no'];
  $Email = $userrow ['user_mail'];
  $Home = $userrow ['home'];
  $Access = $userrow ['access'];
  $time = date('dS-M-Y h:i:s', time() + 3*60*60 );
  $status = $userrow['status'];
    }
  $ttsql="INSERT INTO [Logs] (uname,sname, Id_no,home,access, timel) values('$Fname','$Lname','$name','$Home','$Access','$time')";
  $getResults1 = sqlsrv_query( $conn, $ttsql );

  $results = sqlsrv_query($conn,$sql);
  $getResults= sqlsrv_query( $conn, $tsql );
//Error handling
  if ($status == "Active"){
    if (sqlsrv_fetch($getResults)){
      session_start();
      $_SESSION['activity'] = time();
      $level =sqlsrv_query( $conn, "SELECT access FROM Logins where Id_no = '" . ($_SESSION['ID']). "'  ");
      $row = sqlsrv_fetch_array($level);
      $_SESSION['ID'] = $_POST['txtid'];
      echo "<script>alert ('Welcome!')</script>";
      echo "<script> window.open('view.php','_self')</script>";
       }
      }
    elseif ($status == "Blocked") {
      echo "<script>alert ('User Blocked !')</script>";
      } 
      else {
        echo "<script>alert ('No User by these credentials !')</script>";
          }
      }
    }
?> 
 