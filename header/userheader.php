<?php
if(!isset($_SESSION['username'])){
  header('Location: login.php');
}
?>
<?php date_default_timezone_set('Asia/Dhaka'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Online Ticket Booking</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">
	<link rel="stylesheet" type="text/css" href="scss/letter.css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">
	<style type="text/css">
		.container {
			background-color: #fff;
			box-shadow: 0px 0px 15px 2px #333;
			min-height: 100vh;
		}
		.mar {
			margin-top: 50px;
		}
		.wlcmAdmin, .wlcmtime, .wlcmdate {
			color: #34495e;
			font-size: 30px;
			text-align: center;
			text-shadow: 0 0 2px black;
		}
		.wlcmtime, .wlcmdate {text-shadow: none;font-size:17px}
		.nnn {
			display: block;
			color: #34495e;
			text-align: center;
			padding: 5px 5px;
			text-decoration: none;
			background-color: #F9F9FA;
			border: 1px solid;
			border-radius: 10px;
		}
	</style>
</head>
<body style="background-color: #34495e;">
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="z-index:99">
				<ul class="menu cf">
					<li><a href="./user.php">Home</a></li>
					<li><a href="./showscheduleUser.php">Schedule</a></li>
					<li>
						<a href="#">Buses</a>
						<ul class="submenu">
							<li><a href="./search_bus.php">Search Bus</a></li>
							<li><a href="./confirmationUser.php">Find Reservation</a></li>
						</ul>     
					</li>
					
					<li><a href="logout.php">Sign Out<?php if(isset($_SESSION['username']))echo " ".$_SESSION['username']?></a></li>
				</ul>
			</div>
		</div>
	<?php if(isset($_GET['msg'])){ ?>
	<div class="alert alert-danger"><?= $_GET['msg'] ?></div>
	<?php } ?>