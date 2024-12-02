<?php
	$avail = -1;
	session_start();
	if(!isset($_SESSION['username'])) header('Location: login.php');
	include 'connection.php';
	include"header.php";
?>
<div class="container">	
	<div class="row">
		<div class="col-md-9 col-md-offset-2 figure-box">
	<?php
		if(isset($_GET['searchTwo']) || isset($_GET['searchOne'])) {
			if(isset($_GET['searchTwo'])) {
				$DepLoc = $_GET['DepLoc'];
				$RechLoc = $_GET['RechLoc'];
				$depart_date = $_GET['depart_date'];
				$return_date = $_GET['return_date'];
				$depart_time; $return_time; $scNumber; $totalSeat;
				$sql = "SELECT * FROM `sas`.`schedule` ";
				$sql.= "WHERE `depDate` = '$depart_date' AND `retDate` = '$return_date' ";
				$sql.= "AND `fromLoc` = '$DepLoc' AND `toLoc` = '$RechLoc'";
				$sql.= "AND `cType` = '1' ORDER BY `id`";
				$result = mysqli_query($conn, $sql);
			} else if (isset($_GET['searchOne'])) {
				$DepLoc = $_GET['DepLoc'];
				$RechLoc = $_GET['RechLoc'];
				$depart_date = $_GET['depart_date'];
				$sql = "SELECT * FROM `sas`.`schedule` ";
				$sql.= "WHERE (`depDate` = '$depart_date' OR `retDate` = '$depart_date') AND ";
				$sql.= "(`fromLoc` = '$DepLoc' OR `toLoc` = '$DepLoc') ";
				$sql.= "AND (`toLoc` = '$RechLoc' OR `fromLoc` = '$RechLoc') ";
				$sql.= "AND `cType` = '1' ORDER BY `id`";
				$result=  mysqli_query($conn, $sql);
			}
			if(mysqli_num_rows($result)){ 
	?>
			<h4 class="text-center">Your Trip Bus's Total <strong><?= mysqli_num_rows($result) ?></strong> Bus Found</h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Bus Info</th>
						<th>Dept. Time</th>
						<th>Return Time</th>
						<th>Seat Available</th>
						<th>Fare</th>
					</tr>
				</thead>
				<tbody>
				<?php
					while ($row=mysqli_fetch_assoc($result)){
						$searchT = isset($_GET['searchTwo']) ? 2 : 1;
						$depart_time = !empty($row['depTime']) ? date('h:i (A)', strtotime($row['depTime'])) : '-';
						$return_time = isset($_GET['searchTwo']) ? date('h:i (A)', strtotime($row['retTime'])) : '-';
						$scName = $row['scName'];
						$scNumber = $row['scNumber'];
						$sctype = ($row['scType'] == 1) ? 'A/C' : 'Non A/C';
						$seatCost = isset($_GET['searchTwo']) ? $row['seatCost']*2 : $row['seatCost'];
						$totalSeat = $row['seat'];
				?>
					<tr>
						<td>
							<p><?= $scName ?></p>
							<p class="text-info" style="font-size:13px">Type: <?= $sctype ?></p>
						</td>
						<td><?= $depart_time ?></td>
						<td><?= $return_time ?></td>
						<td><?= $totalSeat ?></td>
						<td>
							<h4 class="text-success">Tk. <?= $seatCost ?></h4>
							<a href="?scNo=<?= $row['id'] ?>&searchT=<?= $searchT ?>" class="btn btn-success">View Seats</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		<?php } else { ?>
			<center><h1>Sorry To Inform You That<br> We Do Not Have Buses That <br>Meet Your Requirements</h1></center>
		<?php } ?>
	<?php
		} else if(isset($_GET['scNo'])) {
			$scNo = $conn->real_escape_string($_GET['scNo']);
			$row = $conn->query("SELECT * FROM schedule WHERE id='{$_GET['scNo']}' LIMIT 1")->fetch_assoc();
			$DepLoc = $row['fromLoc'];
			$RechLoc = $row['toLoc'];
			$depLoc = $conn->query("SELECT * FROM location WHERE id='{$DepLoc}' LIMIT 1 OFFSET 0")->fetch_array();
			$rechLoc = $conn->query("SELECT * FROM retlocation WHERE id='{$RechLoc}' LIMIT 1 OFFSET 0")->fetch_array();
			
			$depart_date = date("F j, Y", strtotime($row['depDate']));
			$depart_time = date('h:i (A)', strtotime($row['depTime']));
		
			$return_date =  ($_GET['searchT'] == 2) ? date("F j, Y", strtotime($row['retDate'])) : '-';
			$return_time = ($_GET['searchT'] == 2) ? date('h:i (A)', strtotime($row['retTime'])) : '-';
			
			$scName = $row['scName'];
			$scType = ($row['scType'] == 1) ? 'A/C' : 'Non A/C';
			$scNumber = $row['scNumber'];
			$seatCost = ($_GET['searchT'] == 2) ? $row['seatCost']*2 : $row['seatCost'];
			$totalSeat = $row['seat'];
	?>
			<h4 class="text-center color-rip">Your Trip Bus's Total <strong><?php echo $totalSeat?></strong> Seats Is Available</h4>
			<div class="color-rip2">
				<h4>You Requested A Bus Of Following Information</h4>
				<form action="code/bookBusUserCode.php" method="POST">
					<input type="hidden" name="scNo" value="<?= $scNo ?>" />
					<input type="hidden" name="busNumber" value="<?= $scNumber?>" />
					<input type="hidden" name="depart_date" value="<?= $depart_date ?>" />
					<input type="hidden" name="depart_time" value="<?= $row['depTime'] ?>" />
				<?php if($_GET['searchT'] == 2){ ?>
					<input type="hidden" name="return_date" value="<?= $return_date ?>" />
					<input type="hidden" name="return_time" value="<?= $row['retTime'] ?>" />
				<?php } ?>
					<table class="table noborder">
						<thead><tr><th width="25%"></th><th></th></tr></thead>
						<tr><td>Bus Name</td><td><strong><?= $scName;?></strong>&nbsp;&nbsp;<span style="font-size: 13px">(<?= $scType ?>)</span></td></tr>
						<tr><td>Bus Number</td><td><strong><?= $scNumber;?></strong></td></tr>
						<tr><td>Seat Cost</td><td><strong><?= $seatCost;?>/=</strong></td></tr>
						<tr>
							<td>Departure Date</td>
							<td><strong><?= $depart_date ?></strong></td>
						</tr>
						<tr>
							<td>Departure Time</td>
							<td><strong><?= $depart_time; ?></strong></td>
						</tr>
						<tr>
							<td>Return Date</td>
							<td><strong><?= $return_date ?></strong></td>
						</tr>
						<tr>
							<td>Return Time</td>
							<td><strong><?= $return_time ?></strong></td>
						</tr>
						<tr>
							<td>Departure Location</td>
							<td><select readonly name="fromLoc"><option value="<?= $DepLoc ?>"><?= $depLoc['Name'] ?></option></select></td>
						</tr>
						<tr>
							<td>Destination Location</td>
							<td><select readonly name="toLoc"><option value="<?= $RechLoc ?>"><?= $rechLoc['Name'] ?></option></select></td>
						</tr>
					</table>
				</div>
				<div class="body-content well">
					<div class="module">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label><span>First Name </span></label>
									<input type="text" class="form-control" placeholder="First Name" name="first_name" required  />
								</div>
								<div class="form-group">
									<label><span>Last Name </span></label>
										<input type="text" class="form-control" placeholder="Last Name" name="last_name" required />
								</div>
								<div class="form-group">	
									<label><span>Email </span></label>
										<input type="email" class="form-control"  placeholder="Email" name="email" required />
								</div>
								<div class="form-group">
									<label><span>Phone Number </span></label>
									<input type="text" class="form-control"  placeholder="Phone Number" name="number" required />
								</div>
								<div class="form-group">		
									<label><span>Amount Of Seat</span></label>
									<input type="hidden" name="seatCost1" value="<?php echo $seatCost ;?> "/>
									<input type="hidden" name="seatamnt" value="0" required />
									<input type="hidden" id="seatnames" name="seatnames" value="" required />
									<input type="hidden" id="seatnamesdown" name="seatnames_down" value="" <?php if($_GET['searchT'] == 2) echo 'required'; ?> />
									<input type="number" class="form-control" id="seatamnt" name="seatamntA" value="0" required readonly />
								</div>
								<div class="form-group">
									<input type="submit" id="book" value="Book" name="book" class="btn btn-block btn-primary" <?php if($_GET['searchT'] == 2) echo'disabled'; ?>/></br>
								</div>
							</div>
							<div class="col-md-6">
								<div class="seats">
									<h4>Select Seat:</h4>
									<table class="table noborder seat-pattern up-selection" cellspacing="5">
										<tr>
											<td style="border-color: transparent;" class="gap"></td>
											<td colspan="2">E</td>
											<td style="border-color: transparent;" class="gap"></td>
											<td>D</td>
										</tr>
										<tr style="background-color: transparent;">
											<td colspan="5" class="gap">&nbsp;</td>
										</tr>
										<tr><td >A1</td><td>A2</td><td class="gap" width="15%">&nbsp;</td><td>A3</td><td>A4</td></tr>
										<tr><td>B1</td><td>B2</td><td class="gap">&nbsp;</td><td>B3</td><td>B4</td></tr>
										<tr><td>C1</td><td>C2</td><td class="gap">&nbsp;</td><td>C3</td><td>C4</td></tr>
										<tr><td>D1</td><td>D2</td><td class="gap">&nbsp;</td><td>D3</td><td>D4</td></tr>
										<tr><td>E1</td><td>E2</td><td class="gap">&nbsp;</td><td>E3</td><td>E4</td></tr>
										<tr><td>F1</td><td>F2</td><td class="gap">&nbsp;</td><td>F3</td><td>F4</td></tr>
										<tr><td>G1</td><td>G2</td><td class="gap">&nbsp;</td><td>G3</td><td>G4</td></tr>
										<tr><td>H1</td><td>H2</td><td class="gap">&nbsp;</td><td>H3</td><td>H4</td></tr>
										<tr><td>I1</td><td>I2</td><td class="gap">&nbsp;</td><td>I3</td><td>I4</td></tr>
										<tr><td>J1</td><td>J2</td><td class="gap">&nbsp;</td><td>J3</td><td>J4</td></tr>
									</table>
									<table class="table noborder seat-pattern down-selection" style="display:none; background-color: #ffd" cellspacing="5">
										<tr>
											<td style="border-color: transparent;" class="gap"></td>
											<td colspan="2">E</td>
											<td style="border-color: transparent;" class="gap"></td>
											<td>D</td>
										</tr>
										<tr style="background-color: transparent;">
											<td colspan="5" class="gap" style="border-color: transparent;">&nbsp;</td>
										</tr>
										<tr><td >A1</td><td>A2</td><td class="gap" width="15%">&nbsp;</td><td>A3</td><td>A4</td></tr>
										<tr><td>B1</td><td>B2</td><td class="gap">&nbsp;</td><td>B3</td><td>B4</td></tr>
										<tr><td>C1</td><td>C2</td><td class="gap">&nbsp;</td><td>C3</td><td>C4</td></tr>
										<tr><td>D1</td><td>D2</td><td class="gap">&nbsp;</td><td>D3</td><td>D4</td></tr>
										<tr><td>E1</td><td>E2</td><td class="gap">&nbsp;</td><td>E3</td><td>E4</td></tr>
										<tr><td>F1</td><td>F2</td><td class="gap">&nbsp;</td><td>F3</td><td>F4</td></tr>
										<tr><td>G1</td><td>G2</td><td class="gap">&nbsp;</td><td>G3</td><td>G4</td></tr>
										<tr><td>H1</td><td>H2</td><td class="gap">&nbsp;</td><td>H3</td><td>H4</td></tr>
										<tr><td>I1</td><td>I2</td><td class="gap">&nbsp;</td><td>I3</td><td>I4</td></tr>
										<tr><td>J1</td><td>J2</td><td class="gap">&nbsp;</td><td>J3</td><td>J4</td></tr>
									</table>
								<?php if($_GET['searchT'] == 2){ ?>
									<button type="button" id="down_sit" class="btn btn-warning">Select Sit For Return Booking</button>
								<?php } ?>	
									<p><strong>Total Seat: <span id="__ds_ts">0</span></strong></p>
									<p><strong>Total Cost: <span id="__ds_tc">0</span></strong></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<?php
			$result = $conn->query("SELECT seatNames, seatNamesDown FROM books WHERE scNumber ='{$scNumber}' AND depDate='{$row['depDate']}'");
			while($row = $result->fetch_assoc()) {$booked_seats[] = $row['seatNames']; $booked_seats_down[] = $row['seatNamesDown'];}
			?>
		<?php } ?>
		</div>
	</div>
</div>

<?php include 'footer.php';?>
</body>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/style.jqueary.min.js"></script>
<script src="js/ss.jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	seat_cost = <?= $seatCost ?>;
	one_way = <?= ($_GET['searchT'] == 2) ? 'false' : 'true'; ?>;
	selected_seat = 0;
	selected_seat_name = [];
	
	selected_seat_down = 0;
	selected_seatD_name = [];
	
	booked_seat = "<?= (isset($booked_seats) && !empty(array_filter($booked_seats))) ? implode(',', $booked_seats) : null ?>";
	booked_seat_array = (booked_seat != null && booked_seat != "") ? booked_seat.split(",") : [];
	
	booked_seat_down = "<?= (isset($booked_seats_down) && !empty(array_filter($booked_seats_down))) ? implode(',', $booked_seats_down) : null ?>";
	booked_seatD_array = (booked_seat_down != null && booked_seat_down != "") ? booked_seat_down.split(",") : [];
	
	$("#inf").hide();
	$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
	
	for($bsi=0; $bsi<booked_seat_array.length; $bsi++) {
		if(booked_seat_array[$bsi] == null || booked_seat_array[$bsi] == "") continue;
		$('.up-selection').find('td:contains("'+booked_seat_array[$bsi]+'")').addClass("booked");
	}
	
	for($bsid=0; $bsid<booked_seatD_array.length; $bsid++) {
		if(booked_seatD_array[$bsid] == null || booked_seatD_array[$bsid] == "") continue;
		$('.down-selection').find('td:contains("'+booked_seatD_array[$bsid]+'")').addClass("booked");
	}
	
	$(".seat-pattern").on('click', 'td', function(){
		if($(this).hasClass("gap") || $(this).hasClass("booked")) return false;
		$(this).toggleClass("selected");
		
		if($(this).closest("table").hasClass("up-selection")) {
			if($(this).hasClass("selected")) {
				selected_seat++;
				selected_seat_name.push($(this).text());
			} else {
				selected_seat--;
				index = selected_seat_name.indexOf($(this).text());
				if(index > -1) selected_seat_name.splice(index, 1);
			}
		} else {
			if($(this).hasClass("selected")) {
				selected_seat_down++;
				selected_seatD_name.push($(this).text());
			} else {
				selected_seat_down--;
				index = selected_seatD_name.indexOf($(this).text());
				if(index > -1) selected_seatD_name.splice(index, 1);
			}
		}
		
		if(one_way || (selected_seat != 0 && selected_seat == selected_seat_down)) $("#book").prop("disabled", false);
		else $("#book").prop("disabled", true);
			
		$("#seatamnt").val(selected_seat);
		$("#__ds_ts").text(selected_seat);
		$("#__ds_tc").text(selected_seat*seat_cost);
		$("#seatnames").val(selected_seat_name.join(','));
		$("#seatnamesdown").val(selected_seatD_name.join(','));
	});
	
	$("#down_sit").click(function(){
		if(selected_seat == 0) alert("Select Sit For Up Booking");
		else {
			if($(".down-selection").is(":hidden")) {
				$(".up-selection").hide();
				$(".down-selection").fadeIn();
				$("#down_sit").html("Select Sit For Up Booking");
			} else {
				$(".down-selection").hide();
				$(".up-selection").fadeIn();
				$("#down_sit").html("Select Sit For Return Booking");
			}
		}
	});
});
</script>
</html>