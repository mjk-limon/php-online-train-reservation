<?php 
include 'connection.php';
$pnr = $_GET['pnr'];

$books_info = $conn->query("SELECT `amount`, `user`, `scNumber`, `dob` FROM `books` WHERE `pnr` = '$pnr' ")->fetch_assoc();
$product_query = "SELECT * FROM balance WHERE username = '{$books_info['user']}' ";
$run_query     = mysqli_query($conn, $product_query);
if (mysqli_num_rows($run_query) > 0) {
	$sl = 0;
	while ($row = mysqli_fetch_array($run_query)) {
		$sl++;
		$balance   = $row['balance'];
		$balanceid = $row['id'];
		
		if($balance>=$books_info['amount'])
		{
			$balance   = $balance - $books_info['amount'];
			
			
	$sql2 = "UPDATE `balance` SET `balance` = '$balance' WHERE  id = '$balanceid' ";
	if (mysqli_query($conn, $sql2)) {
		echo "balance updated";
	}

	$sql="UPDATE `books` SET `accept`='1' WHERE `pnr` = '$pnr';";
	$result=  mysqli_query($conn, $sql);
	if($result){
		$sms = 'Your ticket for Train number ' . $books_info['scNumber'] . ' for Date ' . date("Y-m-d", strtotime($books_info['dob'])) . ' and PNR '. $pnr .' is accepted !';
		$sql = "INSERT INTO `notification` (`user`, `sms`, `adminPriority`, `userPriority`) VALUES ('{$books_info['user']}','$sms','1','0')";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			$location = "Location: confirmationAdmin.php?msg=Ticket Reservation Confirmned For PNR =".$pnr;
			header($location);
		} else {
			$location = "Location: confirmationAdmin.php?msg=Please Try Again Later";
			header($location);
		}
	} else{
		echo mysql_error();
	}
			
			
			
			
		}
		else
			
		
		{ ?>
		     <br><br><br>
		<center>
		<div style="width:50%;  background-color: #8dfaf273;border: 4px solid #fff;">
			     <center><h2 style="color:red; font-family:Lucida Fax; font-size:25px;"> Balance low</center></h2>
		
		</div></center>
		
		<?php }
		
	}
}

?>