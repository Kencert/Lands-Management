<?php
$serverName = "KENEDY\NAVDEMO";
$connectionOptions = array("Database" => "Land", "Uid" => "sa", "PWD" => "Star321?");
//Establishes the connection
$conn = sqlsrv_connect( $serverName, $connectionOptions );
?>