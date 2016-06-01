<?php
include 'globals.php';
function getBookedFlight($bookedFlight) {
	
	$token = strtok ( $bookedFlight, "{\":[}]" );
	$flight = new BookedFlight ();
	
	while ( $token !== false ) {
		if ($token == constant ( "ROUTENO" )) {
			$token = strtok ( '{,\":[}]' );
			
			$flight->routeNo = $token;
		} 
		
		else if ($token == constant ( "FROMCITY" )) {
			$token = strtok ( '{,\":[}]' );
			$flight->fromCity = $token;
		} else if ($token == constant ( "TOCITY" )) {
			$token = strtok ( '{,\":[}]' );
			$flight->toCity = $token;
		} else if ($token == constant ( "PRICE" )) {
			$token = strtok ( '{,\":[}]' );
			$flight->price = $token;
		}
		else if ($token == constant ( "NUMBERTICKET" )) {
			$token = strtok ( '{,\":[}]' );
			$flight->numberTicket = $token;
		} else if ($token == constant ( "NUMBERCHILDREN" )) {
			$token = strtok ( '{,\":[}]' );
			$flight->numberChildren = $token;
		} else if ($token == constant ( "NUMBERWHEELCHAIR" )) {
			$token = strtok ( '{,\":[}]' );
			$flight->numberWheelchair = $token;
		} else if ($token == constant ( "NUMBERSPECIALDIET" )){
			
			$token = strtok ( '{,\":[}]' );
			
			$flight->numberSpecialDiet = $token;
		}
		
		$token = strtok ( '{,\":[}]' );
	}
	
	return $flight;
}


$sessionArray;
$selectedFlightStr = $_GET ['selectedFlight'];
$selectedFlight = getBookedFlight ( $selectedFlightStr );

session_start ();
if (!isset($_SESSION['bookingNo'])){
	$_SESSION['bookingNo']=0;
}
if (! isset ( $_SESSION ['allBookedFlights'] )) {
	$_SESSION ['allBookedFlights'] = array ();
}
$selectedFlight->bookingId = ++$_SESSION['bookingNo'];
$_SESSION ['allBookedFlights'] [] = $selectedFlight;
$allBookedFlights = $_SESSION ['allBookedFlights'];
?>
<div class="col-sm-8 col-sm-offset-2">
	<div class="well row" style="margin-top: 5%;">
		<h3 style="margin-bottom: 20px; font-weight: bold;">All Booked Flights</h3>
		<form role="form" id="allBookedFlightsForm" class="shake">
			<?php
			    if (count($allBookedFlights) == 0){
			    	echo '<h4 style="margin-bottom: 10px;"> You have no bookings </h4>';
			    }else{
			?>
			<table class="table">
				<thead>
					<tr>
						<th>Origin</th>
						<th>Destination</th>
						<th>Fare</th>
						<th>Tickets</th>
						<th>Children</th>
						<th>Wheelchair</th>
						<th>Special Diet</th>
						
					</tr>
				</thead>
				<tbody>
				<?php 
				  for($i =0;$i<count($allBookedFlights);$i++){
				  	$flight = $allBookedFlights[$i];
				  	
				  	echo "<tr>
		                    <td>".$flight->fromCity."</td>
							<td>".$flight->toCity."</td>
							<td>".$flight->price."</td>
							<td>".$flight->numberTicket."</td>
							<td>".$flight->numberChildren."</td>
							<td>".$flight->numberWheelchair ."</td>
							<td>".$flight->numberSpecialDiet ."</td>";

				  }// end for($i =0;$i<count($allBookedFlights);$i++){
			    }//else if (count($allBookedFlights) == 0){
				?>
				</tbody>
			</table>
			
				<button id="bookMoreFlightsBtn"
					style="padding: 5px; margin-right: 10px; margin-left: 8px;"
					class="btn btn-success btn-lg pull-left ">Book More</button>
					<button id="clearAllBookedFlightsBtn"
					style="padding: 5px; margin-right: 10px; margin-left: 8px;"
					class="btn btn-success btn-lg pull-left ">Clear Flights</button>
					<button id="proceedToCheckoutBtn"
					style="padding: 5px; margin-right: 10px; margin-left: 8px;"
					class="btn btn-success btn-lg pull-left ">Checkout</button>
				<div id="dialog-4" title="All Booked Flights!"></div>
			
		</form>
	</div>
</div>
<script>
$( "#dialog-4" ).dialog({
	modal: true,
    autoOpen: false,
    buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }  
 });
 
 $("#bookMoreFlightsBtn").click(function(e){
	
	 e.preventDefault();
	 console.log("return the users to search option");
	 $.ajax({
			url : "searchFlights.php",
			success : function(result) {
				$("#mainContent").html(result);
			}
	});
 });
 $("#clearAllBookedFlightsBtn").click(function(e){
		 e.preventDefault();
		 console.log("Clear all booked flights");
		 $.ajax({
				url : "clearAllBookedFlights.php",
				success : function(result) {
					$("#mainContent").html(result);
				}
		});
 });
 $("#proceedToCheckoutBtn").click(function(e){
			 e.preventDefault();
			 console.log("proceed booked flights");
			 $.ajax({
					url : "checkoutStage1.php",
					success : function(result) {
						$("#mainContent").html(result);
					}
			});
 });
</script>

