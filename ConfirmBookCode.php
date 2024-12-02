<?php 
include 'connection.php';
$pnr = $_GET['pnr'];

$books_info = $conn->query("SELECT `amount`, `user` FROM `books` WHERE `pnr` = '$pnr' ")->fetch_assoc();
$product_query = "SELECT * FROM balance WHERE username = '{$books_info['user']}' ";
$run_query     = mysqli_query($conn, $product_query);
if (mysqli_num_rows($run_query) > 0) {
	$sl = 0;
	while ($row = mysqli_fetch_array($run_query)) {
		$sl++;
		$balance   = $row['balance'];
		$balanceid = $row['id'];
		$balance   = $balance - $books_info['amount'];
	}
}

$sql2 = "UPDATE `balance` SET `balance` = '$balance' WHERE  id = '$balanceid' ";
if (mysqli_query($conn, $sql2)) {
	echo "balance updated";
}

$sql="UPDATE `books` SET `accept`='1' WHERE `pnr` = '$pnr';";
$result=  mysqli_query($conn, $sql);
if($result){
	$location = "Location: confirmationAdmin.php?msg=Ticket Reservation Confirmned For PNR =".$pnr;
 header($location);
} else{
	echo mysql_error();
}
?>