<?php

include 'connection.php';
$pnr = isset($_GET['pnr']) ? $conn->real_escape_string($_GET['pnr']) : null;

$sql       = "SELECT * FROM `books` WHERE `pnr` = '$pnr'";
$row       = $conn->query($sql)->fetch_assoc();
$qty       = $row['sit'];
$user      = $row['user'];
$accept    = $row['accept'];
$amount    = $row['amount'];
$sccnumber = $row['scNumber'];

$sql = "SELECT * FROM `schedule` WHERE `scNumber` = '$sccnumber' LIMIT 1";
$row = $conn->query($sql)->fetch_assoc();

$totalsit = $row['seat'];
$totalsit = $totalsit + $qty;

$sql = "UPDATE `schedule` SET `seat` = '$totalsit' WHERE `scNumber` = '$sccnumber'";
$result = mysqli_query($conn, $sql);

$sql = "DELETE FROM `books` WHERE `pnr` = '$pnr';";
$result =  mysqli_query($conn, $sql);

if ($accept) {
	$sql = "UPDATE `balance` SET `balance` = `balance` + '$amount' WHERE `username` = '$user';";
	$result =  mysqli_query($conn, $sql);
}


$location = "Location: confirmationAdmin.php?msg=Ticket Reservation Canceled For PNR =" . $pnr;
header($location);
