<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
			<meta name="author" content="VMS&CY">
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
						<li><a href="reservations.php">Reservations</a></li> 
						<li><a href="maintain.php">Maintainence</a></li> 
						<li><a href="generateInvoice.php">Generate Invoice</a></li>  
						<li><a href="signOut.php">Sign Out</a></li>             
					</ul> 
				</div> 
			</div> 
		</div> 
		<div id="headerwrap" style="padding-top: 50px; min-height: 590px">
			<div class="container">
			<div class="form-group">
				<div class="col-lg-9 col-lg-offset-0">
					<br>
					<h1 style="color: #041530">Cars that need to be serviced<h1>
						<?php
							session_start();
							include 'config/connection.php';
							$maintainQueryResult = "SELECT * FROM `car` WHERE carCondition='damaged' OR carCondition='not running'";
							$maintainQueryResult = mysqli_query($con,$maintainQueryResult);
							if(!$maintainQueryResult){
								printf("Error: %s\n", mysqli_error($con));
								exit();
							}
							if (mysqli_num_rows($maintainQueryResult )==0){
								echo "No cars need servicing";
							}
							else {
								echo "<table frame='void'>";
								echo "<tr><th>VIN</th><th>Make</th><th>Model</th><th>Year</th><th>Lot Address</th><th>Odometer</th></tr>";
									while($row = mysqli_fetch_array($maintainQueryResult)){									
									echo "<tr>
										<td>".$row['VIN']."</td>
										<td>".$row['make']."</td>
										<td>".$row['model']."</td>
										<td>".$row['year']."</td>
										<td>".$row['lotAddress']."</td>
										<td>".$row['carOdometer']."</td>
									</tr>";
								}
								echo "</table>";
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
</body>
</html>
