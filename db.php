<?php

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'https://localhost/Completed/Student-Project/ticket-booking/');
}

$servername = "localhost";
$username = "root";
$password = "adminlimon";
$db = "sas";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

return $con;