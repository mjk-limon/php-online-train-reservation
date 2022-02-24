<?php
	session_start();
	include 'connection.php';
	include"header.php";
?>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">
	<link rel="stylesheet" type="text/css" href="scss/letter.css">
	<link rel="stylesheet" type="text/css" href="./css/headercss.css">

<!Doctype html>
<html>
<title>Payment </title>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style type="text/css">
	table{
		border: 1px solid white;
	}
	tr{
		border: 1px solid white;
	}
	td, th{
		border: 1px solid white;
		padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 15px;
        padding-right: 15px;
	}

</style>
</head>

<body >
	<div style="height: 30px"></div>
	<center>
		<h3>
			<?php if(isset( $_GET['confirm'] )){
				echo $_GET['confirm'];
			}?>
		</h1>
        <h2>
            PNR Number =
            <?php if( $_GET['pnr'] ){
                echo $_GET['pnr'];
            }?>
        </h2>
	</center>
	<center>
		<h4>Please Do Payment Now</h4>
		<table>
			<tr>
				<td><p>1. BKash</p></td>
				<td><p>Send Your Payment To 01625424245<br>
						Now Submit Us The amount, Bkash number and transaction ID 
				</p></td>
			</tr>
			<tr>
				<td><p>2. DBBL</p></td>
				<td>
					<p>Send Your Payment To AC = 14710524158<br>
					Now SMS Us The Transaction ID, PNR<br>
					Format (Your_Name)(space)(Transaction ID)(space)(PNR) 
					</p>
				</td>
			</tr>
			<tr>
				<td><p>3. BRAC Bank</p></td>
				<td>
					<p>Send Your Payment To AC = 14725484158<br>
					Now SMS Us The Transaction ID, PNR<br>
					Format (Your_Name)(space)(Transaction ID)(space)(PNR)</p>
				</td>
			</tr>
		</table>
	</center>
</body>
<?php include 'footer.php';?>
</html>
