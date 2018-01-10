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
$Creator = $_POST ['creator'];
$Address = $_POST['txtaddress'];
$Allot = $_POST['allottype'];
$time = date('dS-M-Y H:i:s', time() + 3*60*60 );


if( $conn === false ) {
    echo "<script> alert ('Connection Error!.')</script>";
}
//Select Query
$tsql= " insert  into Allotment(Fname,Lname,Fullname,Address,IdNum,Email,Mobile,Nationality,Propertyid,Title,Size,Location,Dimensions,Allottype,Block,Creator,Date,status) values 
('$Fname','$Lname','$Fullname','$Address','$ID','$Email','$Mobile','$Nation','$Propid','$Proptitle','$Propsize','$Proploc','$Dimen','$Allot','$Block','$Creator','$time','Pending')";
//Executes the query
$getResults= sqlsrv_query( $conn, $tsql);
//Error handling
 
if ( $getResults){
  	echo "<script> alert ('Request Successful wait for approval!')</script>";
  	echo "<script> window.open('view.php','_self')</script>";
}
else {
  echo "ERROR: Could not able to execute $tsql. " ;
}

?> 
 