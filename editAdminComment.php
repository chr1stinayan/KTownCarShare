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
	
    <title>K-Town Car Share - Admin Comment</title>
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
			<div class="container">
				<h1 style="color: #041530" style="text-align:center">Reply to comment from <?php echo $_SESSION['firstName'], " ".$_SESSION['lastName'] ?></h1>
					<form name='makeComment' id='makeComment' action='confirmAdminComment.php' method='POST'>
					<div class="form-group">
						<input style="width: 100%;" name="adminComment" class="form-control" id="adminComment" placeholder="Type something here...">
						<br>
						<button name="submit" class="btn" style="background: #041530; 
						color: white; width: 300px; height: 100 px;  font-size:20px; margin-right:100px">Submit comment</button>
					</div>
					
					<?php
						include 'config/connection.php';
						if (isset($_POST['adminComment'])){
							$insertNewComment = "INSERT INTO adminComments(VIN, adminID, commentText, correspondingMemberCommentID, adminDateTime) VALUES('".$_SESSION['VIN']."', '".$_SESSION['memberNumber']."','".$_POST['adminComment']."', '".$_SESSION['commentID']."','".date('y:m:d h:i:s')."')";
							mysqli_query($con, $insertNewComment);
							header('Location: confirmAdminComment.php');
						}								
					?>
				</form>
					<form action="adminCars.php">
					<button type="submit" class="btn" name="cancel" style="background: #041530; 
					color: white; width: 300px; height: 45px;  font-size:20px">Cancel</button>
				</form>
			</div>
		<div class="container">
			<hr>
			<p class="centered">CISC 332 Final Project created by Christina Yan &amp; Vinith Suriyakumar.</p>
		</div>
	</body>
</html>
