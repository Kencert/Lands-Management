<?php
include 'connection.php'; 
if(isset($_GET['id'])){
	$id=$_GET['id'];
  	$delete=sqlsrv_query($conn, "DELETE FROM Setups WHERE id = '$id' ");
  if($delete) {
   	echo "<script> alert ('Records were deleted successfully.')</script>";
  	echo "<script> window.open('setuplist.php','_self')</script>";
  				}
  else {
  	echo "ERROR: Could not able to execute $delete. " ;
		}
  					}
 
?>

