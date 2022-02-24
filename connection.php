<?php
$database = 'reset';
$user = 'root';
$pass = 'adminlimon';
$hostname = 'localhost';

$conn = mysqli_connect($hostname, $user, $pass, $database);
if (!$conn) {
	echo "Database Connection Problem";
	die();
} 
  
?>
