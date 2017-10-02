<?php 
	session_start();
	include 'config/connection.php';
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
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown">Member Profile
								<ul class="dropdown-menu">
								<li><a href="profile.php">My Profile</a></li>
								<li><a href="editProfile.php">Edit Profile</a></li>
								</ul>
							</li>
							<li><a href="signOut.php">Sign Out</a></li>             
						</ul> 
					</div> 
				</div> 
			</div> 
			
			<div id="headerwrap" style="padding-top: 150px; min-height: 590px;"> 					
				<div class="container">
					<div class="form-group">
						<div class="col-lg-9-offset-1 col-lg-offset-100" style="padding-bottom:15px">
							<h1 style="text-align: center; color: #041530">Generate an invoice<br><h1>
						</div>
						<div class="row">
							<div class="col-lg-4 col-lg-offset-4">
								<h2 style="text-align: center; color: #041530">Find a KTCS member<br><h2>
								<form name='searchMembers' id='searchMembers' action='generateInvoice.php' method='POST'>
									<div class="form-group">
										<input style="width: 100%;" type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name">
									</div>
									<div class="form-group">
										<input style="width: 100%;" type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input style="width: 100%;" type="text" class="form-control" name="email" id="email" placeholder="Email Address">
									</div>
									<div class="form-group">
										<input style="width: 100%;" type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Phone Number">
									</div>
									<div class="form-group">
										<input style="width: 100%;" type="text" class="form-control" name="licenseNumber" id="licenseNumber" placeholder="License Number">
									</div>
									<div class="form-group">
										<input style="width: 100%;" type="text" class="form-control" name="memberNumber" id="memberNumber" placeholder="Member Number">
									</div>
									<div class="form-group">
										<input  type="Submit" class="btn btn-warning" name="searchMembersButton"></>
									</div>						
								</form> SELECT DISTINCT * F ( rentalhistory join car using(VIN)) using(memberNumber)
							</div>
						</div>
						<?php if(isset($_POST['searchMembersButton'])) : ?>
						<div class="form-group">
							<?php 
								$memberQueryResult = "SELECT * FROM member JOIN (rentalhistory JOIN car USING(VIN)) USING(memberNumber)";
								$additionalTerms = "";		
								
								if (!empty($_POST['firstName'])) {
									$additionalTerms = $additionalTerms." firstName=".$_POST['firstName'];
								}
								if (!empty($_POST['lastName'])) {
									$additionalTerms = $additionalTerms." AND lastName=".$_POST['lastName'];
								}
								if (!empty($_POST['email'])) {
									$additionalTerms = $additionalTerms." AND email=".$_POST['email'];
								}
								if (!empty($_POST['phoneNumber'])) {
									$additionalTerms = $additionalTerms." AND phoneNumber=".$_POST['phoneNumber'];
								}
								if (!empty($_POST['licenseNumber'])) {
									$additionalTerms = $additionalTerms." AND licenseNumber=".$_POST['licenseNumber'];
								}
								if (!empty($_POST['memberNumber'])) {
									$additionalTerms = $additionalTerms." AND memberNumber=".$_POST['memberNumber'];
								}
								
								if(!($additionalTerms=="")){
									$memberQueryResult = $memberQueryResult." WHERE ".$additionalTerms;
								}
								$memberQueryResult = mysqli_query($con,$memberQueryResult);
								
								if (!$memberQueryResult) {
									printf("Error: %s\n".$memberQueryResult, mysqli_error($con));
									exit();
								}
								if (mysqli_num_rows($memberQueryResult)==0){
									echo "No registered members found";
								}
								else {
									echo "<table frame='void'>";
									echo "<h2>Member query results</h2>";
									echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>License Number</th><th>Member Number</th><th></th></tr>";
									while($row = mysqli_fetch_array($memberQueryResult)){
										$_SESSION['firstName'] = $row['firstName'];
										$_SESSION['lastName']= $row['lastName'];
										$_SESSION['email'] = $row['email'];
										$_SESSION['phoneNumber'] = $row['phoneNumber'];
										$_SESSION['licenseNumber'] = $row['licenseNumber'];
										$_SESSION['memberNumber'] = $row['memberNumber'];
										$_SESSION['pickUpDateTime'] = $row['pickUpDateTime'];
										$_SESSION['dropOffDateTime'] = $row['dropOffDateTime'];
										
										echo "<tr>
											<td>".$row['firstName']."</td>
											<td>".$row['lastName']."</td>
											<td>".$row['email']."</td>
											<td>".$row['phoneNumber']."</td>
											<td>".$row['licenseNumber']."</td>
											<td>".$row['memberNumber']."</td>
											<td>
												<form action='showInvoice.php' method=\"POST\">
													<button type=\"submit\" class=\"btn btn-warning btn-lg\" style='width:100%; height:100%;'>Get Invoice</button>													
												</form>												
											</td>
										</tr>";
									}
								}
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			
			<div class="container"> 
				<p class="centered">CISC 332 Final Project created by Christina Yan &amp; Vinith Suriyakumar.</p> 
			</div> 
		<script src="js/bootstrap.min.js"></script> 
	</body> 
</html>