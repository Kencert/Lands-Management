<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- HTML Standard in openning html tag meta tag and doctype. -->
<link rel="stylesheet" type="text/css" href="style1.css" media="all" />
   
</html>

  <?php
 
session_start();
include "barcode.php";
include 'connection.php'; 

$times = date('dS:m:y H:i:s ', time() + 3*60*60 );

if(isset($_GET['id'])){
  $id=$_GET['id'];
  $_SESSION['mm'] = $id;}
  $select=sqlsrv_query( $conn, "SELECT * FROM Property Where Propertyid = '$id' ");
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
    $Kinname = $userrow ['Kinname'];
    $Kinrel = $userrow ['Kinrel'];
    $Kinnum = $userrow ['Kinnum'];
    $Kinbox = $userrow ['Kinbox'];
    $Kincode = $userrow ['Kincode'];
    $Kintown = $userrow ['Kintown'];
    $KinID = $userrow ['Kinid'];
    $Kinemail = $userrow ['Kinemail'];
    $Creator = $userrow ['Creator'];
    $time = $userrow['Date'];
      }

    $txt1 = "Property Details" ;
    $txt2 = "Owner Details" ;

    ?>
<div id="printable">
<body style="background-image: url('watermark.png');  background-repeat: no-repeat; background-position: left;">
 <?php
  echo "<table border='0' border = 'solid' >";
  echo "<tr>";
  echo "<h2><u>" . $txt1 . "</u></h2>" ;
  echo "</tr>";
  echo "<td>";
  echo "First Name: $Fname <br>";
  echo "Last Name: $Lname <br>";
  echo "Full Name: $Fullname <br>";
  echo "Identity Num: $ID <br>";
  echo "Email Add: $Email <br>";
  echo "Mobile Num: $Mobile <br>";
  echo "Nationality: $Nation <br>";
  echo "Property ID: $Propid <br>";
  echo "Property Title: $Proptitle <br>";
  echo "Prop Size: $Propsize <br>";
  echo "Prop Location :$Proploc <br>"; 
  echo "Dimensions: $Dimen <br>";
  echo "Address: $Address <br>";
  echo "Block Num: $Block <br>";
  echo "Creator Id: $Creator <br>";
  echo "Time Created:$time ";

  echo "</td>";
  echo "</table>";
  $bc = new Barcode39($times);
  $timesa = ($times);
  //display new barcode 
  $bc->draw("barcode.gif");
  $tsql= "INSERT into barcode(Date,Name,[User],Propertyid) values ('$timesa','$Creator', '$Fname','$Propid' ) ";
  //$sql = "UPDATE Allotment SET status = 'Approved' Where Propertyid = '".($_SESSION['mm'])."' ";
  //Executes the query
  //$Results = sqlsrv_query($conn,$sql);
  $getResults= sqlsrv_query( $conn, $tsql );
  ?>
<img src="barcode.gif" style="float: center; margin-left: 100px;">
<img src="sign.png" style="float: left;">
</body>
</div>
<?php
  echo "<td><a onClick = \"javascript: window.printDiv('printable');\" >Click to Print</a></td>";
  echo "<br>";
  echo "<td><a href='index.php' >Home</a></td>";
      
  ?>

<script type="text/javascript">
	function printDiv(divName) {
	var printContents = document.getElementById(divName).innerHTML;
	var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window. print ();
  document.body.innerHTML = originalContents;
}
</script>



