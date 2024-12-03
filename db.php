<?php

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'http://localhost/my-project/php-online-train-reservation');
}

$servername = "localhost";
$username = "root";
$password = "admin";
$db = "sas";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

return $con;