<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
			<meta name="author" content="VMS&CY">
		<link rel="shortcut icon" href="img/logo v1.jpg">
		<title>K-Town Car Share - Admin Cars</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" type="text/css"
		href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script type="text/javascript">
		$(function(){ 
			$("#pickUpDate").datepicker({ 
				minDate:0, 
				onSelect: function(date){ 
				$("#dropOffDate").datepicker('option','minDate',date); 
				} 
			}); 
		}); 
    </script> 
    <script type="text/javascript"> 
		$(function(){ 
			$("#dropOffDate").datepicker({}); 
       }); 
    </script>
	<script type="text/javascript">
	   $(function(){
			$("#pickUpTime").timepicker({ 'timeFormat': 'HH:mm:ss' });
			$("#dropOffTime").timepicker({ 'timeFormat': 'HH:mm:ss' });
	   });
	</script>

	</head>
	<body>
	<?php
		session_start();
        if (isset($_POST['addCar'])){
            $query = "INSERT INTO CAR (make,model,year,lotAddress,dailyFee,carCondition,picturePath,carOdometer) VALUES(?,?,?,?,?,'normal',?,0.00)";
            if($stmt = $con->prepare($query)){
                $stmt->bind_Param("ssisds",$_POST['make'],$_POST['model'],$_POST['year'],$_POST['lotAddress'],$_POST['dailyFee'],$_POST['ImagePath']);
                $stmt->execute();
            }
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
					<ul class="nav navbar-nav navbasr-right" style="padding-top: 15px;">
						<li><a href="cars.php">Cars</a></li> 
						<li><a href="lots.php">Pickup & Dropoff Lots</a></li> 
						<li><a href="reservations.php">Reservations</a></li> 
						<li><a href="maintain.php">Maintainence</a></li> 
						<li><a href="generateInvoice.php">Generate Invoice</a></li>  
						<li><a href="editProfile.php">My Profile</a></li> 
						<li><a href="signOut.php">Sign Out</a></li>  						
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
				<div class="row">
					
					<div class="col-lg-5 col-lg-offset-4">
						<h1 style="color: #041530">Add new car to rent</h1>
						<form name='addCar' id='addCar' action='adminCars.php' method='POST'>
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
                             <div class="form-group">
						    	<input style="width: 100%;" name="ImagePath" type="text" class="form-control" id="ImagePath" placeholder="Upload a picture">
						 	</div>
						 	<div style="text-align: center">
								<button type="submit" class="btn btn-warning btn-lg", name="addCar">Add Car</button>
							</div>
						</form>
					</div>
				</div>
                <div class="form-group">
                    <h1 style="color: #041530" align="center"> Show Rental History For Car </h1>
				</div>
                <form name='chosenCar' id='chosenCar' action='adminCars.php' method='POST'>
                <div class="form-group">
								<select style="width: 100%;" type="text" class="form-control" name="chosenVIN" id="chosenVIN">
								<option value="" selected disabled>Choose Car</option>
								<?php
									include 'config/connection.php';
									$carQueryResult = "SELECT * FROM CAR";
									$carQueryResult = mysqli_query($con,$carQueryResult);
									if(!carQueryResult){
										printf("Error: %s\n", mysqli_error($con));
   										exit();
									}
									while($car = mysqli_fetch_array($carQueryResult)){
										echo "<option value='".$car['VIN']."'>".$car['year']." ".$car['make']." ".$car['model']."</option>";
									}
								?>
								</select>
				</div>
                <div style="text-align: center">
						<button type="submit" class="btn btn-warning btn-lg", name="chosenCar">Get Car History</button>
				</div>
                </form>
                <?php 
                    if(isset($_POST['chosenCar'])){
                        include 'config/connection.php';
                        $rentalHistoryQueryResult = "SELECT DISTINCT DATEDIFF(DATE(dropOffDateTime), DATE(pickUpDateTime)) as length, (dropOffOdometer-pickUpOdometer) as distance, lotAddress, pickUpState, dropOffState, VIN, reservationNumber FROM (RentalHistory NATURAL JOIN Reservation) WHERE VIN=".$_POST['chosenVIN']." AND startDateTime < '".date('y:m:d h:i:s')."'";
                        $rentalHistoryQueryResult = mysqli_query($con,$rentalHistoryQueryResult);
                        if(!$rentalHistoryQueryResult){
                            printf("Error: %s\n", mysqli_error($con));
   							exit();
                        }
						if(mysqli_num_rows($rentalHistoryQueryResult)==0){
							echo "<br><h2 style='color: #041530' align='center'>No rental history to show.</h2>";
						}
						else {
							$carNameQuery = "SELECT make, model, year FROM car WHERE VIN=".$_POST['chosenVIN']."";
							$carNameQuery = mysqli_query($con, $carNameQuery);
							if ($carNameQuery){
								while($car=mysqli_fetch_array($carNameQuery)){
								echo "<br><h2 style='color: #041530' align='center'>".$car['year']." ".$car['make']." ".$car['model']."</h2>";
								echo "<form action='adminComment.php?reservationNumber=".$_SESSION['reservationNumber']."'VIN=".$_SESSION['VIN']."' method=\"POST\">
										<button type=\"submit\" class=\"btn btn-warning btn-sm\";'>View User Comments</button>													
									</form>	";
								}
							}
							echo "<table style='color: #041530' align='center' frame='void'>";
							echo "<tr><th>Length of Rental</th><th>Parking Lot Location</th><th>Distance Travelled</th><th>Pickup State</th><th>Dropoff State</th><th></th></tr>";
							while($rentalHistory=mysqli_fetch_array($rentalHistoryQueryResult)){
								$length = $rentalHistory['length'];
								$lot = $rentalHistory['lotAddress'];
								$distance = $rentalHistory['distance'];
								$pickupState = $rentalHistory['pickUpState'];
								$returnState = $rentalHistory['dropOffState'];
								$_SESSION['VIN'] = $rentalHistory['VIN'];
								$_SESSION['reservationNumber'] = $rentalHistory['reservationNumber'];
								echo "<tr style='color: #041530' align='center'>
									<td>".$length." day(s) </td>
									<td>".$lot."</td>
									<td>".$distance." km </td>
									<td>".$pickupState."</td>
									<td>".$returnState."</td>
									</tr>";
							}
							echo "<br></table>";
							}
                    }
                ?>
			</div>
		</div>
		<div class="container">
			<hr>
			<p class="centered" style="color: #041530">CISC 332 Final Project created by Christina Yan &amp; Vinith Suriyakumar.</p>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
		</body>
</html>