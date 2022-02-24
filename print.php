<?php 
session_start();
if (isset($_GET['pnr'])) {
	include 'connection.php';
	$pnr = $_GET['pnr'];
	$sql="SELECT * FROM `reset`.`books` WHERE `pnr` = '$pnr' ORDER BY `id`";    
    $result=  mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
    	$row=mysqli_fetch_assoc($result);
    }else{
    	header("Location: confirmationUser.php?msg=Problem Printing Ticket");
    }
} else{
	header("Location: confirmationUser.php");
}
class BasicDB {
	public function get_single_index_data($tablename, $condition, $index) {
		global $conn;
		$get = "SELECT * FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row[$index];
	}
}
$ob1 = new BasicDB;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reservation Panel</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type ="text/css" href="css/home.css">
</head>
<body>
	<div id="main" style="width:60%;margin:10px auto;padding:20px;">
		
		<center>
			<table class="table table-bordered">

				
				<tr><h4>Your Ticket Has Been Issued<br>By The Username <?php echo $row['user'] . " in ". $row['dob'] ?></h4></tr>
				<tr>
					<td>
						<label>Name : </label>
						<label><?php echo $row['fname']." ".$row['lname'] ?></label>
					</td>
				</tr>
				<tr>
					<td>
						<p>Email : <?php echo $row['email'] ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Transport Name : <?= $ob1->get_single_index_data("schedule", "scNumber='{$row['scNumber']}' AND depDate='{$row['depDate']}'", "scName") ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Transport Type : <?= ($ob1->get_single_index_data("schedule", "scNumber='{$row['scNumber']}' AND depDate='{$row['depDate']}'", "scType") == 1) ? 'A/C' : 'Non A/C'; ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Transport No. : <?php echo $row['scNumber'] ?></p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p>PNR : <?php echo $row['pnr'] ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Seat (Up) : <?php echo $row['seatNames']; ?> <br>
			               Seat (Down): <?php if(!empty($row['seatNamesDown'])) echo $row['seatNamesDown']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Date Of Booking : <?php echo $row['dob'] ?></p>
					</td>
				</tr>
				<?php 
					$ll = $row['dest'];
					$sql="SELECT * FROM `reset`.`retlocation` WHERE `id` = '$ll' ";    
				    $result1=  mysqli_query($conn, $sql);
				    if(mysqli_num_rows($result1)>0){
				    	$row1=mysqli_fetch_assoc($result1);
				    }
				?>
				<tr>
					<td>
						<p>To: <?php echo $row1['Name'] ?></p>
					</td>
				</tr>
				<?php 
					$ll2 = $row['depart'];
					$sql="SELECT * FROM `reset`.`location` WHERE `id` = '$ll2' ";    
				    $result2=  mysqli_query($conn, $sql);
				    if(mysqli_num_rows($result2)>0){
				    	$row2=mysqli_fetch_assoc($result2);
				    }
				?>
				<tr>
					<td>
						<p>From: <?php echo $row2['Name'] ?></p>
					</td>
				</tr>
			</table>
			<table style="margin-top: 10px;">
				<tr>
					<td>
						<p>Date Of Departure : <?php echo date("m/d/y", strtotime($row['depDate']));?></p>
					</td>
					<td>
						<p>Time Of Departure : <?php echo date("h:iA", strtotime($row['depTime'])); ?></p>
					</td>
				</tr>
			<?php if(!empty($row['retDate'])){ ?>
				<tr>
					<td>
						<p>Date Of Return : <?php echo date("m/d/y", strtotime($row['retDate'])); ?></p>
					</td>
					<td>
						<p>Time Of Return : <?php echo date("h:iA", strtotime($row['retTime'])); ?></p>
					</td>
				</tr>
			<?php } ?>
			</table>
			<table style="margin-top: 10px;">
				<tr>
					<td>
						<p>Amount : <?php echo $row['amount'] ?></p>
					</td>
				</tr>
			</table>

		</center>
	</div>
	<center><button style="padding: 10px; padding-left: 20px; padding-right: 20px;" onclick="prnt()">Print</button></center>
	




	<script>
			function prnt(){
				var div="<html><head><style> .hideforpdf{display: none;}td{text-align:center;}table{border: 1px solid black;float: center;}table tr{border: 1px solid black;}table tr td{border: 1px solid black;}table tr th{border: 1px solid black;}</style></head><body>"
				div+=document.getElementById('main').innerHTML;
				div+="</body></html>"
				var win=window.open("", "", "width=960,height=500");
				win.document.write("<center><h1>Online Train Reservation</h1></center><br><br>");
				win.document.write("<center><h2> Passenger Ticket</h2></center><br><br>");
				win.document.write(div);
				win.document.write("<br><br><center><p>&copy All Rights Reserved By Ik Sajib</p></center>");
				win.print();
			}
	</script>

</body>
</html>