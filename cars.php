<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
			<meta name="author" content="VMS&amp;SN&amp;BB&amp;VH">
		<link rel="shortcut icon" href="img/logo v1.jpg">
		<title>K-Town Car Share - Cars</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
		<script type="text/javascript">
		   $(function(){
				$("#pickUpDate").datepicker({
					dateFormat: 'yyyy-mm-dd',
					minDate:0,
					onSelect: function(date){
						$("#dropOffDate").datepicker('option','minDate',date);
					}
				});
		   });
		</script>
	    <script type="text/javascript">
		   $(function(){
				$("#dropOffDate").datepicker({dateFormat: 'yyyy-mm-dd'});
		   });
        </script>
		<script type="text/javascript">
		   $(function(){
				$("#pickUpTime").timepicker();
		   });
        </script>
		<script type="text/javascript">
		   $(function(){
				$("#dropOffTime").timepicker({timeFormat: 'H:i:s'});
		   });
        </script>
		<script>
			$(function myFunction() {
				var no = document.getElementById("Lot List");
				var lot = no.options[no.selectedIndex].text;
				document.getElementById("lotSel").innerHTML = lot;
				
								
			});
		</script>
	</head>
	<body>
	<?php
		session_start();
	?>
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						<a class="navbar-brand" href="index.php"> <img src="img/logo v1.png" height="50"> <b>K-Town Car Share</b> </a>
					</div>
					<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbasr-right" style="padding-top: 15px;">
						<li><a href="cars.php">Cars</a></li>
						<li><a href="lots.php">Pickup & Dropoff Lots</a></li>
						<li><a href="currentRes.php">My Reservations</a></li>
						<li><a href="newRes.php">New Booking</a></li>
						<li><a href="editprofile.php">My Profile</a></li>
						<li><a href="login.php?logout=1">Sign Out</a></li>						
					</ul>
					</div>
				</div>
			</div>
		<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">
			<div class="container">
				<div class="form-group">
					<div class="col-lg-9-offset-1" style="padding-bottom:15px">
						<h1 style="text-align: center; color: #041530;"></h1>
				</div>
				<?php if (!isset($_POST['searchCars'])):?>
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<h1 style="text-align:center">Search For Cars</h1>
						<form name='searchCars' id='searchCars' action='cars.php' method='POST'>
						 	<div class="form-group">
						    	<input style="width: 100%;" name="Make" type="text" class="form-control" id="Make" placeholder="Make">
						  	</div>
						 	<div class="form-group">
						    	<input style="width: 100%;" name="Model" type="text" class="form-control" id="Model" placeholder="Model">
						 	</div>
							 <div class="form-group">
						    	<input style="width: 100%;" name="Year" type="text" class="form-control" id="Year" placeholder="Year">
						 	</div>
							 <div class="form-group">
						    	<input style="width: 100%;" name="DailyFee" type="text" class="form-control" id="DailyFee" placeholder="Daily Fee">
						 	</div>
							 <div class="form-group">
							 	<input style="width: 100%;" type="text" name="pickUpDate" id="pickUpDate" placeholder="Pick Up Date">
							</div>
							<div class ="form-group">
								<input style="width: 100%;" type="text" name="pickUpTime" id="pickupTime" placeholder="Pick Up Time">
							</div>
							<div class="form-group">
								<input style="width: 100%;" type="text" name="dropOffDate" id="dropOffDate" placeholder="Drop Off Date">
							</div>
							<div class="form-group">
								<input style="width: 100%;" type="text" name="dropOffTime" id="dropOffTime" placeholder="Drop Off Time">
							</div>
							<div class="form-group">
								<select style="width: 100%;" type="text" class="form-control" name="pickUpLocation" id="pickUpLocation">
								<option value="" selected disabled>Pickup Location </option>
								<?php
									include 'config/connection.php';
									$locationQueryResult = "SELECT * FROM ParkingLocations";
									$locationQueryResult = mysqli_query($con,$locationQueryResult);
									if(!locationQueryResult){
										printf("Error: %s\n", mysqli_error($con));
   										exit();
									}
									while($location = mysqli_fetch_array($locationQueryResult)){
										echo "<option value=''>".$location['lotAddress']."</option>";
									}
								?>
								</select>
							</div>
						 	<div style="text-align: center">
								<button type="submit" class="btn btn-warning btn-lg", name="searchCars">Search</button>
							</div>
						</form>
					</div>
				</div>
				<?php endif; ?>
				<?php if(isset($_POST['searchCars'])) : ?>
				<div class="form-group">
					<?php
						
						include 'config/connection.php';
						$carsQuery = "SELECT * FROM CAR";
						$carsQuery = $carsQuery." WHERE VIN NOT IN (SELECT VIN FROM CAR NATURAL JOIN RESERVATION WHERE startDateTime>='".$_POST['pickUpDate']." ".$_POST['pickUpTime']."' AND endDateTime<='".$_POST['dropOffDate']." ".$_POST['dropOffTime']."')";
						$additionalTerms = "";
						$_SESSION['pickUpDate'] = $_POST['pickUpDate'];
						$_SESSION['pickUpTime'] = $_POST['pickUpTime'];
						$_SESSION['dropOffDate'] = $_POST['dropOffDate'];
						$_SESSION['dropOffTime'] = $_POST['dropOffTime'];
						if(!empty($_POST['Make'])){
							$additionalTerms = $additionalTerms." AND make=".$_POST['Make'];
						}
						if(!empty($_POST['Model'])){
							$additionalTerms = $additionalTerms." AND model=".$_POST['Model'];
						}
						if(!empty($_POST['Year'])){
							$additionalTerms = $additionalTerms." AND year=".$_POST['Year'];
						}
						if(!empty($_POST['DailyFee'])){
							$additionalTerms = $additionalTerms." AND dailyFee=".$_POST['DailyFee'];
						}
						if(!empty($_POST['pickUpLocation'])){
							$additionalTerms = $additionalTerms." AND address=".$_POST['pickUpLocation'];
						}
						if(!($additionalTerms=="")){
							$carsQuery = $carsQuery." WHERE ".$additionalTerms;
						}
						$carsQueryResult = mysqli_query($con,$carsQuery);
						if (!$carsQueryResult) {
    						printf("Error: %s\n".$carsQuery, mysqli_error($con));
   							exit();
						}
						while($rowCarName = mysqli_fetch_array($carsQueryResult)){
							echo "<div class='row' style='padding-bottom: 45px'>";
							echo "<div class='col-md-3'>";
							echo "<img src='".$rowCarName['imageLink']."'height=180px/>";
							echo "</div>";
							echo "<div class='col-md-7' style='padding-left:15px;'>";
							echo "<ul style='color: #041530'>";
							echo "<li> Make: ".$rowCarName['VIN']. "</li>";
							echo "<li> Model: ".$rowCarName['model']. "</li>";
							echo "<li> Year: " .$rowCarName['year']. "</li>";
							echo "<li> Address: ".$rowCarName['lotAddress']. "</li>";
							echo "<li> Daily Fee: $".$rowCarName['dailyFee']."</li>";
							echo "</ul>";
							echo "<form name='makeReservation' id='makeReservation' action='newBooking.php?VIN=".$rowCarName['VIN']."' method='POST'>";
							echo "<div class='form-group' style='padding-left: 15px'>";
							echo "<button type='submit' class='btn' style: 'background-color:#041530' >Make A Reservation</button>";
							echo "</div>";
							echo "</form>";
							echo "</div>";
							echo "</div>";
						}
					?>
				</div>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<hr>
			<p class="centered">CISC 332 Final Project created by Christina Yan &amp; Vinith Suriyakumar.</p>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
		</body>
</html>