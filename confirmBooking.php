<?php
	session_start();
	$_SESSION['Lot List'] = $lot;
	echo $lot
?>
<html>
<body>	
				<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Confirm Booking Details</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<p style="color: #041530">Car: </p>
						<p id="carSel" style="color: #041530"></p>
					</div>
					<div class="row">
						<p style="color: #041530">Pick up location: ?php echo $_POST["lot"]; ?</p>
						<p id="lotSel" style="color: #041530"></p>
					</div>
					<div class="row">
						<p style="color: #041530">Pick up date: </p>
						<p id="pDateSel" style="color: #041530"></p>
					</div>
					<div class="row">
						<p style="color: #041530">Pick up time: </p>
						<p id="pTimeSel" style="color: #041530"></p>
					</div>
					<div class="row">
						<p style="color: #041530">Return date: </p>
						<p id="rDateSel" style="color: #041530"></p>
					</div>
					<div class="row">
						<p style="color: #041530">Return time: </p>
						<p id="rTimeSel" style="color: #041530"></p>
					</div>
				</div>
				<div class="modal-footer">
					<div class="btn-group">								
						<form action='/confirmation.php'>
							<button type="Submit" class="btn btn-primary">Confirm booking</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</form>			
					</div>
				</div>
			</div>

		</div>
	</div>		

</body>
</html>