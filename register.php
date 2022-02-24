<?php  
include"header.php";
?>
	<div class="login-forms" style="width:40%">
		<form action="code/regCode.php" method="post">
			<h2>Register</h2>
			 <div>
				<label for="Name" class="floatLabel">First Name</label>
				<input id="fname" name="fname" type="text" required="">
			</div>
			<div>
				<label for="Name" class="floatLabel">Last Name</label>
				<input id="lname" name="lname" type="text" required="">
			</div>
			<div>
				<label for="Name" class="floatLabel">Username</label>
				<input id="uname" name="uname" type="text" required="">
			</div>
			<div>
				<label for="Email" class="floatLabel">Email</label>
				<input id="Email" name="Email" type="text">
			</div>
			<div>
				<label for="password" class="floatLabel">Password</label>
				<input id="password" name="password" type="password" required="">
				<span class="f">Enter a password longer than 8 characters</span>
			</div>
			<div>
				<label for="confirm_password" class="floatLabel">Confirm Password</label>
				<input id="confirm_password" name="confirm_password" type="password" required="">
				<span class="f1">Your passwords do not match</span>
			</div>
             <center>
			<div class="login-btn">
				<input type="submit" name="submit" value="Create My Account" id="submit" style="margin-top: 20px;width:50%;">
			</div>
			</center>
		</form>
		<script src="js/jquery.min.js"></script>
	  <script  src="js/index.js"></script>
	</div>
<?php include"footer.php";?>	