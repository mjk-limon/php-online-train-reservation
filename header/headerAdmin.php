	
<?php
include"db.php";
?>
<?php
include 'connection.php';
session_start();
if(!isset($_SESSION['adminname'])){
  header('Location: login.php');
}
?>

<html>
	<head>
		<title> Online Train Reservation</title>
		<link rel="stylesheet" type ="text/css" href="./css/home.css">		
		<link href="./css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="./css/jquery-ui.css">

	<link rel="stylesheet" type="text/css" href="././css/headercss.css">
	<link rel="stylesheet" type="text/css" href="./scss/letter.css">
	<link rel="stylesheet" type="text/css" href="././css/headercss.css">
	 <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
		
		<script src="./js/jquery-3.4.1.min.js"></script>
		<script src="./js/bootstrap.js"></script>		
		<script src="./js/clock.js"></script>
		<script src="./js/custom.js"></script>
		<script src="./js/index.js"></script>
		<script src="./js/jquery.easing.min.js"></script>
		<script src="./js/jquery.scrollTo.js"></script>
		<script src="./js/script.js"></script>
		<script src="./js/ss.jquery-ui.min.js"></script>
		<script src="./js/wow.min.js"></script>
		<script src="./js/jquery.cycle.all.js"></script>
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
	
	
	</head>
	
	
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-4 col-12">
				<img src="./image/logo.png" alt="logo" class="logo" >
			</div>
			<div class="col-md-4 col-sm-4 col-12">
				<h1 class="font"> Online Train Reservation </h1>
			</div>
			<div class="col-md-6 col-sm-4 col-12">			
				<div class="top-links ">	
					<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
					<li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
					<li><a href="https://accounts.google.com"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="https://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
					<li><a href="https://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
					<li><a href="https://www.tumblr.com"><i class="fa fa-tumblr"></i></a></li>
				</div>
					
				</div>
			</div>
			
		
	</div>
	</div>

	<div class="menu">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-12">
					<ul>  
						<li><a href="./adminpage.php">Home</a></li>
						<li class="dropdown12">
							<a href="">Train</a>
							<ul class="submenu12">
								<li><a href="./scheduletrain.php">Add Route</a></li>
								<li><a href="./showschedule.php">Show Schedule</a></li>
							</ul>     
						</li>
						
						<li><a href="./userList.php">User</a></li>
						<li>
							<a href="./confirmationAdmin.php">Confirmation</a>    
						</li>
						<li>
							<a href="./confirmationPayment.php">Payments</a>    
						</li>
						<li><a href="logout.php">Sign Out<?php if(isset($_SESSION['adminname']))echo " ".$_SESSION['adminname']?></a></li>
					</ul>
					
				</div>				
			</div>
		</div>	
	</div>