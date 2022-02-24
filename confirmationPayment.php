<?php ob_start(); include 'header/headerAdmin.php'; ?>
<?php
	if(isset($_GET['action'])) {
		$id = $_GET['id'];
		if($_GET['action'] == 1) {
			$ramount = $con->query("SELECT user_id, amount FROM payments WHERE id = '{$id}' LIMIT 1")->fetch_assoc();
			$amount = $ramount['amount']; $username = $ramount['user_id'];
			
			$ub_sql = "UPDATE balance SET balance = balance + {$amount} WHERE username = '{$username}'";
			$up_sql = "UPDATE payments SET status = '1' WHERE id = '{$id}'";
			if($con->query($ub_sql) && $con->query($up_sql)) header('Location: confirmationPayment.php?msg='.urlencode("Successfully Updated !"));
			else header('Location: confirmationPayment.php?msg='.urlencode($conn->error));
		}
	}
?>
<center>
<button class="btn btn-info" onclick="prnt()"><i class="glyphicon glyphicon-print"></i> Print</button>
	<h1>Confirmation Panel</h1><br><br>
</center>
<div class="">
	<center><h3 style="color: black;"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></h3></center>
	<center style="background: #fff; padding: 1.5em" id="main">
	<center>
		<table class="adnmin-tabil">
			<tr>
				<th>
					<label>User Name</label>
				</th>
				<th>
					<label>Amount</label>
				</th>
				<th>
					<label>Payment Number</label>
				</th>
				<th>
					<label>Trxn. ID</label>
				</th>
				<th><label>Status</label></td>
				<th>
					<label>Action</label>
				</th>
			</tr>

	<?php
		$sql="SELECT * FROM `reset`.`payments` ORDER BY `id` DESC";
		$result=  mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while ($row=mysqli_fetch_assoc($result)){
	?>
		<tr> 
			<td><?php echo $row['user_id']; ?></td>
			<td><?php echo $row['amount']; ?></td>
			<td><?php echo $row['acnumber']; ?></td>
			<td>
				<?php echo $row['trxn_id']; ?>
			</td>
			<td>
				<?php echo ($row['status']) ? 'Confirmed' : 'Not confirmed'; ?>
			</td>
			<td>
			<?php if($row['status'] == 0){ ?>
				<a href="?action=1&id=<?php echo $row['id']?>" style="color: red;">Confirm</a> / <a href="?action=2&id=<?php echo $row['id']?>">Cancel</a>
			<?php } else if($row['status'] == 1){ ?>
				<p>Confirmed</p>
			<?php } ?>
			</td>
		</tr>
	<?php }} else{
		echo "<script type='text/javascript'>alert('PNR Not Matched');</script>";
	}?>
		</table>
	</center>
</div>
<script>
		function prnt(){
			var div="<html><head><style> .hideforpdf{display: none;}td{text-align:center;}table{border: 1px solid black;float: center;}table tr{border: 1px solid black;}table tr td{border: 1px solid black;}table tr th{border: 1px solid black;}</style></head><body>"
			div+=document.getElementById('main').innerHTML;
			div+="</body></html>"
			var win=window.open("", "", "width=960,height=500");
			win.document.write("<center><h1> Confirmation Panel </h1></center><br><br>");
			win.document.write(div);
			win.document.write("<br><br><center><p> Developed By IK Sajib </p></center>");
			win.print();
		}
</script>
<?php include 'footer.php';?>
