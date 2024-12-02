<?php
	session_start();
	include 'connection.php';
	include 'header.php';
?>
<?php
	//echo "<pre>"; print_r($_SESSION); echo "</pre>"; exit;
	if(isset($_POST['update-balance'])) {
		$user_id = $_SESSION['username'];
		$amount = $con->real_escape_string($_POST['amount']);
		$accnumber = $con->real_escape_string($_POST['accnumber']);
		$trxnid = $con->real_escape_string($_POST['trxnid']);
		
		$sql = "INSERT INTO payments (user_id, amount, acnumber, trxn_id, status) ";
		$sql.= "VALUES ('{$user_id}', '{$amount}', '{$accnumber}', '{$trxnid}', '0')";
		if($con->query($sql)) echo '<script>alert("Payment is under review !")</script>';
		else echo '<script>alert("'.$con->error.'")</script>';
	}
?>
<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-12">
			<div class="sidebar">
			  <h3>Sidebar</h3>
			  <ul>
				<li> <a href="">Dashboard </a> </li>
				<li> <a href='myWallet.php'>My Wallet </a></li>
				<li><a href=""> profile </a></li>
				<li><a href=""> logout </a></li>
			  </ul>
		
			</div>
		</div>
		
		<div class="col-md-9  col-sm-9 col-12">
			<div class="row">
				<div class="col-md-12">
					<div class="adnmin-firde-tabil">
						<h2 class="text-center">Your available balance is: <span class="text-success">BDT80</span></h2>
						<div class="well text-left">
							<h4>Update Balance</h4>
							<form id="" action="" method="post">
								<input type="hidden" name="update-balance" />
								<div class="form-group">
									<label>Amount</label>
									<input type="number" name="amount" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Bkash number</label>
									<input type="text" name="accnumber" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Bkash trxn id</label>
									<input type="text" name="trxnid" class="form-control" required />
								</div>
								<div class="form-group">
									<input type="submit" value="Submit" class="btn btn-success"/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php include 'footer.php'; ?>
</body>
</html>