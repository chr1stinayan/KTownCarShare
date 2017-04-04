<?php
	session_start();
	include 'config/connection.php';	
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
			
			<div id="headerwrap" style="padding-top: 50px; min-height: 590px">
			<div class="container">
			<div class="form-group">
				<div class="col-lg-9 col-lg-offset-0">
					<h1 style="color: #041530"><?php echo date('F Y', mktime(0, 0, 0, date('m')-1, 1, date('Y'))); ?> Rental History for <?php echo $_SESSION['firstName'], $_SESSION['lastName'];?><h1>
				</div>
				<?php
					$monthlyInvoiceQuery = "SELECT reservationNumber, dailyFee*datediff(dropOffDateTime, pickUpDateTime) as tripTotal, (dropOffOdometer-pickUpOdometer) as distance, pickUpDateTime, dropOffDateTime
										FROM rentalhistory JOIN car USING(VIN) 
										WHERE memberNumber = ".$_SESSION['memberNumber']." AND extract(year from CURRENT_DATE)=extract(year from '".$_SESSION['dropOffDateTime']."') AND extract(month from '".$_SESSION['dropOffDateTime']."')=extract(month from DATE_SUB(CURRENT_DATE, INTERVAL 1 month))";
					$monthlyTotalQuery= "SELECT SUM(dailyFee*datediff(dropOffDateTime, pickUpDateTime))+250 as monthTotal
										FROM rentalhistory JOIN car USING(VIN) 
										WHERE memberNumber = ".$_SESSION['memberNumber']." AND extract(year from CURRENT_DATE)=extract(year from '".$_SESSION['dropOffDateTime']."') AND extract(month from '".$_SESSION['dropOffDateTime']."')=extract(month from DATE_SUB(CURRENT_DATE, INTERVAL 1 month))";
	
					$monthlyInvoice = mysqli_query($con,$monthlyInvoiceQuery);
					$monthlyTotalCost = mysqli_query($con,$monthlyTotalQuery);
					if (!$monthlyInvoice) {
						printf("Error: %s\n",$monthlyInvoiceQuery);
						exit();
					}
					if (!$monthlyTotalCost) {
						printf("Error: %s\n",$monthlyTotalQuery);
						exit();
					}
					echo "<table frame='void'>";
					echo "<tr><th style='color: #041530'>Reservation Number</th><th style='color: #041530'>Rental Cost</th><th style='color: #041530'>Distance Travelled</th><th style='color: #041530'>Pickup Date & Time</th><th style='color: #041530'>Dropoff Date & Time</th></tr>";
					while($row = mysqli_fetch_array($monthlyInvoice)){
						$rno= $row['reservationNumber'];
						$cost = $row['tripTotal'];
						$dist = $row['distance'];
						$pickup = $row['pickUpDateTime'];
						$return = $row['dropOffDateTime'];
						
						echo "<tr>
							<td style='color: #041530'>".$rno."</td>
							<td style='color: #041530'>".$cost."</td>
							<td style='color: #041530'>".$dist." km.</td>
							<td style='color: #041530'>".$pickup."</td>
							<td style='color: #041530'>".$return."</td>
						</tr>";
					}
					echo "</table>";
					while($row = mysqli_fetch_array($monthlyTotalCost)){
						$cost= $row['monthTotal'];						
						echo "<h2 style='color: #041530'>Your monthly total is $ $cost</h2>";
					}
				?>	
			</div>
		  </div>
		</div>
	</body>
</html>