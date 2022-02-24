<?php
include 'header.php';
?>

	<div class="login-forms">
		<form action="code/loginCode.php" method="post">
			<h2>Login</h2>
			<div>
				<input id="uname" name="uname" type="text" required="" placeholder="Username">
			</div>
			<div>
				<input id="password" name="password" type="password" required="" placeholder="Password">
			</div>
			<div>
				<select id = "cmbMake" name = "Make" required>
					<option  value = "" id = "place">Select Users</option>
					<option value = "1">Admin</option>
					<option value = "2">User</option>
				</select>
			</div>
			<center>
			<div class="login-btn">
				<input type="submit" value="Login" id="submit">
			</div>
			</center>
			<center>
			<div class="reg-btn"><a href="register.php" style="font-family:Adobe Gothic Std B; font-size:18px"> Register now </a></div>
			</center>
		</form>
	
	</div>
<center><?php include 'footer.php'; ?></center>
</body>
</html>
