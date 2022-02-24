<?php
	session_start();
	include 'connection.php';
	include 'header.php';
?>



<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-12">
			<div class="sidebar">
			  <h3>Dashboard</h3>
			  <ul>
				<li> <a href='myWallet.php'>My Wallet</a></li>
				</ul>
		    </div>
		</div>
		
		<div class="col-md-9  col-sm-9 col-12">
		
		
		
		
					<div class="row">
		<div class="col-md-12">
			<div class="adnmin-firde-tabil">
						<h3 class="wlcmAdmin" style="color: Green">Hello <?php date_default_timezone_set('Asia/Dhaka'); echo $_SESSION['username'];?> Welcome to your panel</h3><br>
						<p class="wlcmdate datemar"> <span class="to-time"><?php echo date("l jS \of F Y")?></span></p><br>
						<p class="wlcmtime datemar"><span class="to-time">Server Time <?php echo date("h:ia"); ?></span></p><br>
					</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<td colspan="2"><h2 style="color: Red;">New Notifications</h2></td>
			<?php 
				$user = $_SESSION['username'];
				$sql="SELECT * FROM `notification` where `user`='$user' AND `userPriority`='0' ";
				$result=  mysqli_query($conn, $sql);
				if(mysqli_num_rows($result)){
				while ($row=mysqli_fetch_assoc($result)){
			?>
				<tr>
					<td><p><?php echo $row['sms'];?></p></td>
					<td><a class="nnn " href="markRead.php?id=<?php echo $row[ 'id']?>">Mark As Read</a></td>
				</tr>
			<?php }}?>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<td colspan="2"><h2 style="color: Red">Old Notifications</h2></td>
				<?php 
				$user = $_SESSION['username'];
				$sql="SELECT * FROM `notification` where `user`='$user' AND `userPriority`='1' ";
				$result=  mysqli_query($conn, $sql);
				if(mysqli_num_rows($result)){
				while ($row=mysqli_fetch_assoc($result)){
				?>
				<tr><td><p><?php echo $row['sms'];?></p></td></tr>
				<?php }} ?>
			</table>
		</div>
	</div>
		
		
		
		
		
		</div>
	
	</div>


</div>

<?php include 'footer.php'; ?>
</body>
</html>