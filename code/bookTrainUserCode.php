<?php 
session_start();
include '../connection.php';
include '../header/userheader.php';
?>
<?php
	$trainNumber = $conn->real_escape_string($_POST["TrainNumber"]);
	$fromLoc = $conn->real_escape_string($_POST["fromLoc"]);
	$toLoc = $conn->real_escape_string($_POST["toLoc"]);
	$depDate = $conn->real_escape_string(date("Y-m-d", strtotime($_POST["depart_date"])));
	$depTime = $conn->real_escape_string(date("H:i:s", strtotime($_POST["depart_time"])));
	$retDate = isset($_POST["return_date"]) ? date("Y-m-d", strtotime($_POST["return_date"])) : '';
	$retTime = isset($_POST["return_time"]) ? date("H:i:s", strtotime($_POST["return_time"])) : '';
	$totalSeat; $scid;
	$seatNames = $conn->real_escape_string($_POST["seatnames"]);
	$seatamnt = $conn->real_escape_string($_POST["seatamnt"]);
	$seatamntA = $conn->real_escape_string($_POST["seatamntA"]);
	$totalAmnt = $seatamnt + $seatamntA;
	if(isset($_POST["scNo"])){
		$scNo = $conn->real_escape_string($_POST['scNo']);
		$sql ="SELECT * FROM `sas`.`schedule` WHERE id='{$scNo}' LIMIT 1";
		$row = $conn->query($sql)->fetch_assoc();
		if($row['seat']>0){
			$seatCost = (!empty($retDate)) ? $row['seatCost']*2 : $row['seatCost'];
			$totalSeat = $row['seat'];
			$scid = $row['id'];
		} else header("Location: ../user.php?msg=No Seat Available");
	} else{
		$location = "Location: ../user.php?msg=Error";
		header($location);
	}

	$fname = $conn->real_escape_string($_POST["first_name"]);
	$lname = $conn->real_escape_string($_POST["last_name"]);
	$email = $conn->real_escape_string($_POST["email"]);
	$number = $conn->real_escape_string($_POST["number"]);
	$user = $_SESSION['username'];
	$pnr = $scid.$_POST["TrainNumber"].$totalSeat.strrev($seatamnt+$seatamntA).($seatamnt+$seatamntA).strrev($totalSeat);
	$amount = 0;
	foreach(explode(",", $seatNames) as $seat_number){
		if($seat_number <= 50) $amount += $seatCost;
		else if($seat_number > 50 & $seat_number <= 100) $amount += intval($seatCost+($seatCost*.2));
		else if($seat_number > 100 & $seat_number <= 150) $amount += intval($seatCost+($seatCost*.4));
		else if($seat_number > 150 & $seat_number <= 200) $amount += intval($seatCost+($seatCost*.6));
		else if($seat_number > 200 & $seat_number <= 250) $amount += intval($seatCost+($seatCost*.8));
		echo $seat_number." - ".$amount." - ".$seatCost."<br/>";
	}
	$sql = "INSERT INTO `books` ";
	$sql.= "(`scNumber`, `fname`, `lname`, `phone`, `email`, `dest`, `depart`, `depDate`, `depTime`, `retTime`, `retDate`, `amount`, `seatNames`, `pnr`, `accept`, `user`) ";
	$sql.= "VALUES ('$trainNumber', '$fname', '$lname', '$number', '$email', '$toLoc', '$fromLoc', '$depDate', '$depTime', '$retTime', '$retDate', '$amount', '$seatNames', '$pnr', '0', '$user');";
	
	$qry = mysqli_query($conn, $sql);
	if ($qry != true) {
		echo mysqli_error($conn);
		die();
	}

	if($totalSeat>=$seatamnt){
		$remseat  = $totalSeat - ($seatamnt+$seatamntA);
		$sql="UPDATE `schedule` SET `seat` = '$remseat' WHERE `schedule`.`id` = '$scid';";
		$result=  mysqli_query($conn, $sql);
		if($result){
				$sms = 'Your Ticket Is Accepted For Train Number ' . $trainNumber . ' For Date ' . $depDate . ' And PNR Is ' . $pnr;
				$sql = "INSERT INTO `notification`(`user`, `sms`, `adminPriority`, `userPriority`) VALUES ('$user','$sms','1','0')";
				$result=  mysqli_query($conn, $sql);
				if($result){
						$location = "Location: ../bookTrainUser.php?confirm=Ticket Is Waiting For Confirmation&pnr=".$pnr;
						header($location);
				} else{
						$location = "Location: ../user.php?msg=Please Try Again Later";
						header($location);
				}
		} else{
			$location = "Location: ../user.php?msg=Please Try Again Later";
			header($location);
		}
	}
?>