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
					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-100">
							<h1 style="color: #041530">Generate an invoice<br><h1>
							<h2 style="color: #041530">Find a KTCS member<br><h2>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-6">
										<input style="width: 100%;" type="text" class="form-control" name="FirstName" id="FirstName" placeholder="First Name">
									</div>
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-6">
										<input style="width: 100%;" type="text" class="form-control" name="LastName" id="LastName" placeholder="Last Name">
									</div>
								</div>
							</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-6">
										<input style="width: 100%;" type="text" class="form-control" name="Email" id="Email" placeholder="Email Address">
									</div>
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-6">
										<input style="width: 100%;" type="text" class="form-control" name="PhoneNo" id="PhoneNo" placeholder="Phone Number">
									</div>
								</div>
							</div>
							
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-6">
										<input style="width: 100%;" type="text" class="form-control" name="LicenseNo" id="LicenseNo" placeholder="License Number">
									</div>
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-6">
										<input style="width: 100%;" type="text" class="form-control" name="MemberNo" id="MemberNo" placeholder="Member Number">
									</div>
								</div>
							</div>
							<div align="center">
								<button  type="Submit" class="btn btn-warning">Search</button>
							</div>
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