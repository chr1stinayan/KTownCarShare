∏<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="VMS&amp;SN&amp;BB&amp;VH">

    <link rel="shortcut icon" href="img/favicon.png">

    <title>K-Town Car Share - Where will your next trip take you? </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	
  
  <style>
  #headerwrap{
    background-color: #ffd1de;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    }
  </style>

  </head>

  <body>

  	<?php
	  //Create a user session or resume an existing one
	 session_start();
	?>

	<?php
	 //check if the user is already logged in and has an active session
	if(isset($_SESSION['Member_ID'])) {
		//Redirect the browser to the profile editing page and kill this page.
		header("Location: userdash.php");
		die();
	}
	?>

    <!-- Fixed navbar -->
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

            		<li><a href="login.php"><h4 style="color:#ffd1de">Already a member?</h4></a></li>

         		</ul>

        	</div>
        	<!--/.nav-collapse -->

	    </div>

    </div>

	<div id="headerwrap">

		<div class="container">

			<div class="row">

				<div class="col-lg-6 col-lg-offset-3">

					<h1>Quick, convenient car share service.</h1>
					<h1 style="color:#041530">Rent a car with us!</h1>

					<form action="signup.php" method="GET" class="form-inline" role="form">

						<div class="form-group">

					 		<input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="youremail@address.ca">

						</div>

						<button type="submit" class="btn btn-warning btn-lg" value="Submit">Sign Me Up!</button>

					</form>

				</div>
				<!-- /col-lg-6 -->

				<div class="col-lg-6">

				</div>
				<!-- /col-lg-6 -->

			</div>
			<!-- /row -->

		</div>
		<!-- /container -->

	</div>
	<!-- /headerwrap -->

	<div class="container">

		<div class="row mt centered">

			<div class="col-lg-6 col-lg-offset-3">

				<h1>Car sharing made simple.</h1>

			</div>

		</div>
		<!-- /row -->

		<div class="row mt centered">

			<div class="col-lg-4">

				<a href="chat.php"><img src="img/car.png" height="180" alt=""></a>

				<h4>From economy to luxury.</h4>

				<p>Choose from a wide selection of vehicles.<br>For any occasion or trip, KTCS has the car for you.</p>

			</div>
			<!--/col-lg-4 -->

			<div class="col-lg-4">

				<a href="journal.php"><img src="img/booking.png" height="180" alt=""></a>

				<h4>Easy reservations.</h4>

				<p>Instant online booking system.<br>Pickup your car within minutes of booking.</p>

			</div>
			<!--/col-lg-4 -->

			<div class="col-lg-4">

				<a href="jentries.php"><img src="img/parking.png" height="180" alt=""></a>

				<h4>Pickup Locations.</h4>

				<p>Lots near Queen's, RMC and SLC.<br>Pickup and drop off your car at any lot of your choice.</p>

			</div>
			<!--/col-lg-4 -->

		</div>
		<!-- /row -->

	</div>
	<!-- /container -->

	<div class="container">

		<hr>

		<div class="row centered">

            <div class="row centered">

                <div class="col-lg-6 col-lg-offset-3">

                    <h1>K-Town Car Share starts local.</h1>

                    <h3>Where will your next trip take you?</h3>

                </div>

            </div>

			<div class="col-lg-6 col-lg-offset-3">

				<form action="signup.php" method="GET" class="form-inline" style="margin-top:1em" role="form">

					<div class="form-group">

				 		<input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="youremail@address.ca">

					</div>

					<button type="submit" class="btn btn-warning btn-lg" value="Submit">Sign Me Up!</button>

				</form>

			</div>

		</div>
		<!-- /row -->

		<hr>

	</div>
	<!-- /container -->

	<div class="container">

		<p class="centered">CISC 332 Final Project created by Christina Yan &amp; Vinith Suriyakumar.</p>

	</div>
	<!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

  </body>

</html>
