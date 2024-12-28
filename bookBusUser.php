<?php
session_start();
include 'connection.php';
include "header.php";

$pnr = $_GET['pnr'];
$sql = "SELECT * FROM `sas`.`books` WHERE `pnr` = '$pnr' ORDER BY `id`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	extract($row);
} else {
	header("Location: index.php");
}
?>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./css/headercss.css">
<link rel="stylesheet" type="text/css" href="scss/letter.css">
<link rel="stylesheet" type="text/css" href="./css/headercss.css">

<!Doctype html>
<html>
<title>Payment </title>

<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		table {
			border: 1px solid white;
		}

		tr {
			border: 1px solid white;
		}

		td,
		th {
			border: 1px solid white;
			padding-top: 5px;
			padding-bottom: 5px;
			padding-left: 15px;
			padding-right: 15px;
		}
	</style>
</head>

<body>
	<div style="height: 30px"></div>
	<center>
		<h3>
			<?php if (isset($_GET['confirm'])) {
				echo $_GET['confirm'];
			} ?>
			</h1>
			<h2>
				PNR Number =
				<?php if ($_GET['pnr']) {
					echo $_GET['pnr'];
				} ?>
			</h2>
	</center>
	<center>
		<h4 style="color: green;">
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
				<input type="hidden" name="customer_name" value="<?php echo $fname . ' ' . $lname ?>" required />
				<input type="hidden" name="customer_mobile" value="<?php echo $phone ?>" required />
				<input type="hidden" name="customer_email" value="<?php echo $email ?>" required />
				<input type="hidden" value="<?php echo $amount ?>" name="amount" required />
				<input type="submit" value="Pay from Wallet" class="btn btn-secondary" />
			</form>
		</h4>
	</center>
</body>
<?php include 'footer.php'; ?>

</html>