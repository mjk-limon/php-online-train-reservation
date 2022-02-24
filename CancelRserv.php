<?php
	include 'connection.php';
	$pnr = isset($_GET['pnr']) ? $conn->real_escape_string($_GET['pnr']) : null;
	
	$sql       = "SELECT * FROM `books` WHERE `pnr` = '$pnr'";
	$row       = $conn->query($sql)->fetch_assoc();
	$qty       = $row['sit'];
	$sccnumber = $row['scNumber'];


	$sql = "SELECT * FROM `schedule` WHERE `scNumber` = '$sccnumber' LIMIT 1";
	$row = $conn->query($sql)->fetch_assoc();

	$totalsit = $row['seat'];
	$totalsit = $totalsit + $qty;

	$sql    = "UPDATE `schedule` SET `seat` = '$totalsit' WHERE `scNumber` = '$sccnumber'";
	$result = mysqli_query($conn, $sql);
	
	$sql    = "DELETE FROM `books` WHERE `pnr` = '$pnr';";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$location = "Location: confirmationUser.php?msg=Ticket Reservation Canceled For PNR =" . $pnr;
		header($location);
	} else echo mysql_error();
?> 