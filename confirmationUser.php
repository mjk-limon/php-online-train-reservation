<?php
	session_start();
	include 'connection.php';
	include 'header.php';
?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>

<div class="container">
	<h1 class="text-center">Reservation Panel</h1>
	<div style="display:block;margin-left:auto;margin-right:auto;width:300px;">
		<div class="search-container">
			<form>
				<input class="ser" type="text" name="srch" placeholder="Give Your PNR">
				<input type="submit" name="submit" value="SEARCH" class="ser-bt" style="width:25%!important;">
			</form>
		</div>
	</div>
	<table class="adnmin-tabil">
		<tr>
			<th><label>Train Name</label></th>
			<th><label>Train Number</label></th>
			<th><label>PNR Number</label></th>
			<th width="13%"><label>Full Name</label></th>
			<th><label>Phone Number</label></th>
			<th><label>Email</label></th>
			<th><label>Date Booking</label></th>
			<th><label>Amount</label></th>
			<th width="13%"><label>Seats</label></th>
			<th><label>Action</label></th>
		</tr>

<?php
    $user = $_SESSION['username']; 
    if(isset($_GET['submit'])){
		if($_GET['srch']!=null){
			$pnr = $_GET['srch'];
			$sql="SELECT * FROM `reset`.`books` WHERE `user` = '$user' AND `pnr` = '$pnr' ORDER BY `id`";
		} else $sql="SELECT * FROM `reset`.`books` WHERE `user` = '$user' ORDER BY `id`";
	} else $sql="SELECT * FROM `reset`.`books` WHERE `user` = '$user' ORDER BY `id`";
	$result=  $conn->query($sql);
	if($result->num_rows >0){
		while ($row=mysqli_fetch_assoc($result)){
		$cInfo = $conn->query("SELECT * FROM schedule WHERE scNumber = '{$row['scNumber']}'")->fetch_assoc();
?>
	<tr>
		<td><?php echo $cInfo['scName']; ?></td>
		<td><?php echo $cInfo['scNumber']; ?></td>
		<td><?php echo $row['pnr']; ?></td>
		<td><?php echo $row['fname'].' '.$row['lname']; ?></td>
		<td><?php echo $row['phone']; ?></td>
		<td><?php echo $row['email']; ?></td>
		<td><?php echo $row['dob']; ?></td>
		<td><?php echo $row['amount']; ?></td>
		<td>
			<?php echo $row['seatNames']; ?> (Up)<br>
			 <?php if(!empty($row['seatNamesDown'])) echo $row['seatNamesDown'].' (Down)'; ?> 
		</td>
		<td>
		<?php if($row['accept'] == 0){ ?>
			<p class="text-danger">Not Confirmed</p> /
			<a class="text-warning" href="CancelRserv.php?pnr=<?php echo $row['pnr']?>">Cancel</a> 
		<?php } else if($row['accept'] == 1){ ?>
			<p class="text-success">Confirmed</p> /
			<a class="text-info" href="print.php?pnr=<?php echo $row['pnr']?>">Show Ticket</a>
		<?php } ?>
		</td>
	</tr>
<?php }}else{
	echo "<script type='text/javascript'>alert('PNR Not Matched');</script>";
}?>

	</table>
</div>
<br><br><br>
<?php include 'footer.php';?>

</body>
</html>