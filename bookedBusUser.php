<?php
session_start();
include 'connection.php';
include "header.php";

$pnr = $_GET['pnr'];
$msg = $_GET['msg'];
$status = $_GET['status'];
$textClass = $status == 1 ? 'success' : 'danger';

$sql = "SELECT * FROM `sas`.`books` WHERE `pnr` = '$pnr' ORDER BY `id`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	extract($row);
} else {
	header("Location: index.php");
}
?>

<!Doctype html>
<html>
<title>Payment </title>

<head>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">
	<link rel="stylesheet" type="text/css" href="scss/letter.css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div style="height: 30px"></div>
	<center>
		<h1 class="<?php echo 'text-' . $textClass ?>"><?php echo $msg; ?></h1>
		<h2>PNR Number = <?php echo $pnr ?></h2>
	</center>

	<table class="table table-bordered" style="width: 60%; margin: 0 auto;">
		<tr>
			<td class="text-center">Journey Date</td>
			<td class="text-center" style="font-weight: bold;"><?php echo date('j M, Y', strtotime($depDate)) ?></td>
		</tr>
		<tr>
			<td class="text-center">Journey Time</td>
			<td class="text-center" style="font-weight: bold;"><?php echo date('h:i A', strtotime($depTime)) ?></td>
		</tr>
		<tr>
			<td class="text-center">Trip Number</td>
			<td class="text-center" style="font-weight: bold;"><?php echo $scNumber ?></td>
		</tr>
		<tr>
			<td class="text-center">Seat Number</td>
			<td class="text-center" style="font-weight: bold;"><?php echo $seatNames ?></td>
		</tr>
		<tr>
			<td class="text-center">Phone</td>
			<td class="text-center"><?php echo $phone ?></td>
		</tr>
		<tr>
			<td class="text-center">Email</td>
			<td class="text-center"><?php echo $email ?></td>
		</tr>
		<tr>
			<td colspan="2" class="text-center">
				<?php if ($accept): ?>
					<a class="btn btn-info" href="print.php?pnr=<?php echo $row['pnr'] ?>">Show Ticket</a>
				<?php else: ?>
					<form action="./SSLCommerz/checkout_hosted.php" method="POST" id="checkoutForm">
						<input type="hidden" name="tran_id" value="<?php echo $pnr ?>" required />
						<input type="hidden" name="customer_name" value="<?php echo $fname . ' ' . $lname ?>" required />
						<input type="hidden" name="customer_mobile" value="<?php echo $phone ?>" required />
						<input type="hidden" name="customer_email" value="<?php echo $email ?>" required />
						<input type="hidden" value="<?php echo $amount ?>" name="amount" required />

						<input type="submit" value="Pay online" class="btn btn-primary" />
					</form>
					<form action="walletPayment.php" method="POST" id="walletForm">
						<input type="hidden" name="tran_id" value="<?php echo $pnr ?>" required />
						<input type="hidden" name="customer_username" value="<?php echo $user ?>" required />
						<input type="hidden" name="customer_name" value="<?php echo $fname . ' ' . $lname ?>" required />
						<input type="hidden" name="customer_mobile" value="<?php echo $phone ?>" required />
						<input type="hidden" name="customer_email" value="<?php echo $email ?>" required />
						<input type="hidden" value="<?php echo $amount ?>" name="amount" required />
						<input type="submit" value="Pay from Wallet" class="btn btn-secondary" />
					</form>
				<?php endif; ?>
			</td>
		</tr>
	</table>
</body>

<?php include 'footer.php'; ?>

</html>