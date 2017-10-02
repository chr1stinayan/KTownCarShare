<?php
include 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
			<meta name="author" content="VMS&amp;SN&amp;BB&amp;VH">
		<link rel="shortcut icon" href="img/logo v1.jpg">
		<title>K-Town Car Share - Landing Page</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<body>
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
						<ul class="nav navbar-nav navbar-right">
							<li><a href="cars.php">Cars</a></li>
							<li><a href="lots.php">Pickup & Dropoff Lots</a></li>
							<li><a href="newBooking.php">New Booking</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown">Reservations
								<ul class="dropdown-menu">
									<li><a href="upcomingReservations.php">Upcoming Reservations</a></li>
									<li><a href="rentalHistory.php">Rental History</a></li>
								</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown">Member Profile
							<ul class="dropdown-menu">
								<li><a href="profile.php">My Profile</a></li>
								<li><a href="editProfile.php">Edit Profile</a></li>
							</ul>
						</li>
						<li><a href="signOut.php">Sign Out</a></li>						
					</ul>
					</div>
				</div>
			</div>
		<div id="headerwrap" style="padding-top: 150px; min-height: 590px;">
			<div class="container">
					<div class="col-lg-6 col-lg-offset-3">
						<h1 style="color: #041530">Welcome, <?php session_start(); echo $_SESSION['firstName']; ?><h1>
					</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<h1 style="color: #041530">Upcoming reservations<h1>
						<?php
							$upcomingReservationsQueryResult = '';
							if (isset($_SESSION['memberNumber'])){
								date_default_timezone_set('US/Eastern');
								$upcomingReservationsQueryResult = "SELECT * FROM Reservation WHERE memberNumber='".$_SESSION['memberNumber']."' AND startDateTime > '".date('y:m:d h:i:s')."'";
								$upcomingReservationsQueryResult = mysqli_query($con,$upcomingReservationsQueryResult);
								if(!$upcomingReservationsQueryResult){
									printf("Error: %s\n", mysqli_error($con));
									exit();
								}
								if (mysqli_num_rows($upcomingReservationsQueryResult)==0){
									echo "No upcoming reservations";
								}
								else {
									echo "<table frame='void'>";
									echo "<tr><th>Reservation Number</th><th>Access Code</th><th>Pickup Date & Time</th><th>Pickup Date & Time</th><th>Reservation Length</th></tr>";

									while($row = mysqli_fetch_array($upcomingReservationsQueryResult)){
										$rNo = $row['reservationNumber'];
										$accessCode = $row['accessCode'];
										$pickupDateTime = $row['startDateTime'];
										$returnDateTime  = $row['endDateTime'];
										$length  = $row['reservationLength'];
										echo "<tr><td>".$rNo."</td><td>".$accessCode."</td><td>".$pickupDateTime."</td><td>".$returnDateTime."</td><td>".$length."</td></tr>";
									}
								}
							}
							else {
								echo "Error: member number not set";
							}
						?>						
						<h1 style="color: #041530">Rental History<h1>
						<?php
							if (isset($_SESSION['memberNumber'])){
								date_default_timezone_set('US/Eastern');
								$rentalHistoryQueryResult = "SELECT DATEDIFF(DATE(dropOffDateTime), DATE(pickUpDateTime)) as length, (dropOffOdometer-pickUpOdometer) as distance, lotAddress, pickUpState, dropOffState FROM RentalHistory JOIN Reservation WHERE memberNumber='".$_SESSION['memberNumber']."' AND startDateTime < '".date('y:m:d h:i:s')."'";
								$rentalHistoryQueryResult = mysqli_query($con,$rentalHistoryQueryResult);
								if(!$rentalHistoryQueryResult){
									printf("Error: %s\n", mysqli_error($con));
									exit();
								}
								if (mysqli_num_rows($rentalHistoryQueryResult)==0){
									echo "No upcoming reservations";
								}
								else {
									echo "<table frame='void'>";
									echo "<tr><th>Length of Rental</th><th>Parking Lot Location</th><th>Distance Travelled</th><th></th><th>Pickup State</th><th>Dropoff State</th></tr>";

									while($row = mysqli_fetch_array($rentalHistoryQueryResult)){
										$length = $row['length'];
										$lot = $row['lotAddress'];
										$distance = $row['distance'];
										$pickupState = $row['pickUpState'];
										$returnState = $row['dropOffState'];
										
										echo "<tr>
											<td>".$length."</td>
											<td>".$lot."</td>
											<td>".$distance.' km'."</td>
											<td>".$pickupState."</td>
											<td>".$returnState."</td>
										</tr>";
									}
								}
							}
							else {
								echo "Error: member number not set";
							}
						?>
					</div>
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