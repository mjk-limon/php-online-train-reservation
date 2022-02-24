

<?php 

include 'connection.php';
include"header.php";?>

	<section class="content">
			<header class="masthead text-white ">
				<div class="overlay"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-4 offset-md-1 align-self-center releway-font">
							<h2 class="font-weight-bold cus-font-size">Welcome to</h2>
							<h2 class="font-weight-light cus-font-size">Bangladesh Railway</h2>
							<h2 class="font-weight-bold cus-font-size">E-Ticketing Service</h2>
						</div>
						<div class="col-md-2">
						</div>
						<div class="col-md-6 col-sm-6 col-12">				
							<div class="row">
								<div class="col-md-12">
									<div class="maintext" style="width:100%;min-height: 300px;margin-bottom:40px;">
									<div id="flights">
										<h1 class="ftext1">Select Your Trip Type</h1>
										<div class="all-infut-1">
											<div class="form-group">
												<select id="trip" name="trip">
														<option value="0" disabled="" selected="">Select</option>
														<option value="1">Round Trip</option>
														<option value="2">One Way</option>
												</select>
											</div>
										</div>
										<div id="twoWay">
											<form action="searchTraines.php" method="get">
												<div class="form-group">
													<div class="all-infut" style="display: inline-block; width: 95%;">
														<div class="falf-infut">
															<select required="" id="cmbMake" name="DepLoc">
																<option value="" id="place">Leaving from...</option>
																<?php
																		$sql="SELECT * FROM `reset`.`location` ORDER BY `Name`";
																		$result=  mysqli_query($conn, $sql);
																		if(mysqli_num_rows($result)){
																			while($row=mysqli_fetch_assoc($result)){
																?>
																	<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
																<?php                                      
																			}
																		}
																		mysqli_close();
																?>
															</select>
														</div>
														<div class="falf-infut">
															<select required="" id="cmbMake" name="RechLoc">
																<option value="" id="place">Going to...</option>
															<?php
																$sql="SELECT * FROM `reset`.`retlocation` ORDER BY `Name`";
																$result=  mysqli_query($conn, $sql);
																if(mysqli_num_rows($result)){
																while($row=mysqli_fetch_assoc($result)){
															?>
																<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
															<?php }} mysqli_close(); ?>
															</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="all-infut">
														<label  id="label0" class="ftext">Depart date:</label>
														<input required="" type="text" name="depart_date" id="datepicker1" placeholder="year/month/day" />
													</div>
												</div>
												<div class="form-group">
													<div class="all-infut">
														<label id="label1" class="ftext">Return date:</label>
														<input required="" type="text" name="return_date" id="datepicker" placeholder="year/month/day" />
													</div>
												</div>
												<div class="form-group">
													<div class="all-infut-login-btn">
														<p class="ftext" id="dateIn"></p>
														<input class="search btn btn-success" type="submit" name="searchTwo" id="find" value="Search Traines" />
													</div>
												</div>
											</form>
										</div>
										<div id="oneWay">
											<form action="searchTraines.php" method="get">
												<div class="all-infut" style="display: inline-block; width: 95%;">
													<div class="form-group">
														<div class="falf-infut">
															<select id="cmbMake" name="DepLoc" required>
																<option value="" id="place">Leaving from...</option>
															<?php
															$sql="SELECT * FROM `reset`.`location` ORDER BY `Name`";
															$result=  mysqli_query($conn, $sql);
															if(mysqli_num_rows($result)){
																while ($row=mysqli_fetch_assoc($result)){
															?>
																<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
															<?php }} mysqli_close(); ?>
															</select>
														</div>
														<div class="falf-infut">
															<select id="cmbMake" name="RechLoc" required>
																<option value="" id="place">Going to...</option>
															<?php
															$sql="SELECT * FROM `reset`.`retlocation` ORDER BY `Name`";
															$result=  mysqli_query($conn, $sql);
															if(mysqli_num_rows($result)){
															while ($row=mysqli_fetch_assoc($result)){
															?>
																<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
															<?php }} mysqli_close(); ?>
															</select>
														</div>
													</div>
												</div>
												<div class="all-infut">
													<div class="form-group">
														<label style="display: solid block" id="label0" class="ftext">Date:</label>
														<input required="" type="text" id="datepicker3" name="depart_date" placeholder="year/month/day" />
													</div>
												</div>
												<div class="all-infut-login-btn">
													<div class="form-group">	
														<input class="search btn btn-success" type="submit" name="searchOne" id="find" value="Search Traines" />
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</header>
	</section>
	<div class="container">		
			
		<div class="row">
			<h2 class="font11">About Us</h2>
			<div class="col-md-6 col-sm-6 col-12">
				<h3>Get Train Tickets from the comfort of your home</h3>
				<p class="tex-js">
					Book train tickets from anywhere using the robust ticketing platform exclusively built to provide the passengers with pleasant ticketing experience. Also check out the mobile app RailSheba to further extend your pleasure of booking train tickets.
					Train & Ticketing related information at your fingertips
					Checkout available seats, route information, fare information on real time basis with Esheba Platform.
				</p>
			</div>
			<div class="col-md-6 col-sm-6 col-12 ">
				<img src="image/about-us.png" class="tex-js">
			</div>
		</div>
	
	</div>
	<div class="container">		
			
		<div class="row">
			<h2 class="font11">We Accept</h2>
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/visa.jpg"alt="logo" class="logo3" >
			</div>
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/master.png"alt="logo" class="logo3" >
			</div>
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/b.png"alt="logo" class="logo3" >
			</div>
			
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/n.png"alt="logo" class="logo3" >
			</div>
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/u.png"alt="logo" class="logo3" >				
			</div>
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/Rocket.png"alt="logo" class="logo3" >				
			</div>
		</div>
	
	</div>
	
<?php include"footer.php";?>		