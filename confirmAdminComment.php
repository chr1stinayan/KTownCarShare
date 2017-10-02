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
						<li><a href="editProfile.php">My Profile</a></li> 
						<li><a href="signOut.php">Sign Out</a></li>             
					</ul> 
				</div> 
			</div> 
		</div> 

		<div id="headerwrap" style="padding-top: 150px; min-height: 590px;">
			<div class="container">
					<div class="col-lg-6 col-lg-offset-3">
						<form action="adminCars.php">
							<h1 style="color: #041530">Comment reply posted.<h1>
							<button name="submit" class="btn" style="background: #041530; 
							color: white; width: 300px; height: 100 px;  font-size:20px; margin-right:100px">Return to previous page</button>
						</form>
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