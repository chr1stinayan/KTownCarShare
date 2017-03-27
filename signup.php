<?php

if (!isset($_POST['sign_up'])){
	if(isset($_SESSION['Member_ID'])) {
		session_start();
		header("Location: chat.php");
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
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
			<meta name="author" content="VMS&amp;SN&amp;BB&amp;VH">
		<link rel="shortcut icon" href="img/logo v1.jpg">
		<title>K-Town Car Share - Sign Up</title>
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
						<li><a href="login.php">Already a member?</a></li>
					</ul>
					</div>
				</div>
			</div>
		<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h1 style="text-align: center">Welcome aboard.</h1>
					</div>
					<div class="col-lg-6 col-lg-offset-3">
						<form name='signup' id='signup' action='signup.php' method='POST'>
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
						 	<div class="form-group">
								<input style="width: 100%;" type="email" class="form-control" name="Email" id="Email" placeholder="Email Address">
								<script>
										var captured = /email=([^&]+)/.exec(window.location.href)[1];
										var result = captured ? captured : '';
										result = result.replace('%40','@');
										document.getElementById("Email").value = String(result);

								</script>
						  	</div>
							<div class="form-group">
								<input style="width: 100%;" type="text" class="form-control" name="Phone" id="Phone" placeholder="Phone #">
								<input style="width: 100%;" type="text" class="form-control" name="License Number" id="License Number" placeholder="License Number">
									
						 	</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-3">
										<select style="width: 200%;" type="text" class="form-control" name="Membership Type" id="Membership Type">
												<option value="" selected disabled>Membership Type</option>
												<option>Basic</option>
												<option>Bronze</option>
												<option>Silver</option>
												<option>Gold</option>
										</select>
									</div>
								</div>
							</div>
						 	<div class="form-group">
								<input style="width: 100%;" type="password" class="form-control" name="Password" id="Password" placeholder="Create Password">
						 	</div>
						 	<div style="text-align: center">
								<button type="submit" name='sign_up' class="btn btn-default">Sign Up</button>
							</div>
						</form>
						<?php
						if (isset($_GET["msg"]) && $_GET["msg"] == 'bademail') {
						echo "<br><div align='center'><span class='label label-danger'>Email already in use :(</span></div>";
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
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
		</body>
</html>