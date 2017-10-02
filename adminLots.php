<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
			<meta name="author" content="VMS&amp;SN&amp;BB&amp;VH">
		<link rel="shortcut icon" href="img/logo v1.jpg">
		<title>K-Town Car Share - Lots</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<body>
	<?php
		session_start();
        if($_SESSION['userType']=='client'){
            header('Location: profile.php');
            exit();
        }

        if(isset($_GET['deleteLots'])){
            $lotsQueryResult = "DELETE FROM PARKINGLOCATIONS WHERE lotAddress=?".$_GET['deleteLots']."";
			$lotsQueryResult = mysqli_query($con,$lotsQueryResult);
			if (!$lotsQueryResult) {
    			printf("Error: %s\n", mysqli_error($con));
   				exit();
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
					<ul class="nav navbar-nav navbasr-right" style="padding-top: 15px;">
						<li><a href="cars.php">Cars</a></li>
						<li><a href="lots.php">Pickup & Dropoff Lots</a></li>
						<li><a href="currentRes.php">My Reservations</a></li>
						<li><a href="newRes.php">New Booking</a></li>
						<li><a href="editprofile.php">My Profile</a></li>
						<li><a href="login.php?logout=1">Sign Out</a></li>						
					</ul>
					</div>
				</div>
			</div>
		<div id="headerwrap" style="padding-top: 50px; min-height: 590px;">
			<div class="container">
				<div class="form-group">
					<div class="col-lg-9-offset-1" style="padding-bottom:15px">
						<h1 style="text-align: center; color: #041530;">Locations</h1>
				</div>
				<div class="form-group">
					<?php
						
						include 'config/connection.php';
						$lotsQueryResult = "SELECT DISTINCT * FROM PARKINGLOCATIONS";
						$lotsQueryResult = mysqli_query($con,$lotsQueryResult);
						if (!$lotsQueryResult) {
    						printf("Error: %s\n", mysqli_error($con));
   							exit();
						}
						while($rowLotName = mysqli_fetch_array($lotsQueryResult)){
							echo "<div class='row' style='padding-bottom: 45px'>";
							echo "<div class='col-md-3'>";
							echo "<img src='".$rowLotName['imageLink']."'height=180px/>";
							echo "</div>";
							echo "<div class='col-md-7' style='padding-left:15px;'>";
							echo "<ul style='color: #041530'>";
							echo "<li> Address: ".$rowLotName['lotAddress']. "</li>";
							echo "<li> Number Of Cars: ".$rowLotName['numberOfCars']. "</li>";
							echo "</ul>";
							echo "</div>";
                            echo" <div style='text-align: center;'>";
                                    echo"<form name='locationDelete' id='locationDelete' action='adminLots.php?deleteLots=".$rowLotName['lotAddress']."' method='POST'>";
								    echo "<button type='submit' class='btn btn-warning btn-lg' name='deleteLot'>Delete</button>";
                                    echo "</form>";
                                    echo"<form name='availableCars' id='availableCars' action='adminLots.php?availableCars=".$rowLotName['lotAddress']."' method='POST'>";
								    echo "<button type='submit' class='btn btn-warning btn-lg' name='availableCars'>Available Cars</button>";
                                    echo "</form>";
                                    echo "</div>";
							echo "</div>";
						}
					?>
				</div>
                <?php
                    if(isset($_GET['availableCars'])){
                        include 'config/connection.php';
                        $today = date("Y-m-d H:i:s");
                        $availableCarsResult = "SELECT * FROM CAR LEFT JOIN RESERVATION on car.VIN = Reservation.VIN WHERE CAR.VIN NOT IN (SELECT VIN FROM CAR NATURAL JOIN RESERVATION WHERE startDateTime='".$today."') AND Car.lotAddress='".$_GET['availableCars']."' AND Car.carCondition='normal'";
                        $availableCarsResult = mysqli_query($con,$availableCarsResult);
                        if(!$availableCarsResult){
                            printf("Error: %s\n", mysqli_error($con));
   							exit();
                        }else{
                            while($rowCarName = mysqli_fetch_array($availableCarsResult)){
                                echo "<div class='row' style='padding-bottom: 45px'>";
                                echo "<div class='col-md-3'>";
                                echo "<img src='".$rowCarName['imageLink']."'height=180px/>";
                                echo "</div>";
                                echo "<div class='col-md-7' style='padding-left:15px;'>";
                                echo "<ul style='color: #041530'>";
                                echo "<li> Make: ".$rowCarName['VIN']. "</li>";
                                echo "<li> Model: ".$rowCarName['model']. "</li>";
                                echo "<li> Year: " .$rowCarName['year']. "</li>";
                                echo "<li> Address: ".$rowCarName['lotAddress']. "</li>";
                                echo "<li> Daily Fee: $".$rowCarName['dailyFee']."</li>";
                                echo "</ul>";
                                if($rowCarName['reservationNumber']==NULL){
                                      echo "<form name='makeReservation' id='makeReservation' action='newBooking.php?VIN=".$rowCarName['VIN']."' method='POST'>";
                                    echo "<div class='form-group' style='padding-left: 15px'>";
                                    echo "<button type='submit' class='btn' style: 'background-color:#041530' >Make A Reservation</button>";
                                    echo "</div>";
                                    echo "</form>";
                                }
                                echo "</div>";
                                echo "</div>";
						}
                        }
                    }
                ?>
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