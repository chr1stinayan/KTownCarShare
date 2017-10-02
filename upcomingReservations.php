<?php
	include 'config/connection.php';
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
			<meta name="author" content="VMS&CY">
		<link rel="shortcut icon" href="img/logo v1.jpg">
		<title>K-Town Car Share - Upcoming Reservations</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="headerwrap" style="padding-top: 150px; min-height: 590px;">
			<div class="container">
				<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<a class="navbar-brand" href="index.php"> <img src="img/logo v1.png" height="50"> <b>K-Town Car Share</b> </a>
				</div>
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
				</div>
			</div>
		</div>
	</body>
</html>