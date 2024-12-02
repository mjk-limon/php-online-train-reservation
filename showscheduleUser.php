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
					<label>Bus Name</label>
				</th>
				<th>
					<label>Bus Number</label>
				</th>
				<th>
					<label>Bus Type</label>
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
				<th>
					<label>Coach Type</label>
				</th>
			</tr>
			<?php     
			$sql ="SELECT `schedule`.`fromLoc`, `schedule`.`toLoc`,`schedule`.`scName`, `schedule`.`scNumber`, `schedule`.`scType`, `schedule`.`seatCost`, `schedule`.`cType`, ";
			$sql.="`location`.`Name` as `loc`, `schedule`.`depDate` , `retlocation`.`Name` as `retloc`, ";
			$sql.="`schedule`.`retDate`, `schedule`.`retTime`, `schedule`.`depTime` FROM `sas`.`schedule` ";
			$sql.="INNER JOIN `location` ON `schedule`.`fromLoc` = `location`.`id` INNER JOIN `retlocation` ON `schedule`.`toLoc` = `retlocation`.`id`";
			
			$result=  mysqli_query($conn, $sql);
			$sl = 1;
			if(mysqli_num_rows($result)){
					while ($row=mysqli_fetch_assoc($result)){
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
											<?php echo ($row['scType'] == 1) ? 'A/C': 'Non A/C';?>
									</td>
									<td>
											<?php echo $row['seatCost'];?>/=
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
									<td>
										<?= ($row['cType']==1) ? 'Bus' : 'Train';?>
									</td>
                </tr>
                <?php                                      
                        }
                    }
                ?>
		</table>
	</center>


<body>

</body>
</html>