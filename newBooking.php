<?php
	if (!isset($_POST['sign_up'])){
		if(isset($_SESSION['Member_ID'])) {
			session_start();
			header("Location: profile.php");
			die();
		}
	}
	else {
			include_once 'config/connection.php';
				$query = "SELECT Email FROM Member WHERE Email=?";
				if($stmt = $con->prepare($query)) {
					$stmt->bind_Param("s", $_POST['Email']);
			$stmt->execute();
			$result = $stmt->get_result();
			$num = $result->num_rows;
			if($num===0) {
						$query = "INSERT INTO Member (F_Name,L_Name,Email,Phone_No,Grad_Year,Faculty,Degree_Type,Password)
						VALUES ('$_POST[FirstName]','$_POST[LastName]','$_POST[Email]','$_POST[Phone]','$_POST[Year]','$_POST[Faculty]','$_POST[Degree]','$_POST[Password]')";
						mysqli_query($con,$query);
						$query = "SELECT Member_ID FROM Member WHERE Email = '$_POST[Email]'";
						$myrow = mysqli_query($con,$query)->fetch_assoc();
				$_SESSION['Member_ID'] = $myrow['Member_ID'];
				header("Location:chat.php");
				exit();
			} else {
				error_log("Email already in use");
				header("Location:signup.php?msg=bademail");
			}
		} else {
			echo "failed to prepare the SQL";
		}
	}
?>
<!DOCTYPE html>
var date = ""
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
		<link href="css/bootstrap-datepicker.css", rel="stylesheet">		
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script type="text/javascript">
		   $(function(){
				$("#pDate").datepicker({
					minDate:0,
					onSelect: function(date){
						$("#rDate").datepicker('option','minDate',date);
					}
				});
		   });
		</script>
	    <script type="text/javascript">
		   $(function(){
				$("#rDate").datepicker({});
		   });
        </script>
		<script type="text/javascript">
		   $(function(){
				$("#pTime").timepicker();
		   });
        </script>
		<script type="text/javascript">
		   $(function(){
				$("#rTime").timepicker();
		   });
        </script>
				
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
						<h1 style="color: #041530">Make a reservation<h1>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<select style="width: 100%;" type="text" class="form-control" name="Membership Type" id="Membership Type">
								<option value="" selected disabled>Select car tier</option>
								<option>Basic</option>
								<option>Bronze</option>
								<option>Silver</option>
								<option>Gold</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<select style="width: 100%;" type="text" class="form-control" name="Membership Type" id="Membership Type">
								<option value="" selected disabled>Pick up location</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<h2 style="color: #041530">Pick-up date<h2>
						<form method="post" action="">
							Pick up date : <input type="text" name="pDate" id="pDate"/>
						</form>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<h2 style="color: #041530">Pick-up time<h2>
						<form>
							<input type="text" name="pTime" id="pTime"/>
						</form>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<h2 style="color: #041530">Return date<h2>
						<form method="post" action="">
							Pick up date : <input type="text" name="rDate" id="rDate"/>
						</form>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<h2 style="color: #041530">Return time<h2>
						<form>
							<input type="text" name="rTime" id="rTime"/>
						</form>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<button type="submit" class="btn btn-warning btn-lg" value="Submit">Search available cars</button>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-6 col-lg-offset-0">
						<h2 style="color: #041530">Available Cars<h2>
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