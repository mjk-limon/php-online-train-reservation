<?php include 'header/headerAdmin.php'; ?>
<center>
	<h1>Confirmation Panel</h1><br><br>
	<div style="width: 300px;">
	<button class="btn btn-info" onclick="prnt()"><i class="glyphicon glyphicon-print"></i> Print</button>
		<div class="search-container">
			<form action="">
				<input type="text" name="srch" placeholder="Give Your PNR" class="ser" >
				<button type="submit" name="submit" class="ser-bt" style="width:25%!important;">Search</button>
			</form>
		</div>
	</div>
</center>
<div class="">
	<center><h3 style="color: black;"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></h3></center>
	<center style="background: #fff; padding: 1.5em" id="main">
		<table class="adnmin-tabil">
			<tr>
			   <th>
			       <label>Train Name</label>
			   </th>
				<th>
					<label>Train Number</label>
				</th>
				<th>
				<label>Train Type</label>
				</th>
				<th>
					<label>PNR Number</label>
				</th>
				<th>
					<label>First Name</label>
				</th>
				<th>
					<label>Last Name</label>
				</th>
				<th>
					<label>Phone Number</label>
				</th>
				<th>
					<label>Email</label>
				</th>
				<th>
					<label>Date Booking</label>
				</th>
				<th>
					<label>Amount</label>
				</th>
				<th width="15%">
					<label>Seats</label>
				</th>
				<th>
					<label>Action</label>
				</th>
			</tr>

	<?php
		if(isset($_GET['submit'])){
			if($_GET['srch']!=null){
				$pnr = $_GET['srch'];
				$sql="SELECT * FROM `reset`.`books` where `pnr` = '$pnr' ORDER BY `id`";
			} else $sql="SELECT * FROM `reset`.`books` ORDER BY `id`";
		} else $sql="SELECT * FROM `reset`.`books` ORDER BY `id` DESC";        
		
		$result=  mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while ($row=mysqli_fetch_assoc($result)){
				$cInfo = $conn->query("SELECT * FROM schedule WHERE scNumber = '{$row['scNumber']}'")->fetch_assoc();
	?>
		<tr> 
		    <td><?php echo $cInfo['scName']; ?></td>
			<td><?php echo $row['scNumber']; ?></td>
			<td><?php echo ($cInfo['scType'] == 1) ? 'A/C' : 'Non A/C';  ?></td>
			<td><?php echo $row['pnr']; ?></td>
			<td><?php echo $row['fname']; ?></td>
			<td>
				<?php echo $row['lname']; ?>
			</td>
			<td>
				<?php echo $row['phone']; ?>
			</td>
			<td>
				<?php echo $row['email']; ?>
			</td>
			<td>
				<?php echo $row['dob']; ?>
			</td>
			<td>
				<?php echo $row['amount']; ?>
			</td>
			<td>
				<?php echo $row['seatNames']; ?>(UP)<br>
				<?php if(!empty($row['seatNamesDown'])) echo $row['seatNamesDown'].'(Down)'; ?> 
			</td>
			<td>
			<?php if($row['accept'] == 0){ ?>
				<a href="ConfirmBookCode.php?pnr=<?php echo $row['pnr']?>" style="color: red;">Confirm</a> / <a href="CancelRservAdmin.php?pnr=<?php echo $row['pnr']?>">Cancel</a>
			<?php } else if($row['accept'] == 1){ ?>
				<p>Confirmed</p>  / <a style="color: red" href="CancelRservAdmin.php?pnr=<?php echo $row['pnr']?>">Cancel</a> / <a href="print.php?pnr=<?php echo $row['pnr']?>">Show Ticket</a>
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
			win.document.write("<center><h1>Confirmation Panel</h1></center><br><br>");
			win.document.write(div);
			win.document.write("<br><br><center><p>Developed By IK Sajib</p></center>");
			win.print();
		}
</script>
<br><br><br><br>
<?php include 'footer.php';?>
