<?php
	include '../connection.php';
	$fname = $conn->real_escape_string($_POST["fname"]);
	$lname = $conn->real_escape_string($_POST["lname"]);
	$uname = $conn->real_escape_string($_POST["uname"]);
	$Email = $conn->real_escape_string($_POST["Email"]);
	$password = $conn->real_escape_string($_POST["password"]);

	$sql = "INSERT INTO `customer` (`cus_first_name`, `cus_last_name`, `cus_user_name`, `cus_pass`,`email`) VALUES ('$fname', '$lname', '$uname', '$password', '$Email')";
	$qry = mysqli_query($conn, $sql);
	$user_id = $conn->insert_id;
	
	$bal_sql = "INSERT INTO `balance` (`username`, `userid`, `balance`) ";
	$bal_sql.= "VALUES ('{$uname}', '{$user_id}', '0')";
	$bal_qry = mysqli_query($conn, $bal_sql);
	if ($qry && $bal_qry) {
		header("Location: ../login.php?msg=Registration Completed");
	} else {
		$error = "Location: ../register.php?msg=Registration Not Completed. Error: " . mysqli_error($conn);
		header($error);
	}
?>