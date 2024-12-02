<?php
$database = 'sas';
$user = 'root';
$pass = 'admin';
$hostname = 'localhost';

$conn = mysqli_connect($hostname, $user, $pass, $database);
if (!$conn) {
	echo "Database Connection Problem";
	die();
} 
  
?>
