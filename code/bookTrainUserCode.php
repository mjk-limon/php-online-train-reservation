<?php
	session_start();
	include '../connection.php';
	echo "<pre>"; print_r($_POST); echo "</pre>";
	$TrainNumber = $conn->real_escape_string($_POST["TrainNumber"]);
	$fromLoc   = $conn->real_escape_string($_POST["fromLoc"]);
	$toLoc     = $conn->real_escape_string($_POST["toLoc"]);
	$depDate   = $conn->real_escape_string(date("Y-m-d", strtotime($_POST["depart_date"])));
	$depTime   = $conn->real_escape_string(date("H:i:s", strtotime($_POST["depart_time"])));
	$retDate   = isset($_POST["return_date"]) ? date("Y-m-d", strtotime($_POST["return_date"])) : '';
	$retTime   = isset($_POST["return_time"]) ? date("H:i:s", strtotime($_POST["return_time"])) : '';
	$totalSeat; $scid;
	$seatNames  = $conn->real_escape_string($_POST["seatnames"]);
	$seatNamesD = $conn->real_escape_string($_POST["seatnames_down"]);
	$seatamnt   = $conn->real_escape_string($_POST["seatamnt"]);
	$seatamntA  = $conn->real_escape_string($_POST["seatamntA"]);
	$seatcost1  = $conn->real_escape_string($_POST["seatCost1"]);
	$seatamntA1 = $seatamntA;
	
	if (isset($_POST["scNo"])) {
		$scNo = $conn->real_escape_string($_POST['scNo']);
		$sql  = "SELECT * FROM `reset`.`schedule` WHERE id='{$scNo}' LIMIT 1";
		$row  = $conn->query($sql)->fetch_assoc();
		if ($row['seat'] > 0) {
			//$seatCost  = $row['seatCost'] * 2;
			$totalSeat = $row['seat'];
			$scid      = $row['id'];
		} else header("Location: ../user.php?msg=No Seat Available");
	} else {
		$location = "Location: ../user.php?msg=Error";
		header($location);
	}
	
	$totalAmnt = $fname = $conn->real_escape_string($_POST["first_name"]);
	$lname     = $conn->real_escape_string($_POST["last_name"]);
	$email     = $conn->real_escape_string($_POST["email"]);
	$number    = $conn->real_escape_string($_POST["number"]);
	$user      = $_SESSION['username'];
	$pnr       = $scid . $_POST["TrainNumber"] . $totalSeat . strrev($seatamnt + $seatamntA) . ($seatamnt + $seatamntA) . strrev($totalSeat);
	$amount = 0; $Asc = explode(",", $seatcost1);
	foreach(explode(",", $seatNames) as $sNames) {
		if($sNames <= 60) $amount += intval($Asc[0]);
		else if($sNames >= 61 && $sNames <= 120) $amount += intval($Asc[1]);
		else if($sNames >= 121 && $sNames <= 144) $amount += intval($Asc[2]);
		else if($sNames >= 145) $amount += intval($Asc[3]);
	}
	
	
	$sql = "INSERT INTO `books` ";
	$sql .= "(`scNumber`, `fname`, `lname`, `phone`, `email`, `dest`, `depart`, `depDate`, `depTime`, ";
	$sql .= "`retTime`, `retDate`, `amount`, `seatNames`, `seatNamesDown`, `pnr`, `accept`, `user`, `sit`) ";
	$sql .= "VALUES ('$TrainNumber', '$fname', '$lname', '$number', '$email', '$toLoc', '$fromLoc', '$depDate', '$depTime', ";
	$sql .= "'$retTime', '$retDate', '$amount', '$seatNames', '$seatNamesD', '$pnr', '0', '$user','$seatamntA1');";

	$qry = mysqli_query($conn, $sql);
	if ($qry != true) {
		echo mysqli_error($conn);
		die();
	}
	
	
	if ($totalSeat >= $seatamnt) {
		$remseat = $totalSeat - ($seatamnt + $seatamntA);
		$sql     = "UPDATE `schedule` SET `seat` = '$remseat' WHERE `schedule`.`id` = '$scid';";
		$result  = mysqli_query($conn, $sql);
		if ($result) {
			$sms = 'Your ticket for Train number ' . $TrainNumber . ' for Date ' . $depDate . ' and PNR '. $pnr .'  is wating for confirmation';
			$sql = "INSERT INTO `notification`(`user`, `sms`, `adminPriority`, `userPriority`) VALUES ('$user','$sms','1','0')";
			echo $sms;
			$result = mysqli_query($conn, $sql);
			if ($result) {
				$location = "Location: ../bookTrainUser.php?confirm=Ticket Is Waiting For Confirmation&pnr=" . $pnr;
				header($location);
			} else {
				$location = "Location: ../user.php?msg=Please Try Again Later";
				header($location);
			}
		} else {
			$location = "Location: ../user.php?msg=Please Try Again Later";
			header($location);
		}
	}
?>