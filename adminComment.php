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
						<li><a href="maintain.php">Maintainence</a></li> 
						<li><a href="generateInvoice.php">Generate Invoice</a></li>  
						<li><a href="editProfile.php">My Profile</a></li> 
						<li><a href="signOut.php">Sign Out</a></li>             
					</ul> 
				</div> 
			</div> 
		</div> 
	  
		<div id="headerwrap" style="padding-top: 150px; min-height: 590px;">
			
				<?php
					$getMemberNameQueryResult = "SELECT firstName, lastName, VIN, commentID, commentText, rating FROM member NATURAL JOIN rentalhistory NATURAL JOIN membercomments WHERE reservationNumber = ".$_SESSION['reservationNumber']."";
					$getMemberNameQueryResult = mysqli_query($con, $getMemberNameQueryResult);
					if(!$getMemberNameQueryResult){
							printf("Error: %s\n", mysqli_error($con));
							exit();
					}
					if(mysqli_num_rows($getMemberNameQueryResult)==0){
						echo "<br><h2 style='color: #041530' align='center'>User has not commented on car ".$_SESSION['VIN'].".</h2>";
					}
					else {
						echo "<table style='color: #041530' align='center' frame='void'>";
						echo "<tr><th>VIN</th><th>Member Name</th><th>Comment</th><th>Rating</th></tr>";
						while($row=mysqli_fetch_array($getMemberNameQueryResult)){
							$_SESSION['firstName'] = $row['firstName'];
							$_SESSION['lastName'] = $row['lastName'];
							$_SESSION['commentID'] = $row['commentID'];
							echo "<tr style='color: #041530' align='center'>
									<td>".$row['VIN']."</td>
									<td>".$row['firstName']."</td>
									<td>".$row['lastName']."</td>
									<td>".$row['commentText']."</td>
									<td>".$row['rating']."</td>										
									<td>
										<form action='editAdminComment.php?reservationNumber=".$_SESSION['reservationNumber']."'VIN=".$_SESSION['VIN']."'firstName=".$_SESSION['firstName']."'lastName=".$_SESSION['lastName']."'commentID=".$_SESSION['commentID']."' method=\"POST\">
												<button type=\"submit\" class=\"btn btn-warning btn-sm\" style='width:100%; height:100%;'>Reply To Comment</button>													
										</form>												
									</td>
									</tr>";
							}
							echo "<br></table><br>";
							
						}
					?>
					<form action="adminCars.php" align="center">
						<button type="submit" class="btn btn-sm" name="cancel" style="background: #041530; 
						color: white; width: 300px; height: 45px;  font-size:20px">Return to previous page</button>
					</form></div>
				<div class="container">
			<hr>
			<p class="centered">CISC 332 Final Project created by Christina Yan &amp; Vinith Suriyakumar.</p>
		</div>
	</body>
</html>
