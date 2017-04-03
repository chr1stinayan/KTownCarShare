<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="img/favicon.png">
		<title>K - Town Car Share: Log In</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<body>
	<?php
		session_start();
		if(isset($_GET['logout'])){
			$_SESSION['memberNum'] = null;
			session_destroy();
		}
		if(!isset($_POST['signin'])) {
			if(isset($_SESSION['memberNum'])) {
				session_start();
				header("Location: profile.php");
				die();
			}
		}
		else {
				include_once 'config/connection.php';
			//Create a user session or resume an existing one
			session_start();
					$query = "SELECT memberNum, memberName, password, email FROM KTCSMembers WHERE email=? AND password=?";
					if($stmt = $con->prepare($query)) {
						$stmt->bind_Param("ss", $_POST['Email'], $_POST['Password']);
				$stmt->execute();
				$result = $stmt->get_result();
				$num = $result->num_rows;
				if($num>0){
					$myrow = $result->fetch_assoc();
					$_SESSION['memberNum'] = $myrow['memberNum'];
					$_SESSION['firstName'] = $myrow['firstName'];
					header("Location: profile.php");
					exit();
				} else {
					error_log("Failed to login");
					header("location:login.php?msg=failed");
				}
			} else {
				echo "Failed to prepare the SQL";
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
	         		<ul class="nav navbar-nav navbar-right">
	            		<li><a href="signup.php">Not a member?</a></li>
	         		</ul>
	        	</div>
	      	</div>
	    </div>
		<div id="headerwrap" style="padding-top: 100px; min-height: 590px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<h1 style="text-align:center">Welcome back.</h1>
						<form name='login' id='login' action='login.php' method='POST'>
						 	<div class="form-group">
						    	<input style="width: 100%;" name="Email" type="email" class="form-control" id="Email" placeholder="youremail@address.ca">
						  	</div>
						 	<div class="form-group">
						    	<input style="width: 100%;" name="Password" type="password" class="form-control" id="Password" placeholder="Password">
						 	</div>
						 	<div style="text-align: center">
								<button type="submit" class="btn btn-warning btn-lg", name="signin">Sign In</button>
							</div>
						</form>
						<?php
						if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
						echo "<br><div align='center'><span class='label label-danger'>Wrong Email or Password :(</span></div>";
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
