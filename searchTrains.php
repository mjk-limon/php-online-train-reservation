<?php
$avail = -1;
session_start();
include 'connection.php';
include 'header/userheader.php';
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 figure-box">
<?php
	if(isset($_GET['searchTwo']) || isset($_GET['searchOne'])) {
		if(isset($_GET['searchTwo'])) {
			$DepLoc = $_GET['DepLoc'];
			$RechLoc = $_GET['RechLoc'];
			$depart_date = $_GET['depart_date'];
			$return_date = $_GET['return_date'];
			$depart_time; $return_time; $scNumber; $totalSeat;
			$sql ="SELECT * FROM `sas`.`schedule` ";
			$sql.="WHERE `depDate` = '$depart_date' AND `retDate` = '$return_date' ";
			$sql.="AND `fromLoc` = '$DepLoc' AND `toLoc` = '$RechLoc'";
			$sql.="AND `cType` = '2' ORDER BY `id`";
			$result=  mysqli_query($conn, $sql);
		} else if (isset($_GET['searchOne'])) {
			$DepLoc = $_GET['DepLoc'];
			$RechLoc = $_GET['RechLoc'];
			$depart_date = $_GET['depart_date'];
			$sql = "SELECT * FROM `sas`.`schedule` ";
			$sql.= "WHERE (`depDate` = '$depart_date' OR `retDate` = '$depart_date') AND ";
			$sql.= "(`fromLoc` = '$DepLoc' OR `toLoc` = '$DepLoc') ";
			$sql.= "AND (`toLoc` = '$RechLoc' OR `fromLoc` = '$RechLoc') ";
			$sql.="AND `cType` = '2' ORDER BY `id`";
			$result=  mysqli_query($conn, $sql);
		}
		if(mysqli_num_rows($result)){ 
?>
		<h4 class="text-center">Your Trip Trains's Total <strong><?= mysqli_num_rows($result) ?></strong> Train Found</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Train Info</th>
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
					$seatCost = isset($_GET['searchTwo']) ? $row['seatCost']*2 : $row['seatCost'];
					$totalSeat = $row['seat'];
			?>
				<tr>
					<td><?= $scName ?></td>
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
		<center><h1>Sorry To Inform You That<br> We Do Not Have Trains That <br>Meet Your Requirements</h1></center>
	<?php } ?>
<?php
	} else if(isset($_GET['scNo'])) {
		$scNo = $conn->real_escape_string($_GET['scNo']);
		$row = $conn->query("SELECT * FROM schedule WHERE id='{$scNo}' LIMIT 1")->fetch_assoc();
		$DepLoc = $row['fromLoc'];
		$RechLoc = $row['toLoc'];
		$depart_date = date("F j, Y", strtotime($row['depDate']));
		$depart_time = date('h:i (A)', strtotime($row['depTime']));
		$return_date =  ($_GET['searchT'] == 2) ? date("F j, Y", strtotime($row['retDate'])) : '-';
		$return_time = ($_GET['searchT'] == 2) ? date('h:i (A)', strtotime($row['retTime'])) : '-';
		$scName = $row['scName'];
		$scNumber = $row['scNumber'];
		$seatCost = ($_GET['searchT'] == 2) ? $row['seatCost']*2 : $row['seatCost'];
		$totalSeat = $row['seat'];
?>
		<h4 class="text-center">Your Trip Train's Total <strong><?php echo $totalSeat?></strong> Seats Is Available</h4>
		<h4>You Requested A Train Of Following Information</h4>
		<form action="code/bookTrainUserCode.php" method="POST">
			<input type="hidden" name="scNo" value="<?= $scNo ?>" />
			<input type="hidden" name="TrainNumber" value="<?= $scNumber?>" />
			<input type="hidden" name="depart_date" value="<?= $depart_date ?>" />
			<input type="hidden" name="depart_time" value="<?= $row['depTime'] ?>" />
		<?php if($_GET['searchT'] == 2){ ?>
			<input type="hidden" name="return_date" value="<?= $return_date ?>" />
			<input type="hidden" name="return_time" value="<?= $row['retTime'] ?>" />
		<?php } ?>
			<table class="table noborder">
				<thead><tr><th width="25%"></th><th></th></tr></thead>
				<tr><td>Train Name</td><td><strong><?= $scName;?></strong></td></tr>
				<tr><td>Train Number</td><td><strong><?= $scNumber;?></strong></td></tr>
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
				<?php
				$depLoc = $conn->query("SELECT * FROM location WHERE id='{$DepLoc}' LIMIT 1 OFFSET 0")->fetch_array();
				$rechLoc = $conn->query("SELECT * FROM retlocation WHERE id='{$RechLoc}' LIMIT 1 OFFSET 0")->fetch_array();
				?>
					<td><select readonly name="fromLoc"><option value="<?= $DepLoc ?>"><?= $depLoc['Name'] ?></option></select></td>
				</tr>
				<tr>
					<td>Destination Location</td>
					<td><select readonly name="toLoc"><option value="<?= $RechLoc ?>"><?= $rechLoc['Name'] ?></option></select></td>
				</tr>
			</table>
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
								<input type="hidden" name="seatamnt" value="0"/>
								<input type="hidden" id="seatnames" name="seatnames" value="" required />
								<input type="number" class="form-control" id="seatamnt" name="seatamntA" value="0" required readonly />
							</div>
							<div class="form-group">
								<input type="submit" id="book" value="Book" name="book" class="btn btn-block btn-primary" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="seats">
								<h4>Select Seat:</h4>
								<table class="table noborder seat-pattern">
								<?php
									$cabinNames = array("SHOVON SADHARON","SHOVON","ECONOMY","A/C CHAIR","A/C SLEEPER");
									for($seati=1; $seati<=250; $seati=$seati+5){
									if($seati == 1 || ($seati-1)%50 == 0){
								?>
									<tr><td colspan="6" class="gap"><h4><?= array_shift($cabinNames) ?><h4></td></tr>
								<?php } ?>
									<tr>
										<td><?= sprintf("%03d", $seati) ?></td>
										<td><?= sprintf("%03d", $seati+1) ?></td>
										<td class="gap" width="15%">&nbsp;</td>
										<td><?= sprintf("%03d", $seati+2) ?></td>
										<td><?= sprintf("%03d", $seati+3) ?></td>
										<td><?= sprintf("%03d", $seati+4) ?></td>
									</tr>
								<?php } ?>
								</table>
								<p><strong>Total Seat: <span id="__ds_ts">0</span></strong></p>
								<p><strong>Total Cost: <span id="__ds_tc">0</span></strong></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php
		$result = $conn->query("SELECT seatNames FROM books WHERE scNumber ='{$scNumber}' AND depDate='{$row['depDate']}'");
		while($row = $result->fetch_assoc()) {$booked_seats[] = $row['seatNames'];}
		?>
	<?php } ?>
	</div>
</div>
<?php include 'footer.php';?>
</body>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	avg_seat_cost = <?= $seatCost ?>;
	selected_seat = 0;
	selected_seat_name = [];
	total_cost = 0;
	booked_seat = "<?= (isset($booked_seats) && !empty(array_filter($booked_seats))) ? implode(',', $booked_seats) : null ?>";
	booked_seat_array = (booked_seat != null && booked_seat != "") ? booked_seat.split(",") : [];
	$("#inf").hide();
	$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
	for($bsi=0; $bsi<booked_seat_array.length; $bsi++) {
		if(booked_seat_array[$bsi] == null || booked_seat_array[$bsi] == "") continue;
		$('td:contains("'+booked_seat_array[$bsi]+'")').addClass("booked");
	}
	$(".seat-pattern").on('click', 'td', function(){
		if($(this).hasClass("gap") || $(this).hasClass("booked")) return false;
		$(this).toggleClass("selected");
		
		var seat_number = parseInt($(this).text());
		if(seat_number <= 50) seat_cost = avg_seat_cost;
		else if(seat_number > 50 & seat_number <= 100) seat_cost = parseInt(avg_seat_cost+(avg_seat_cost*.2));
		else if(seat_number > 100 & seat_number <= 150) seat_cost = parseInt(avg_seat_cost+(avg_seat_cost*.4));
		else if(seat_number > 150 & seat_number <= 200) seat_cost = parseInt(avg_seat_cost+(avg_seat_cost*.6));
		else if(seat_number > 200 & seat_number <= 250) seat_cost = parseInt(avg_seat_cost+(avg_seat_cost*.8));

		if($(this).hasClass("selected")) {
			selected_seat++;
			selected_seat_name.push($(this).text());
			total_cost += seat_cost; 
		} else {
			selected_seat--;
			index = selected_seat_name.indexOf($(this).text());
			if(index > -1) selected_seat_name.splice(index, 1);
			total_cost -= seat_cost; 
		}		
		$("#seatamnt").val(selected_seat);
		$("#__ds_ts").text(selected_seat);
		$("#__ds_tc").text(total_cost);
		$("#seatnames").val(selected_seat_name.join(','));
	});
});
</script>

</html>