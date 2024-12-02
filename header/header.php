<?php
include 'connection.php';
session_start();
if(isset($_SESSION['adminname'])){
  header('Location: adminpage.php');
}else if (isset($_SESSION['username'])) {
  header('Location: user.php');
}
?>
	<div class="container">
		<ul class="menu cf">
			<li><a href="">Home</a></li>
			<li>
				<a href="">Ticket</a>
				<ul class="submenu">
					<li><a href="">Sub</a></li>
					<li><a href="">Sub</a></li>
					<li><a href="">Sub</a></li>
					<li><a href="">Sub</a></li>
					<li><a href="">Sub</a></li>
				</ul>			
			</li>
			<li><a href="">Schedule</a></li>
			<li><a href="">About</a></li>
			<li><a href="">Contact</a></li>
		</ul>
		<?php if(isset($_GET['msg'])){ ?>
			<div class="alert alert-danger"><?= $_GET['msg'] ?></div>
		<?php } ?>