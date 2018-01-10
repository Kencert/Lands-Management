<?php
    session_start();
    include 'connection.php'; 
   	echo "<script> alert ('Logged Out!.')</script>";
	$results = sqlsrv_query($conn,$sql);
    session_destroy();

    header('Location: http://localhost:8080/Lands MIS/index.php');
?>
