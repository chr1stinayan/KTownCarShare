<?php
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
						<h1 style="color: #041530" style="text-align:center">Add Comment for vehicle <?php echo $_SESSION['vin']; ?></h1>
						<form name='makeComment' id='makeComment' action='editComment.php' method='POST'>
						 	<div class="form-group">
						    	<input style="width: 100%;" name="userComment" class="form-control" id="userComment" placeholder="Say something about your experience...">
								<h2 style="color: #041530">Rate your vehicle </h2>
								<select style="width: 100%;" type="text" class="form-control" name="rating" id="rating">
										<option value=1>1</option>
										<option value=2>2</option>
										<option value=3>3</option>
										<option value=4>4</option>
										<option selected="selected" value=5 default>5</option>
								</select>
								<br></br>
								<button name="submit" class="btn" style="background: #041530; 
						color: white; width: 300px; height: 100 px;  font-size:20px; margin-right:100px">Submit comment</button>
							</div>
							<?php
								include 'config/connection.php';
								$memberNum = $_SESSION['memberNumber'];
								if (isset($_POST['userComment'])){
									$insertNewComment = "INSERT INTO memberComments(VIN, memberNumber, commentText, commentDateTime, rating) VALUES('".$_SESSION['vin']."', '".$memberNum."', '".$_POST['userComment']."', '".date('y:m:d h:i:s')."', '".$_POST['rating']."')";
									mysqli_query($con, $insertNewComment);
									header('Location: confirmComment.php');
								}								
							?>
						</form>
					</div>
					<form action="rentalHistory.php">
						<button type="submit" class="btn" name="cancel" style="background: #041530; 
						color: white; width: 300px; height: 45px;  font-size:20px">Cancel</button>
					</form>
			</div>
		</div>
	</body>
</html>
