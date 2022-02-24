<!DOCTYPE html>
<html>
<head>
	<title>Schedule Traines</title>
	<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/form.css" type="text/css">

</head>
	<?php include 'header/headerAdmin.php'; ?>
	<center>
		<h1>Train Route Schedule</h1>
		<div class="maintext">
			<div id="flights" class="allfromgroove">
				<form action="code/showscheduleCode.php" method="post">
					<input type="hidden" name="ctype" value="1" />
					<div class="all-infut">
						<input type="text" name="TrainName" placeholder="Train Name" required="">
					</div>
					<div class="all-infut">
						<input type="text" name="TrainNumber" placeholder="Train Number" required="">
					</div>
					<input type="hidden" name="sctype" value="" />
					<!--div class="all-infut">
						<label class="ftext">Train Type</label>
						<select name="sctype" required>
							<option value="1">A/C</option>
							<option value="2">Non A/C</option>
						</select>
					</div-->
					<div class="all-infut" style="display: inline-block; width: 95%;">
						<div class="falf-infut">	
							<select id="cmbMake" name="fromLoc" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
									<option value="0" disabled="disabled" selected="selected" id="place">Leaving from...</option>
									<?php
										$sql="SELECT * FROM `reset`.`location` ORDER BY `Name`";
										$result=  mysqli_query($conn, $sql);
										if(mysqli_num_rows($result)){
												while ($row=mysqli_fetch_assoc($result)){
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
							<select id="cmbMake" name="toLoc" onchange="document.getElementById('selected_text1').value=this.options[this.selectedIndex].text">
									<option value="0" disabled="disabled" selected="selected" id="place">Going to...</option>
									<?php
										
										$sql="SELECT * FROM `reset`.`retlocation` ORDER BY `Name`";
										$result=  mysqli_query($conn, $sql);
										if(mysqli_num_rows($result)){
												while ($row=mysqli_fetch_assoc($result)){
								?>
									<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
									<?php                                      
												}
										}
										mysqli_close();
								?>
							</select>
						</div>
					</div>
					<div class="all-infut">
						<label id="label0" class="ftext">Depart Date:</label>
						<input type="text" id="datepicker1" name="depart_date"/>
					</div>
					<div class="all-infut">
						<label id="label0" class="ftext">Depart Time:</label>
						<input type="Time" required="" name="depart_time" />
					</div>
					<div class="all-infut">
						<label id="label1" class="ftext" >Return Date:</label>
						<input type="text" id="datepicker" name="return_date" />
					</div>
					<div class="all-infut">
						<label id="label0" class="ftext">Return Time:</label>
						<input type="Time" name="return_time" />
					</div>
					<input type="hidden" name="seat" value="240" />			
					<div class="all-infut" style="width: 90%; margin: 0 auto; color: #fff">
						<table class="table table-bordered">
							<thead><tr><th>Type</th><th>Seat Cost</th></tr></thead>
							<tbody>
								<tr>
									<td>Shovon_s</td>
									<td><input type="text" name="scost[]" required /></td>
								</tr>
								<tr>
									<td>Shovon_ac</td>
									<td><input type="text" name="scost[]" required /></td>
								</tr>
								<tr>
									<td>Cabin Berth</td>
									<td><input type="text" name="scost[]" required /></td>
								</tr>
								<tr>
									<td>Cabin Berth A/C</td>
									<td><input type="text" name="scost[]" required /></td>
								</tr>
							</tbody>
						</table>
					</div>
					<p class="ftext" id="dateIn"></p>
					<div class="all-infut-login-btn">
						<input  class="search" type="submit" name="search" id="find" value="Fixed Schedule"/>
					</div>
				</form>
			</div>
		</div>
	</center>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="js/style.jqueary.min.js"></script>
<script src="js/ss.jquery-ui.min.js"></script>
<body>
  <script>
  $(document).ready(function() {
		$("#datepicker1").datepicker({minDate: 1, dateFormat: 'yy/mm/dd' });
		$("#datepicker").datepicker({minDate: 1, dateFormat: 'yy/mm/dd' });
  });

$(document).ready(function () {
    var selector = function (dateStr) {
            var d1 = $('#datepicker').datepicker('getDate');
            var d2 = $('#datepicker1').datepicker('getDate');
            var diff = 0;
                diff = Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
            if (diff>0) {
            	$('#dateIn').show();
            	$('#dateIn').text("Return Date Is Behind");
            	$('#find').hide();
            } else if(diff<=0){
            	$('#find').show();
            	$('#dateIn').hide();
            }
        }
    $('#datepicker, #datepicker1').change(selector)
});

  </script>
</body>
</html>