<!DOCTYPE html> 
var date = "" 
<html lang="en"> 
  <head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content=""> 
    <meta name="author" content="VMS&CY"> 
    <link rel="shortcut icon" href="img/logo v1.jpg"> 
	
    <title>K-Town Car Share - New Booking</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css", rel="stylesheet">		
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css"
	href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	
	<html>
		<body> 
		<?php
			session_start();
			if($_SESSION['userType']=='client'){
            header('Location: profile.php');
            exit();
        }
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
						<ul class="nav navbar-nav navbar-right"> 
							<li><a href="cars.php">Cars</a></li> 
							<li><a href="lots.php">Pickup & Dropoff Lots</a></li> 
							<li><a href="reservations.php">Reservations</a></li> 
							<li><a href="generateInvoice.php">Generate Invoice</a></li>  
							<li><a href="editProfile.php">My Profile</a></li> 
							<li><a href="signOut.php">Sign Out</a></li>             
						</ul> 
					</div> 
				</div> 
			</div> 
		  
			<div id="headerwrap" style="padding-top: 150px; min-height: 590px;"> 
				<div class="container"> 
					<div class="form-group">
						<div class="col-lg-6 col-lg-offset-0">
							<h1 style="color: #041530"><u>Today's reservations<br></u></h1>
							<?php
								include 'config/connection.php';
								$today = date("Y-m-d H:i:s");
								$todayReservationResult = "SELECT * FROM Reservation WHERE startDateTime='".$today."'";
								$todayReservationResult = mysqli_query($con,$todayReservationResult);
								if(!$todayReservationResult){
									printf("Error: %s\n", mysqli_error($con));
   									exit();
								}
								while($reservation = mysqli_fetch_array($todayReservationResult)){
									echo "<h2> Reservation Number:".$reservation['reservationNumber']."</h2>";
								}
							?>
							<h2 style="color: #041530"><u>Returning today<br></u></h2>
							<?php
								include 'config/connection.php';
								$today = date("Y-m-d H:i:s");
								$todayReservationResult = "SELECT * FROM Reservation WHERE endDateTime='".$today."'";
								$todayReservationResult = mysqli_query($con,$todayReservationResult);
								if(!$todayReservationResult){
									printf("Error: %s\n", mysqli_error($con));
   									exit();
								}
								while($reservation = mysqli_fetch_array($todayReservationResult)){
									echo "<h2> Reservation Number:".$reservation['reservationNumber']."</h2>";
								}
							?>
							<form name='5000club' id='5000club' action='adminLanding.php' method='POST'>
						 	<div style="text-align: center">
								<button type="submit" class="btn btn-warning btn-lg", name="5000club">More than 5000 km</button>
							</div>
							</form>
							<?php
								include 'config/connection.php';
								if(isset($_POST['5000club'])){
									$today = date("Y-m-d H:i:s");
									$todayReservationResult = "SELECT * FROM Reservation WHERE endDateTime='".$today."'";
									$todayReservationResult = mysqli_query($con,$todayReservationResult);
									if(!$todayReservationResult){
										printf("Error: %s\n", mysqli_error($con));
   										exit();
									}
									while($reservation = mysqli_fetch_array($todayReservationResult)){
										echo "<h2> Reservation Number:".$reservation['reservationNumber']."</h2>";
									}
								}
							?>
							<form name='highestRentedCar' id='highestRentedCar' action='adminLanding.php' method='POST'>
						 	<div style="text-align: center">
								<button type="submit" class="btn btn-warning btn-lg", name="highestRentedCar">Highest Rented Car</button>
							</div>
							</form>
							<?php
								include 'config/connection.php';
								if(isset($_POST['highestRentedCar'])){
									$today = date("Y-m-d H:i:s");
									$highestCarReservationResult = "SELECT VIN,max(rentCount) FROM (SELECT VIN,COUNT(*) as rentCount FROM RentalHistory GROUP BY VIN) as t1";
									$highestReservationResult = mysqli_query($con,$highestCarReservationResult);
									if(!$highestCarReservationResult){
										printf("Error: %s\n", mysqli_error($con));
   										exit();
									}
									while($reservation = mysqli_fetch_array($highestReservationResult)){
										echo "<h2> Reservation Number:".$reservation['reservationNumber']."</h2>";
									}
								}
							?>
							<form name='lowestRentedCar' id='highestRentedCar' action='adminLanding.php' method='POST'>
						 	<div style="text-align: center">
								<button type="submit" class="btn btn-warning btn-lg", name="highestRentedCar">Highest Rented Car</button>
							</div>
							</form>
						</div>
					</div>					
				</div>				
			</div>	
			
			<div class="container"> 
				<p class="centered">CISC 332 Final Project created by Christina Yan &amp; Vinith Suriyakumar.</p> 
			</div> 
		<script src="js/bootstrap.min.js"></script> 
	</body> 
</html>