
<?php 
include 'header/headerAdmin.php';
?>

<!-- welcome admin and show date time -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-12">
					<div class="adnmin-firde-tabil">
						<h3 class="wlcmAdmin"style="color:Green">Hello <?php date_default_timezone_set('Asia/Dhaka'); echo $_SESSION['adminname'];?> Welcome to your panel</h3><br>
						<p class="wlcmdate datemar"> <span class="to-time"><?php echo date("l jS \of F Y")?></span></p><br>
						<p class="wlcmtime datemar"><span class="to-time">Server Time <?php echo date("h:ia"); ?></span></p><br>
					</div>
						<table class="adnmin-sec-tabil">
							<tr>
								<td colspan="2"><h2 style="color: Red">Notifications</h2></td>						 
								  <?php 
									  $sql="SELECT * FROM `books` where `accept` = '0'";
									  $result=  mysqli_query($conn, $sql);
									  if(mysqli_num_rows($result)){
									?>
							</tr>
							<tr>
								<td>
								  <h4 style="color:#000;"><?php echo mysqli_num_rows($result);?> Tickets Are Waiting For Confirmation</h4>
								</td>
								<td>
								  <a class="nnn" href="confirmationAdmin.php">Confirm Now</a>
								</td>
							</tr>


						  <?php }?>

					  </table>
				</div>
			</div>
		</div>
		<br>
<center><?php
include 'footer.php';
?></center>