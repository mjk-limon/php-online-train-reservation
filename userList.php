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
	if(isset($_POST['update-user'])) {
		$cus_id = $conn->real_escape_string($_POST['cus_id']);
		$fields['cus_first_name'] = $conn->real_escape_string($_POST['fname']);
		$fields['cus_last_name'] = $conn->real_escape_string($_POST['lname']);
		$fields['cus_user_name'] = $conn->real_escape_string($_POST['uname']);
		$fields['email'] = $conn->real_escape_string($_POST['email']);
		!empty($_POST['password']) ? $fields['cus_pass'] = $conn->real_escape_string($_POST['password']) : null;
		$sql = $ob1->UpdateTable("customer", $fields, "cus_id='{$cus_id}'");
		if($conn->query($sql) == true) echo "<script>alert('Successfully updated data')</script>";
		else echo "<script>alert('".$conn->error."')</script>";
	}
	if(isset($_GET['delete-user'])) {
		$cus_id = $conn->real_escape_string($_GET['cus_id']);
		$sql = $ob1->DeleteTable("customer", "cus_id='{$cus_id}'");
		if($conn->query($sql) == true) echo "<script>alert('Successfully deleted data')</script>";
		else echo "<script>alert('".$conn->error."')</script>";
	}
?>

<?php if(!isset($_GET['update'])){ ?>
	<center>
		<button class="btn btn-info" onclick="prnt()"><i class="glyphicon glyphicon-print"></i> Print</button>
		<h1>User List</h1>
	</center>
	<div id="main">
		<center>
			<table class="adnmin-tabil">
				<tr>
					<th>
						<label>Serial</label>
					</th>
					<th>
						<label>Name</label>
					</th>
					<th>
						<label>User Name</label>
					</th>
					<th>
						<label>Email</label>
					</th>
					<th>
						<label>Balance</label>
					</th>
					<th>
						<label>Password</label>
                    </th>
					
					<th>
						<label>Action</label>
					</th>
				</tr>
				<?php    
				   
				    
						$sql="SELECT * FROM `reset`.`customer`ORDER BY `cus_id` ";
	                   
			          $result=  mysqli_query($conn, $sql);
						if(mysqli_num_rows($result)){
								while ($row=mysqli_fetch_assoc($result)){
				?>
				    <tr>
						<td>
									<?php echo $row['cus_id'];?>
							</td>
							<td>
									<?php echo $row['cus_first_name']." ".$row['cus_last_name'];?>
							</td>
							<td>
									<?php echo $row['cus_user_name'];?>
							</td>
							<td>
									<?php echo $row['email'];?>
							</td>
							<?php
							$aa = $row['cus_id'];
							$sql1="SELECT * FROM balance where userid = $aa  ";
	                   
			          $result1=  mysqli_query($conn, $sql1);
						if(mysqli_num_rows($result1)){
								while ($row1=mysqli_fetch_assoc($result1)){
									
									$b= $row1['balance'];
									
								}
						}
									
									?>
									
									<td>
									<?php echo $b;?>
							</td>
							<td>
									<?php echo $row['cus_pass'];?>
							</td>
							
							<td class="hideforpdf">
									<a href="?update=<?php echo $row['cus_id']?>">Edit</a>/
									<a href="?delete-user=1&cus_id=<?php echo $row['cus_id']?>">Delete</a>
							</td>
							
					</tr>
					<?php                                      
									}
						          
							}
					?>
			</table>
		</center>
	</div>
<?php
	} else {
		$userinfo = $conn->query("SELECT * FROM customer WHERE cus_id='{$_GET['update']}' LIMIT 1")->fetch_assoc();
?>
	<center>
		<h1>Update User</h1>
		<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="login-forms" style="width:80%">
			
				<form id="" action="" method="post">
					<input type="hidden" name="update-user" value="1" />
					<input type="hidden" name="cus_id" value="<?= $_GET['update'] ?>" />
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="fname" class="form-control" value="<?= $userinfo['cus_first_name'] ?>"/>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="lname" class="form-control" value="<?= $userinfo['cus_last_name'] ?>"/>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="uname" class="form-control" value="<?= $userinfo['cus_user_name'] ?>"/>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="<?= $userinfo['email'] ?>"/>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control"/>
					</div>
			</div>
					<input type="submit" value="Update" class="btn btn-success" />
				</form>
			</div>
		</div>
		
	</center>
<?php } ?>
<script>
		function prnt(){
			var div="<html><head><style> .hideforpdf{display: none;}td{text-align:center;}table{border: 1px solid black; border-collapse: collapse;}table tr{border: 1px solid black;}table tr td{border: 1px solid black;}table tr th{border: 1px solid black;}</style></head><body>"
			div+=document.getElementById('main').innerHTML;
			div+="</body></html>"
			var win=window.open("", "", "width=960,height=500");
			win.document.write("<center><h1>Confirmation Panel</h1></center><br><br>");
			win.document.write(div);
			win.document.write("<br><br><center><p> All Rights Reserved By Ik Sajib</p><p>Developed By Ik Sajib</p></center>");
			win.print();
		}
</script>
