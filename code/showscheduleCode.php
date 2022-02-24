<?php
	include '../connection.php';
	function InsertInTable($table,$fields){
		global $conn;
		$sql  = "INSERT INTO {$table} (".implode(" , ",array_keys($fields)).") ";
		$sql .= "VALUES('";      
		foreach($fields as $key => $value) { 
			$fields[$key] = $value;
		}
		$sql .= implode("' , '",array_values($fields))."');";       
		return $sql;
	}
	$fields['scName'] = $conn->real_escape_string($_POST["TrainName"]);
	$fields['scNumber'] = $conn->real_escape_string($_POST["TrainNumber"]);
	$fields['scType'] = $conn->real_escape_string($_POST["sctype"]);
	$fields['fromLoc'] = $conn->real_escape_string($_POST["fromLoc"]);
	$fields['toLoc'] = $conn->real_escape_string($_POST["toLoc"]);
	$fields['depDate'] = $conn->real_escape_string(date('Y-m-d', strtotime($_POST["depart_date"])));
	(!empty($_POST["return_date"])) ? $fields['retDate'] = $conn->real_escape_string(date('Y-m-d', strtotime($_POST["return_date"]))) : null;
	$fields['depTime'] = $conn->real_escape_string(date('H:i:s', strtotime($_POST["depart_time"])));
	(!empty($_POST["return_time"])) ? $fields['retTime'] = $conn->real_escape_string(date('H:i:s', strtotime($_POST["return_time"]))) : null;
	
	$fields['seat'] = $conn->real_escape_string($_POST["seat"]);
	$fields['seatCost'] = $conn->real_escape_string(implode(",", $_POST['scost']));
	$fields['cType'] = $cType = $conn->real_escape_string($_POST['ctype']);

	switch($cType) {
		case 1: $cTypeLbl = "Train"; break;
		default: exit;
	}

	$sql="SELECT * FROM `schedule` WHERE `scName` = '$TrainNamee' AND (`depDate` = '$depDate' OR `depDate` = '$retDate')";
	$result=  mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)){
		header("Location: ../schedule{$cTypeLbl}.php?msg={$cTypeLbl} Already Available");
	} else{
		$sql = InsertInTable("schedule", $fields);
		$qry = mysqli_query($conn, $sql);
		if ($qry) {
			header("Location: ../showschedule.php?msg={$cTypeLbl} Scheduled");
		}else{
			$error = "Location: ../showschedule.php?msg=".urlencode($conn->error);
			header($error);
		}
	}
?>