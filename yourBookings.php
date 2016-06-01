<?php
include 'globals.php';
session_start ();
$customer = $_SESSION ['customer'];

$seesionBookingNo = $_SESSION ['bookingNo'];
$allBookedFlights = $_SESSION ['allBookedFlights'];
$selectedBookings = $_REQUEST ['selectedBookings'];
if (($selectedBookings != "") and (selectedBookings != null)) {
	
	// delete button call back
	$selectedArray = array ();
	$token = strtok ( $selectedBookings, ',\"' );
	while ( $token !== false ) {
		$selectedArray [] = $token;
		 $token = strtok ( ',\"' );
	}
	
	// echo "count of selectedArray: ".count($selectedArray);
	
	$i = 0;
	while ( ($i < count ( $allBookedFlights )) and (count ( $selectedArray ) > 0) ) {
		$index = array_search ( $allBookedFlights [$i]->bookingId, $selectedArray );
		if (($index !== FALSE)) {
			// echo $i.": ".$temp[$i]->bookingId;
			array_splice ( $allBookedFlights, $i, 1 );
			array_splice ( $selectedArray, $index, 1 );
		} else {
			$i ++;
		}
	}
}

// echo $allBookedFlights;
$_SESSION ['allBookedFlights'] = $allBookedFlights;

$phone = getPhones ( $customer->mobilePhone, $customer->businessPhone, $customer->workPhone );
?>
<div class="col-sm-8 col-sm-offset-2">
	<div class="well row" style="margin-top: 5%;">

		<form role="form" id="yourBookingsForm" class="shake">
			<?php
			if (count ( $allBookedFlights ) == 0) {
				echo '<h4 style="margin-bottom: 10px;"> You have no bookings </h4>';
			} else {
				?>
			<h3 style="margin-bottom: 20px; font-weight: bold;">Your bookings</h3>
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
						<th></th>

					</tr>
				</thead>
				<tbody>
				<?php
				for($i = 0; $i < count ( $allBookedFlights ); $i ++) {
					$flight = $allBookedFlights [$i];
					
					echo "<tr>
		                    <td>" . $flight->fromCity . "</td>
							<td>" . $flight->toCity . "</td>
							<td>" . $flight->price . "</td>
							<td>" . $flight->numberTicket . "</td>
							<td>" . $flight->numberChildren . "</td>
							<td>" . $flight->numberWheelchair . "</td>
							<td>" . $flight->numberSpecialDiet . "</td>
				  			<td><input type='checkbox' id='booking" . $i . "' value='" . $flight->bookingId . "' name='booking" . $i . "'> </td>";
				} // end for($i =0;$i<count($allBookedFlights);$i++){
				
				?>
				</tbody>
			</table>

			<button id="deleteSelectedFlightsBtn"
				style="padding: 5px; margin-right: 10px; margin-left: 8px;"
				class="btn btn-success btn-lg pull-left ">Delete</button>
			<button id="proceedToCheckoutBtn"
				style="padding: 5px; margin-right: 10px; margin-left: 8px;"
				class="btn btn-success btn-lg pull-left ">Proceed to Checkout</button>
			<div id="dialog-6" title="Your Bookings"></div>
			
			<?php
			} // else if (count($allBookedFlights) == 0){
			?>
		</form>
	</div>
</div>

<script type="text/javascript">
var numberBookings = <?php echo count($allBookedFlights);?>;
var bookings = <?php echo $allBookedFlights;?>;

var selectedBookings=[];

$( "#dialog-6" ).dialog({
	modal: true,
    autoOpen: false,  
    buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
 });
 
 $("#deleteSelectedFlightsBtn").click(function(e){
	 
	 e.preventDefault();
	 var n=0;
	 for(i=0;i<numberBookings;i++){
		 if (document.getElementById("booking"+i).checked){
			 selectedBookings[n++]=document.getElementById("booking"+i).value;
		 }
	 }
	 
	 if(n==0){
		 $("#dialog-6").html("<b> Please select a flight to delete!");
	 		$( "#dialog-6" ).dialog( "open" );
	 	return;
	 }else{
		 // delete checked booking
		// console.log("selectedBookings: "+selectedBookings);
		 $.ajax({
				url : "yourBookings.php?selectedBookings="+selectedBookings,
				success : function(result) {
					$("#mainContent").html(result);
				}
			});	 
	 }
	 
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

