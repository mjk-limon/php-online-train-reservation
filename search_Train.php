<?php
	session_start();
	include 'connection.php';
	include 'header.php';
?>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">
	<link rel="stylesheet" type="text/css" href="scss/letter.css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">


<div class="row">
	<div class="col-md-12">
		<div class="maintext" style="min-height: 260px;">
			<div id="flights">
				<h1 class="ftext1">Select Your Trip Type</h1>
				<div class="all-infut-1">
					<div class="form-group">
						<select id="trip" name="trip">
								<option value="0" disabled="" selected="">Select</option>
								<option value="1">Round Trip</option>
								<option value="2">One Way</option>
						</select>
					</div>
				</div>
				<div id="twoWay">
					<form action="searchTraines.php" method="get">
						<div class="form-group">
							<div class="all-infut" style="display: inline-block; width: 95%;">
								<div class="falf-infut">
									<select required="" id="cmbMake" name="DepLoc">
										<option value="" id="place">Leaving from...</option>
										<?php
												$sql="SELECT * FROM `reset`.`location` ORDER BY `Name`";
												$result=  mysqli_query($conn, $sql);
												if(mysqli_num_rows($result)){
													while($row=mysqli_fetch_assoc($result)){
										?>
											<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
										<?php                                      
													}
												}
												mysqli_close();
										?>
									</select>
								</div>
								<div class="falf-infut">
									<select required="" id="cmbMake" name="RechLoc">
										<option value="" id="place">Going to...</option>
									<?php
										$sql="SELECT * FROM `reset`.`retlocation` ORDER BY `Name`";
										$result=  mysqli_query($conn, $sql);
										if(mysqli_num_rows($result)){
										while($row=mysqli_fetch_assoc($result)){
									?>
										<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
									<?php }} mysqli_close(); ?>
									</select>
								</div>
							</div>
						</div>
						<div class="all-infut">
							<div class="form-group">
								<label style="display: block" id="label0" class="ftext">Depart date:</label>
								<input required="" type="text" name="depart_date" id="datepicker1" placeholder="month/day/year" />
							</div>
						</div>
						<div class="all-infut">
							<div class="form-group">
								<label style="display: block" id="label1" class="ftext">Return date:</label>
								<input required="" type="text" name="return_date" id="datepicker" placeholder="month/day/year" />
							</div>
						</div>
						<div class="all-infut-login-btn">
							<div class="form-group">
								<p class="ftext" id="dateIn"></p>
								<input class="search btn btn-success" type="submit" name="searchTwo" id="find" value="Search Traines" />
							</div>
						</div>
					</form>
				</div>
				<div id="oneWay">
					<form action="searchTraines.php" method="get">
						<div class="form-group">
							<div class="all-infut" style="display: inline-block; width: 95%;">
								<div class="falf-infut">	
									<select id="cmbMake" name="DepLoc" required>
										<option value="" id="place">Leaving from...</option>
									<?php
									$sql="SELECT * FROM `reset`.`location` ORDER BY `Name`";
									$result=  mysqli_query($conn, $sql);
									if(mysqli_num_rows($result)){
										while ($row=mysqli_fetch_assoc($result)){
									?>
										<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
									<?php }} mysqli_close(); ?>
									</select>
								</div>
								<div class="falf-infut">
									<select id="cmbMake" name="RechLoc" required>
										<option value="" id="place">Going to...</option>
									<?php
									$sql="SELECT * FROM `reset`.`retlocation` ORDER BY `Name`";
									$result=  mysqli_query($conn, $sql);
									if(mysqli_num_rows($result)){
									while ($row=mysqli_fetch_assoc($result)){
									?>
										<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
									<?php }} mysqli_close(); ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="all-infut">
								<label style="display: solid block" id="label0" class="ftext">Date:</label>
								<input required="" type="text" id="datepicker3" name="depart_date" placeholder="month/day/year" />
							</div>
						</div>
						<div class="form-group">
							<div class="all-infut-login-btn">
								<input class="search btn btn-success" type="submit" name="searchOne" id="find" value="Search Traines" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
<br> <br>
<?php include 'footer.php'; ?>
<link rel="stylesheet" href="js2/jquery-ui.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script>
	$(document).ready(function() {
		$("#datepicker").datepicker({minDate: 0,dateFormat: 'yy-mm-dd'});
		$("#datepicker1").datepicker({minDate: 0,dateFormat: 'yy-mm-dd'});
		$("#datepicker3").datepicker({minDate: 0,dateFormat: 'yy-mm-dd'});
	});
	$(document).ready(function() {
		var selector = function(dateStr) {
			var d1 = $('#datepicker').datepicker('getDate');
			var d2 = $('#datepicker1').datepicker('getDate');
			var diff = 0;
			diff = Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
			if (diff > 0) {
				$('#dateIn').show();
				$('#dateIn').text("Return Date Is Behind");
				$('#find').hide();
			} else if (diff <= 0) {
				$('#find').show();
				$('#dateIn').hide();
			}
		}
		$('#datepicker,#datepicker1').change(selector)
	});

	$(document).ready(function() {
		var selector = function() {
			if ($("#trip option:selected").text() == "Round Trip") {
				$("#twoWay").show();
				$("#oneWay").hide();
			} else if ($("#trip option:selected").text() == "One Way") {
				$("#oneWay").show();
				$("#twoWay").hide();
			}
		}
		$("#trip").change(selector)
	});
	$(document).ready(function() {
		$("#oneWay").hide();
		$("#twoWay").hide();
	});
</script>
</body>
</html>