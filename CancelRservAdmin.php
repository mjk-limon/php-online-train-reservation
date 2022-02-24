<?php 
	include 'connection.php';
	$pnr = isset($_GET['pnr']) ? $conn->real_escape_string($_GET['pnr']) : null;
	$books_info = $conn->query("SELECT `amount`, `user`, `scNumber`, `dob` FROM `books` WHERE `pnr` = '$pnr' ")->fetch_assoc();
	
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

	$sql= "DELETE FROM `books` WHERE `pnr` = '$pnr';";
	
	$result=  mysqli_query($conn, $sql);
	if($result){
		$sms = 'Your ticket for Train number ' . $books_info['scNumber'] . ' For Date ' . date("Y-m-d", strtotime($books_info['dob'])) . ' and PNR '. $pnr .' is cancelled !';
		$sql = "INSERT INTO `notification`(`user`, `sms`, `adminPriority`, `userPriority`) VALUES ('{$books_info['user']}','$sms','1','0')";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			$location = "Location: confirmationAdmin.php?msg=Ticket Reservation Canceled For PNR =".$pnr;
			header($location);
		} else {
			$location = "Location: confirmationAdmin.php?msg=Please Try Again Later";
			header($location);
		}
	} else echo mysqli_error($conn, $sql);
?>