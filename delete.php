
<?php
session_start();
include 'connection.php'; 

$delete=sqlsrv_query($conn, "DELETE FROM Logins WHERE Id_no = '" . ($_SESSION['ID']). "' ");

  if($delete){
	echo "<script> alert ('Records were deleted successfully.')</script>";
  	echo "<script> window.open('registration.php','_self')</script>";
  				}
  else {
  	echo "ERROR: Could not able to execute $sql. " ;
		} 
?>