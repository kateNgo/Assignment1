<?php
include 'globals.php';
session_start ();
$customer = $_SESSION ['customer'];
$allBookedFlights = $_SESSION ['allBookedFlights'];
$phone = getPhones ( $customer->mobilePhone, $customer->businessPhone, $customer->workPhone );
?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="well row" style="margin-top: 5%;">
		<h4 style="margin-bottom: 20px; font-weight: bold;">Checkout stage 3 -
			Confirm Payment</h4>
		<table>
			<caption>Customer detail</caption>
			<tbody>
				<tr>
					<td style="width: 50%">Customer name:</td>
					<td><?php echo $customer->firstName." ".$customer->lastName; ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?php echo $customer->email;?></td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><?php
					
					echo $customer->addressLine1 . " " . $customer->addressLine2 . " ," . $customer->suburb . " " . $customer->state . " " . $customer->postcode . " ," . $customer->country;
					?></td>
				</tr>
				<tr>
					<td>Contact number:</td>
					<td><?php echo $phone; ?></td>
				</tr>
			</tbody>
		</table>
		<hr style="border: 1px solid">
		<table style="width: 100%;">
			<caption>Booked Flights</caption>
			<thead>
				<tr>
					<th>From</th>
					<th>To</th>
					<th>Fare</th>
					<th>Tickets</th>
					<th>Children</th>
					<th>Wheelchair</th>
					<th>SpecialDiet</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ( $allBookedFlights as $flight ) {
				echo "<tr>
							<td>" . $flight->fromCity . "</td>
							<td>" . $flight->toCity . "</td>
							<td>" . $flight->price . "</td>
							<td>" . $flight->numberTicket . "</td>
							<td>" . $flight->numberChildren . "</td>					
							<td>" . $flight->numberWheelchair . "</td>
							<td>" . $flight->numberSpecialDiet . "</td>
						</tr>";
			}
			?>
				
			</tbody>
		</table>
		<hr style="border: 1px solid">
		<h4 style="margin-top: 10px;">Credit Card Details supplied</h4>
		<button id="confirmPaymentBtn"
			style="padding: 5px; margin-right: 10px; "
			class="btn btn-success btn-lg pull-left ">Confirm Payment</button>
	</div>
</div>

<script type="text/javascript">
$("#confirmPaymentBtn").click(function(e){
	 e.preventDefault();
	 
$.ajax({
	type: "GET",
	url : "checkoutStage4.php",
	success : function(result) {
		//console.log(result);
		$("#mainContent").html(result);
		//return true;
	},
  complete: function() {},
  error: function(xhr, textStatus, errorThrown) {
    console.log('ajax loading error...'+textStatus);
    return false;
  }
});
});
	 </script>
