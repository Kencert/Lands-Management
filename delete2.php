<?php
include 'connection.php'; 
if(isset($_GET['id'])){
	$id=$_GET['id'];
  	$delete=sqlsrv_query($conn, "DELETE FROM Logins WHERE Id_no = '$id' ");
if($delete){
  echo "<script> alert ('Records were deleted successfully.')</script>";
  echo "<script> window.open('userlist.php','_self')</script>";
  	}
  else {
  		echo "ERROR: Could not able to execute $delete. " ;
		}
  					}
 
?>


