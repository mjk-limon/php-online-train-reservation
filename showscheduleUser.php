<?php

	include 'connection.php';
	include 'header.php';
?>


	<center>
		<h1>Schedule List</h1>
		<table class="adnmin-tabil">
			<tr>
				<th>
					<label>Serial</label>
				</th>
				<th>
					<label>Train Name</label>
				</th>
				<th>
					<label>Train Number</label>
				</th>
				<th>
					<label>Cost</label>
				</th>
				<th>
					<label>Departure Location</label>
				</th>
				<th>
					<label>Destination Location</label>
				</th>
				<th>
					<label>Departure Date &amp; Time</label>
				</th>
				<th>
					<label>Return Date &amp; Time</label>
				</th>
				
			</tr>
			<?php     
			$sql ="SELECT `schedule`.`fromLoc`, `schedule`.`toLoc`,`schedule`.`scName`, `schedule`.`scNumber`, `schedule`.`scType`, `schedule`.`seatCost`, `schedule`.`cType`, ";
			$sql.="`location`.`Name` as `loc`, `schedule`.`depDate` , `retlocation`.`Name` as `retloc`, ";
			$sql.="`schedule`.`retDate`, `schedule`.`retTime`, `schedule`.`depTime` FROM `reset`.`schedule` ";
			$sql.="INNER JOIN `location` ON `schedule`.`fromLoc` = `location`.`id` INNER JOIN `retlocation` ON `schedule`.`toLoc` = `retlocation`.`id`";
			
			$result=  mysqli_query($conn, $sql);
			$sl = 1;
			if(mysqli_num_rows($result)){
					while ($row=mysqli_fetch_assoc($result)){
						$sCst = explode(',', $row['seatCost']);
			?>
                <tr>
                	<td>
											<?php echo $sl++;?>
									</td>
									<td>
											<?php echo $row['scName'];?>
									</td>
									<td>
											<?php echo $row['scNumber'];?>
									</td>
									<td>
										<table class="table">
											<tbody>
												<tr>
													<td>Shovon_c</td>
													<td><?= $sCst[0] ?>/=</td>
												</tr>
												<tr>
													<td>Shovon_ac</td>
													<td><?= $sCst[1] ?>/=</td>
												</tr>
												<tr>
													<td>Cabin Berth</td>
													<td><?= $sCst[2] ?>/=</td>
												</tr>
												<tr>
													<td>Cabin Berth A/C</td>
													<td><?= $sCst[3] ?>/=</td>
												</tr>
											</tbody>
										</table>
									</td>
									<td>
											<?php echo $row['loc'];?>
									</td>
									<td>
										<?php echo $row['retloc'];?>
									</td>
									<td>
											<?= date("F j, Y h:i(A)", strtotime($row['depDate'].$row['depTime'])); ?>
									</td>
									<td>
											<?= !empty($row['retDate']) ? date("F j, Y h:i(A)", strtotime($row['retDate'].$row['retTime'])) : "-"; ?>
									</td>
									
                </tr>
                <?php                                      
                        }
                    }
                ?>
		</table>
	</center>
	<br><br><br>
<?php include"footer.php";?>

