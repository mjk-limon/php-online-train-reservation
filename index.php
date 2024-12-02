

<?php 

include 'connection.php';
include"header.php";?>


	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-5 col-12">
				
				  <div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
					  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					  <li data-target="#myCarousel" data-slide-to="1"></li>
					  <li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
					  <div class="item active">
						<img src="image/bus10.jpg" alt="bus" style="height:300px;width:100%;">
					  </div>

					  <div class="item">
						<img src="image/bus3.jpg" alt="bus2" style="height:300px;width:100%;">
					  </div>
					
					  <div class="item">
						<img src="image/bus1.png" alt="bus3" style="height:300px;width:100%;">
					  </div>
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					  <span class="glyphicon glyphicon-chevron-left"></span>
					  <span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
					  <span class="glyphicon glyphicon-chevron-right"></span>
					  <span class="sr-only">Next</span>
					</a>
				  </div>
				
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
								<form action="searchBuses.php" method="get">
									<div class="form-group">
										<div class="all-infut" style="display: inline-block; width: 95%;">
											<div class="falf-infut">
												<select required="" id="cmbMake" name="DepLoc">
													<option value="" id="place">Leaving from...</option>
													<?php
															$sql="SELECT * FROM `sas`.`location` ORDER BY `Name`";
															$result=  mysqli_query($conn, $sql);
															if(mysqli_num_rows($result)){
																while($row=mysqli_fetch_assoc($result)){
													?>
														<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
													<?php                                      
																}
															}
															
													?>
												</select>
											</div>
											<div class="falf-infut">
												<select required="" id="cmbMake" name="RechLoc">
													<option value="" id="place">Going to...</option>
												<?php
													$sql="SELECT * FROM `sas`.`retlocation` ORDER BY `Name`";
													$result=  mysqli_query($conn, $sql);
													if(mysqli_num_rows($result)){
													while($row=mysqli_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
												<?php }}  ?>
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
											<input class="search btn btn-success" type="submit" name="searchTwo" id="find" value="Search Buses" />
										</div>
									</div>
								</form>
							</div>
							<div id="oneWay">
								<form action="searchBuses.php" method="get">
									<div class="all-infut" style="display: inline-block; width: 95%;">
										<div class="form-group">
											<div class="falf-infut">
												<select id="cmbMake" name="DepLoc" required>
													<option value="" id="place">Leaving from...</option>
												<?php
												$sql="SELECT * FROM `sas`.`location` ORDER BY `Name`";
												$result=  mysqli_query($conn, $sql);
												if(mysqli_num_rows($result)){
													while ($row=mysqli_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
												<?php }}  ?>
												</select>
											</div>
											<div class="falf-infut">
												<select id="cmbMake" name="RechLoc" required>
													<option value="" id="place">Going to...</option>
												<?php
												$sql="SELECT * FROM `sas`.`retlocation` ORDER BY `Name`";
												$result=  mysqli_query($conn, $sql);
												if(mysqli_num_rows($result)){
												while ($row=mysqli_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['id']; ?>"><?php echo$row['Name']; ?></option>
												<?php }}  ?>
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
											<input class="search btn btn-success" type="submit" name="searchOne" id="find" value="Search Buses" />
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
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
				<img src="image/Rocket.png"alt="logo" class="logo3" >				
			</div>
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/b.png"alt="logo" class="logo3" >
			</div>
			<div class="col-md-2 col-sm-2 col-12">
				<img src="image/Rocket.png"alt="logo" class="logo3" >				
			</div>
		</div>
	</div>
		
	</div>
	
<?php include"footer.php";?>		