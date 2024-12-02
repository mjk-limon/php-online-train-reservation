<?php include 'header/headerAdmin.php'; ?>
<?php
	class BasicDB {
		public function UpdateTable($table,$fields,$condition) {
			global $conn;
			$sql = "UPDATE {$table} SET ";
			foreach($fields as $key => $value) { 
				$fields[$key] = " {$key} = '{$value}' ";
			}
			$sql .= implode(" , ",array_values($fields))." WHERE ".$condition.";";  
			return $sql;
		}
		public function DeleteTable($tablename, $condition) {
			$sql = "DELETE FROM {$tablename} ";
			$sql.= "WHERE {$condition}" ;
			return $sql;
		}
	}
	$ob1 = new BasicDB;
	if(isset($_POST['update-schedule'])) {
		$scId = $conn->real_escape_string($_POST['scId']);
		$fields['scName'] = $conn->real_escape_string($_POST['scName']);
		$fields['scNumber'] = $conn->real_escape_string($_POST['scNumber']);
		$fields['scType'] = $conn->real_escape_string($_POST['scType']);
		$fields['fromLoc'] = $conn->real_escape_string($_POST['fromLoc']);
		$fields['toLoc'] = $conn->real_escape_string($_POST['toLoc']);
		$fields['depDate'] = $conn->real_escape_string(date("Y-m-d", strtotime($_POST['depDate'])));
		$fields['depTime'] = $conn->real_escape_string(date("H:i:s", strtotime($_POST['depTime'])));
		$fields['retDate'] = $conn->real_escape_string(date("Y-m-d", strtotime($_POST['retDate'])));
		$fields['retTime'] = $conn->real_escape_string(date("H:i:s", strtotime($_POST['retTime'])));
		$fields['seatCost'] = $conn->real_escape_string($_POST['seatCost']);
		$sql =  $ob1->UpdateTable("schedule", $fields, "id='{$scId}'");
		if($conn->query($sql) == true) echo "<script>alert('Successfully updated data')</script>";
		else echo "<script>alert('".$conn->error."')</script>";
	}
?>


<?php if(!isset($_GET['update-id'])){ ?>
	<center style="background: #fff; padding: 1.5em" id="main">
		<h1>Schedule List</h1>
		<table  class="adnmin-tabil">
			<tr>
				<th><label>Serial</label></th>
				<th><label>Bus Name</label></th>
				<th><label>Bus Number</label></th>
				<th><label>Type</label></th>
				<th><label>Cost</label></th>
				<th><label>Departure Location</label></th>
				<th><label>Destination Location</label></th>
				<th><label>Departure Date</label></th>
				<th><label>Departure Time</label></th>
				<th><label>Return Date</label></th>
				<th><label>Return Time</label></th>
				<th><label>Coach Type</label></th>
				<th><label>Action</label></th>
			</tr>
		<?php
			$sql = "SELECT `schedule`.`id`,`schedule`.`fromLoc`, `schedule`.`toLoc`,`schedule`.`scName`, `schedule`.`scNumber`, `schedule`.`scType`, `location`.`Name` as `loc`, `schedule`.`depDate`, `schedule`.`cType`, `schedule`.`seatCost`,";
			$sql.="`retlocation`.`Name` as `retloc`, `schedule`.`retDate`, `schedule`.`retTime`, `schedule`.`depTime` FROM `sas`.`schedule` INNER JOIN `location` ON `schedule`.`fromLoc` = `location`.`id` INNER JOIN `retlocation` ON `schedule`.`toLoc` = `retlocation`.`id`";
			
			$result=  mysqli_query($conn, $sql);
			$sl = 1;
			if(mysqli_num_rows($result)){
				while ($row=mysqli_fetch_assoc($result)){
					switch($row['scType']) {
						case 1: $scType = 'A/C'; break;
						case 2: $scType = 'Non A/C'; break;
						default: $scType = 'Data Error !'; exit;
					}
		?>
			<tr>
				<td><?php echo $sl++;?></td>
				<td><?php echo $row['scName'];?></td>
				<td><?php echo $row['scNumber'];?></td>
				<td><?php echo $scType;?></td>
				<td><?php echo $row['seatCost'];?></td>
				<td><?php echo $row['loc'];?></td>
				<td><?php echo $row['retloc'];?></td>
				<td><?php echo $row['depDate'];?></td>
				<td><?php echo date("h:iA", strtotime($row['depTime']));?></td>
				<td><?php echo $row['retDate'];?></td>
				<td><?php echo !empty($row['retTime']) ? date("h:iA", strtotime($row['retTime'])) : null; ?></td>
				<td><?= ($row['cType']==1) ? 'Bus' : 'Train';?></td>
				<td class="hideforpdf">
					<a href="?update-id=<?php echo $row['id'];?>">Update</a>/
					<a href="deleteShcedule.php?id=<?php echo $row['id'];?>">Delete</a>
				</td>
			</tr>
	<?php }} ?>
		</table>
	</center>
<?php
	} else {
		$scInfo = $conn->query("SELECT * FROM schedule WHERE id='{$_GET['update-id']}' LIMIT 1")->fetch_assoc();
?>
	<div class="container">
		<h1 class="text-center">Update Schedule</h1>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 well">
				<form id="" action="" method="post">
					<input type="hidden" name="update-schedule" />
					<input type="hidden" name="scId" value="<?= $_GET['update-id'] ?>" />
					<div class="form-group">
						<label>Bus Name</label>
						<input type="text" name="scName" class="form-control" value="<?= $scInfo['scName'] ?>" />
					</div>
					<div class="form-group">
						<label>Bus Number</label>
						<input type="text" name="scNumber" class="form-control" value="<?= $scInfo['scNumber'] ?>" />
					</div>
					<div class="form-group">
						<label>Bus Type</label>
						<select name="scType" class="form-control">
							<option value="1" <?php if($scInfo['scType'] == 1) echo 'selected'; ?>>A/C</option>
							<option value="2" <?php if($scInfo['scType'] == 2) echo 'selected'; ?>>Non A/C</option>
						</select>
					</div>
					<div class="form-group">
						<label>Seat Cost</label>
						<input type="text" name="seatCost" class="form-control" value="<?= $scInfo['seatCost'] ?>" />
					</div>
					<div class="form-group">
						<label>Departure Location</label>
						<select name="fromLoc" class="form-control">
						<?php
							$sql="SELECT * FROM `sas`.`location` ORDER BY `Name`";
							$result=  mysqli_query($conn, $sql);
							if(mysqli_num_rows($result)){
							while ($row=mysqli_fetch_assoc($result)){
						?>
							<option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $scInfo['fromLoc']) echo "selected"; ?>><?php echo$row['Name']; ?></option>
						<?php                                      
									}
							}
							
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Destination Location</label>
						<select name="toLoc" class="form-control">
						<?php  
							$sql="SELECT * FROM `sas`.`retlocation` ORDER BY `Name`";
							$result=  mysqli_query($conn, $sql);
							if(mysqli_num_rows($result)){
								while($row=mysqli_fetch_assoc($result)){
						?>
							<option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $scInfo['toLoc']) echo "selected"; ?>><?php echo$row['Name']; ?></option>
						<?php                                      
								}
							}
							
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Departure Date</label>
						<input type="date" name="depDate" class="form-control" value="<?= $scInfo['depDate'] ?>" />
					</div>
					<div class="form-group">
						<label>Departure Time</label>
						<input type="time" name="depTime" class="form-control" value="<?= $scInfo['depTime'] ?>" />
					</div>
					<div class="form-group">
						<label>Return Date</label>
						<input type="date" name="retDate" class="form-control" value="<?= $scInfo['retDate'] ?>" />
					</div>
					<div class="form-group">
						<label>Return Time</label>
						<input type="time" name="retTime" class="form-control" value="<?= $scInfo['retTime'] ?>" />
					</div>
					<input type="submit" value="Update" class="btn btn-success" />
				</form>
			</div>
		</div>
	</div>
<?php } ?>
<body>

</body>
</html>