<?php

if (!isset($_POST['sign_up'])){
	if(isset($_SESSION['memberNum'])) {
		session_start();
		header("Location: profile.php");
		die();
	}
}
else {
		include_once 'config/connection.php';
			$query = "SELECT email FROM KTCSMembers WHERE email=?";
			if($stmt = $con->prepare($query)) {
				$stmt->bind_Param("s", $_POST['Email']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num = $result->num_rows;
		if($num===0) {
					$query = "INSERT INTO KTCSMembers (memberName,password,address,email,licenseNum,membershipFee,creditCardNumber)
					VALUES ('$_POST[MemberName]','$_POST[Password]','$_POST[Address]','$_POST[Email]','$_POST[LicenseNum]','$_POST[MembershipFee]','$_POST[CreditCardNumber]')";
					mysqli_query($con,$query);
					$query = "SELECT memberNum FROM KTCSMembers WHERE Email = '$_POST[Email]'";
					$myrow = mysqli_query($con,$query)->fetch_assoc();
			$_SESSION['memberNum'] = $myrow['memberNum'];
			header("Location:profile.php");
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
				</div>
					<div class="col-lg-6 col-lg-offset-3">
						<form name='signup' id='signup' action='signup.php' method='POST'>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-12">
										<input style="width: 100%;" type="text" class="form-control" name="MemberName" id="MemberName" placeholder="Full Name">
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
								<div class="row" style="padding-bottom: 15px; padding-left: 15px; padding-right: 15px;">
									<input style="width: 100%;" type="text" class="form-control" name="Phone" id="Phone" placeholder="Phone #">
								</div>
								<div class="row" style="padding-bottom: 15px; padding-left: 15px; padding-right: 15px;">
									<input style="width: 100%;" type="text" class="form-control" name="Address" id="Address" placeholder="Home Address">
								</div>
								<div class="row" style="padding-left: 15px; padding-right: 15px;">
									<input style="width: 100%;" type="text" class="form-control" name="LicenseNum" id="LicenseNum" placeholder="License Number">
								</div>	
						 	</div>
							<div class="row" style="padding-bottom: 15px;">
								<div class="form-group">
									<div style='padding-right: 15px; padding-left: 15px;' class="col-md-12">
										<select style="width: 100%;" type="text" class="form-control" name="MembershipFee" id="MembershipFee">
												<option value="" selected disabled>Membership Type</option>
												<option value=0.00>Basic</option>
												<option value=100.00>Bronze</option>
												<option value=250.00>Silver</option>
												<option value=500.00>Gold</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input style="width: 100%;" type="password" class="form-control" name="CreditCardNumber" id="CreditCardNumber" placeholder="XXXX-XXXX-XXXX-XXXX">
						 	</div>
						 	<div class="form-group">
								<input style="width: 100%;" type="password" class="form-control" name="Password" id="Password" placeholder="Create Password">
						 	</div>
						 	<div style="text-align: center; padding-bottom: 15px;">
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