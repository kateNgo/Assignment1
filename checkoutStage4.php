<?php
include 'globals.php';
session_start ();
$customer = $_SESSION ['customer'];
$allBookedFlights = $_SESSION ['allBookedFlights'];
$phone = getPhones ( $customer->mobilePhone, $customer->businessPhone, $customer->workPhone );
$subject = "Your booking has been confirmed";
$toEmail = $customer->email;
$theBody = "<h3>Your booking has been confirmed.</h3>
<p style='font-weight: bold;'>Dear " . $customer->firstName . "</p>
<p> Thank you for flying with " . COMPANYNAME . ". </p>
<p> Your booking has been completed with the below details:
<table>
			<caption>Customer detail</caption>
			<tbody>
				<tr>
					<td style=\"width: 50%\">Customer name:</td>
					<td>" . $customer->firstName . " " . $customer->lastName . "</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>" . $customer->email . "</td>
				</tr>
				<tr>
					<td>Address:</td>
					<td>" . $customer->addressLine1 . " " . $customer->addressLine2 . " ," . $customer->suburb . " " . $customer->state . " " . $customer->postcode . " ," . $customer->country . "</td>
				</tr>
				<tr>
					<td>Contact number:</td>
					<td>" . $phone . "</td>
				</tr>
			</tbody>
		</table>
		<hr style=\"border: 1px solid\">
							
		<table style=\"width: 100%;\">
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
			<tbody>";
foreach ( $allBookedFlights as $flight ) {
	$theBody .= "<tr>
							<td>" . $flight->fromCity . "</td>
							<td>" . $flight->toCity . "</td>
							<td>" . $flight->price . "</td>
							<td>" . $flight->numberTicket . "</td>
							<td>" . $flight->numberChildren . "</td>					
							<td>" . $flight->numberWheelchair . "</td>
							<td>" . $flight->numberSpecialDiet . "</td>
						</tr>";
}
$theBody .= "</tbody></table>";
$message = "
<html>
<head>
<title> Confirmation your booking</title>
</head>
<body>" . $theBody . "</body>
</html>
";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <thibichphuong.ngo@student.uts.edu.au>' . "\r\n";

mail ( $toEmail, $subject, $message, $headers );
session_unset ();

?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="well row" style="margin-top: 5%;">
		<h4 style="margin-bottom: 20px; font-weight: bold;">Checkout stage 4 -
			Booking Completed</h4>
			<p>Thank you - Your booking has been completed and an email has been sent to your email address
	</div>
</div>
