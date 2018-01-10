<?php 
//The PHP class will create a GIF barcode image or save a GIF barcode image file, here is an example:
//include Barcode39 class 
include "Barcode39.php";
include 'connection.php';
//set Barcode39 object 
$time = date('dS-M-Y H:i:s',time() + 3*60*60 );
        
 ?>
 <?php
        
if( $conn === false ) {
   echo "<script> alert ('Connection Error!.')</script>";
}
//Select Query


$bc = new Barcode39($time);

//display new barcode 
$bc->draw("barcode.gif");
?>
<img src="barcode.gif" style="margin-bottom: 0px; float: right;">

<?php
//This example will output this barcode:
//You can also easily adjust the barcode bar sizes and text size:
//set object 
$bc = new Barcode39("123-ABC");
//set text size 
$bc->barcode_text_size = 5;
//set barcode bar thickness (thick bars) 
$bc->barcode_bar_thick = 4;
 //set barcode bar thickness (thin bars)
 $bc->barcode_bar_thin = 2;
//save barcode GIF file 

?>