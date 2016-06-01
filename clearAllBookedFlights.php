<?php
include 'globals.php';
session_start ();
$_SESSION ['allBookedFlights'] = array ();
?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="well row" style="margin-top: 5%;">
		<h3 style="margin-bottom: 20px; font-weight: bold;">All booked flights
			deleted</h3>
		<form role="form" id="allBookedFlightsForm" class="shake">

			<h4 style="margin-bottom: 10px;">You have no bookings</h4>
					
		</form>
	</div>
</div>
