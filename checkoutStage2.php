<?php
include 'globals.php';
$customerStr = $_GET ["customer"];
function getCustomer($customerStr) {
	$token = strtok ( $customerStr, "{,[}]" );
	$customer = new Customer ();
	$tokens = array ();
	while ( $token !== false ) {
		$tokens [] = $token;
		$token = strtok ( '{,[}]' );
	}
	foreach ( $tokens as $t ) {
		$token = strtok ( $t, '\":' );
		if ($token == "firstName") {
			$token = strtok ( '\":' );
			//echo "<p> firstName: ".$token;
			$customer->firstName = $token;
		} else if ($token == "lastName") {
			$token = strtok ( '\":' );
			//echo "<p> lastName: ".$token;
			$customer->lastName = $token;
		} else if ($token == "addressLine1") {
			$token = strtok ( '\":' );
			//echo "<p> address 1: ".$token;
			$customer->addressLine1 = $token;
		} else if ($token == "addressLine2") {
			$token = strtok ( '\":' );
			if ($token !== false) {
				//echo "<p> add 2: ".$token;
				$customer->addressLine2 = $token;
			} else {
				$customer->addressLine2 = "";
			}
		} else if ($token == "suburb") {
			$token = strtok ( '\":' );
			//echo "<p> suburb: ".$token;
			$customer->suburb = $token;
		} else if ($token == "state") {
			$token = strtok ( '\":' );
			if ($token !== false) {
				//echo "<p> state: ".$token;
				$customer->state = $token;
			} else {
				$customer->state = "";
			}
		} else if ($token == "postcode") {
			$token = strtok ( '\":' );
			if ($token !== false) {
				//echo "<p> postcode: ".$token;
				$customer->postcode = $token;
			} else {
				$customer->postcode = "";
			}
		} else if ($token == "country") {
			$token = strtok ( '\":' );
			//echo "<p> country: ".$token;
			$customer->country = $token;
		} else if ($token == "email") {
			$token = strtok ( '\":' );
			//echo "<p> email: ".$token;
			$customer->email = $token;
		} else if ($token == "mobilePhone") {
			$token = strtok ( '\":' );
			if ($token !== false) {
				$customer->mobilePhone = $token;
			} else {
				$customer->mobilePhone = "";
			}
		} else if ($token == "businessPhone") {
			$token = strtok ( '\":' );
			if ($token !== false) {
				$customer->businessPhone = $token;
			} else {
				$customer->businessPhone = "";
			}
		} else {
			$token = strtok ( '\":' );
			if ($token !== false) {
				$customer->workPhone = $token;
			} else {
				$customer->workPhone = "";
			}
		}
	}
	
	return $customer;
}

session_start ();
$customer = getCustomer ( $customerStr );
$_SESSION ['customer']= $customer;
$allBookedFlights = $_SESSION ['allBookedFlights'];
echo "<p>".$allBookedFlights[0]->numberSpecialDiet;
$phone = getPhones ( $customer->mobilePhone, $customer->businessPhone, $customer->workPhone );
?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="well row" style="margin-top: 5%;">
		<h4 style="margin-bottom: 20px; font-weight: bold;">Checkout stage 2
			- Credit card details</h4>
		<table>
			
			<tbody>
				<tr>
					<td style="width:50%">Customer name:</td>
					<td><?php echo $customer->firstName." ".$customer->lastName; ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?php echo $customer->email;?></td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><?php echo $customer->addressLine1." ".$customer->addressLine2
					    .", ".$customer->suburb." ".$customer->state." ".$customer->postcode.", ".$customer->country; ?></td>
				</tr>
				<tr>
					<td>Contact number:</td>
					<td><?php echo $phone; ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<hr style="border:1px solid">
		<form role="form" id="stage1Form" 
			class="shake">

			<div class="row">
				<div class="form-group col-sm-12">
					<label for="creditCardType" class="h4">Credit card type</label>
					<div class="form-control" style="background-color: #ECF0F1;">
						<label class="radio-inline"> <input type="radio" id="visaCard"
							value="visaCard" name="creditCardType" checked>Visa Master Card
						</label> <label class="radio-inline"> <input type="radio"
							id="diners" value="diners" name="creditCardType">Diners
						</label> <label class="radio-inline"> <input type="radio"
							id="amex" value="amex" name="creditCardType">Amex
						</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-12">
					<label for="cardNumber" class="h4">Card number </label> <input
						type="text" class="form-control" id="cardNumber"
						placeholder="Card number" required
						data-error="Card number is required">
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="expireMonth" class="h4">Expiry month </label> <select
						class="btn btn-primary dropdown-toggle form-control"
						data-toggle="dropdown" name="expireMonth" id="expireMonth"
						data-error="Expire month is required">
						<?php
						for($i = 1; $i <= 12; $i ++) {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
						?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="expireYear" class="h4">Expiry year </label> <select
						class="btn btn-primary dropdown-toggle form-control"
						data-toggle="dropdown" name="expireYear" id="expireYear"
						data-error="Expire Year is required">
						<?php
						for($i = 2016; $i <= 2030; $i ++) {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
						?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<button id="reviewBookingBtn" 
				class="btn btn-success btn-lg pull-right ">Review Booking</button>
			<div id="dialog-5" title="Payment Details"></div>

			<div class="clearfix"></div>

		</form>
	</div>
</div>
<script type="text/javascript">
$( "#dialog-5" ).dialog({
	modal: true,
    autoOpen: false,  
 });
$("#reviewBookingBtn").click(function(e){
	 e.preventDefault();
	 var creditCardType=document.querySelector('input[name="creditCardType"]:checked').value;
	 
	 var cardNumber = document.getElementById("cardNumber").value;
	 var expireMonth = parseInt(document.getElementById("expireMonth").value);
	 var expireYear = parseInt(document.getElementById("expireYear").value);
	 
	 if (!validateCardNumber(cardNumber)){
		 $("#dialog-5").html("<b> Credit card number just contains 12 digits!");
	 		$( "#dialog-5" ).dialog( "open" );
	 		return false;
	 }
	 if (!validateExpire(expireMonth,expireYear)){
		 $("#dialog-5").html("<b> Invalid credit card expiry date!");
	 		$( "#dialog-5" ).dialog( "open" );
	 		return false;
	 }
	 var urlStr="checkoutStage3.php?creditCardType="+creditCardType+"&cardNumber="+cardNumber+
	 			"&expireMonth="+ expireMonth+ "&expireYear="+ expireYear;
	 $.ajax({
			type: "GET",
			url : "checkoutStage3.php",
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
function validateExpire(expireMonth,expireYear){
	if ((expireYear==2016) && (expireMonth<=5)){
		return false;
	}
	return true;
}


function validateCardNumber(cardNumber){
	var patt =/[^0-9]/;
	if (patt.test(cardNumber))
		return false;
	if (cardNumber.length!=12)
		return false;
	return true;
}
 </script>