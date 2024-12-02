<?php
	session_start();
	include 'connection.php';
	include 'header/userheader.php';
?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>

<center>
	<h1>Reservation Panel</h1><br><br>
	<div style="width: 300px;">
	
	<form>
		<input class="inpt" type="text" name="srch" placeholder="Give Your PNR">
		<input type="submit" name="submit" value="SEARCH">
	</form>
	</div>
	<table class="table table-bordered">
		<tr>
			<th>
				<label>Bus Number</label>
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
			<th>
				<label>Accept/Action</label>
			</th>
		</tr>

<?php
    $user = $_SESSION['username']; 
    if(isset($_GET['submit'])){
		if($_GET['srch']!=null){
			$pnr = $_GET['srch'];
			$sql="SELECT * FROM `sas`.`flight` WHERE `user` = '$user' AND `pnr` = '$pnr' ORDER BY `id`";
		}else{
			$sql="SELECT * FROM `sas`.`flight` WHERE `user` = '$user' ORDER BY `id`";
		}
	}else{
		$sql="SELECT * FROM `sas`.`flight` WHERE `user` = '$user' ORDER BY `id`";
	}        

    
    $result=  mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        while ($row=mysqli_fetch_assoc($result)){
?>
	<tr>
		<td>
			<a href="flightInfo?nmbr=<?php echo $row['flightNumber']; ?>"><?php echo $row['flightNumber']; ?></a>
		</td>
		<td>
			<?php echo $row['pnr']; ?>
		</td>
		<td>
			<?php echo $row['fname']; ?>
		</td>
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
			<?php 
			if($row['accept'] == 0){
?>
		<p class="text-danger">Not Confirmed</p> /
		<a class="text-warning" href="CancelRserv.php?pnr=<?php echo $row['pnr']?>">Cancel</a> 

<?php
			}else if($row['accept'] == 1){
?>

			<p class="text-success">Confirmed</p> /
			<a class="text-warning" href="TermsForCancel.php?pnr=<?php echo $row['pnr']?>">Cancel</a> /
			<a class="text-info" href="print.php?pnr=<?php echo $row['pnr']?>">Show Ticket</a>
			
<?php 
			}

?>
		</td>
	</tr>
<?php }}else{
	echo "<script type='text/javascript'>alert('PNR Not Matched');</script>";
}?>

	</table>
</center>




<br><br>


<?php include 'footer.php';?>

</body>
</html>