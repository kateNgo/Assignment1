<?php
include 'globals.php';
session_start ();
$allBookedFlights = $_SESSION ['allBookedFlights'];

echo "<p>".$allBookedFlights[0]->numberSpecialDiet;
?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="well row" style="margin-top: 5%;">
		<h3 style="margin-bottom: 20px; font-weight: bold;">Checkout - Stage 1</h3>
		<form role="form" id="stage1Form" data-toggle="validator"
				class="shake">
			<div class="row">
				<div class="form-group col-sm-4">
					<label for="insideAustralia" class="h4">Inside Australia</label> </div>
				<div class="form-group col-sm-8 radio "><input class="pull-left"
						type="checkbox"  id="insideAustralia" name="insideAustralia" value="1" checked></div>
				
			</div>
				
			
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="firstName" class="h4">First name <span class="redAsterisks">*</span></label> <input
						type="text" class="form-control" id="firstName"
						placeholder="First name" required
						data-error="first name is required">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-sm-6">
					<label for="lastName" class="h4">Last name <span class="redAsterisks">*</span> </label> <input
						type="text" class="form-control" id="lastName"
						placeholder="Last name" required
						data-error="last name is required">
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="row">
					<div class="form-group col-sm-6">
						<label for="addressLine1" class="h4">Address Line 1 <span class="redAsterisks">*</span></label> <input
							type="text" class="form-control" id="addressLine1"
							placeholder="Address Line 1" required data-error="Address is required">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-6">
						<label for="addressLine2" class="h4">Address Line 2</label> <input
							type="text" class="form-control" id="addressLine2"
							placeholder="Address Line 2" >
						<div class="help-block with-errors"></div>
					</div>
			</div>
			<div class="row">
					<div class="form-group col-sm-6">
						<label for="suburb" class="h4">Suburb <span class="redAsterisks">*</span></label> <input
							type="text" class="form-control" id="suburb"
							placeholder="suburb" required data-error="suburb is required">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-6">
						<label for="state" class="h4" id="stateLabel">State <span class="redAsterisks">*</span></label>
						 <select class="btn btn-primary dropdown-toggle form-control"
								data-toggle="dropdown" name="stateList" id="stateList"
								data-error="State is required">
								<option value="NSW">New South Wales</option>
								<option value="ACT">Australian Capital Territory </option>
								<option value="NT">Northern Territory </option>
								<option value="SA">South Australia</option>
								<option value="VIC">Victoria</option>
								<option value="QDL">Queensland</option>
								<option value="TAS">Tasmania  </option>
								<option value="WA">Western Australia </option>
							</select>
							<input 	type="text" class="form-control" id="stateText" name="stateText" 
							placeholder="State" >
						<div class="help-block with-errors"></div>
					</div>
			</div>
			<div class="row">
					<div class="form-group col-sm-6">
						<label for="postcode" class="h4" id="postcodeLabel">Postcode <span class="redAsterisks">*</span></label> <input
							type="text" class="form-control" id="postcode"
							placeholder="Postcode" required data-error="Postcode is required">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-6">
						<label for="Country" class="h4">Country<span class="redAsterisks">*</span></label><input
							type="text" class="form-control" id="country" value="Australia"
							placeholder="Country" required data-error="Country is required">
						<div class="help-block with-errors"></div>
					</div>
			</div>
				<div class="row">
				<div class="form-group col-sm-6">
						<label for="email" class="h4">Email <span class="redAsterisks">*</span></label> <input type="email"
							class="form-control" id="email" placeholder="Enter email"
							required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group col-sm-6">
						<label for="mobilePhone" class="h4">Mobile phone</label> <input
							type="text" class="form-control" id="mobilePhone"
							placeholder="Mobile Phone">
					</div>
					
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="businessPhone" class="h4">Business Phone</label> <input
							type="text" class="form-control" id="businessPhone"
							placeholder="Business Phone">
					</div>
					<div class="form-group col-sm-6">
						<label for="workPhone" class="h4">Work Phone </label> <input type="text"
							class="form-control" id="workPhone" placeholder="Work Phone">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<button  id="continueStage1Btn" type="submit"
					class="btn btn-success btn-lg pull-right ">Stage 2 - Payment Details</button>
				<div id="msgSubmit" class="h3 text-center hidden"></div>
				<div id="dialog-7" title="Payment Details"></div>
				<div class="clearfix"></div>
				
			</form>
	</div>
</div>
<script>
$( "#dialog-7" ).dialog({
	modal: true,
    autoOpen: false,  
 });
var insideAustralia = true;
createInsideAustralia(true);
function validatePostcode(postcode){
	var patt =/[^0-9]/;
	if (patt.test(postcode))
		return false;
	if (postcode.length >5 )
		return false;
	return true;
}
function validatePhone(phone){
	var patt =/[^0-9 \-]/;
	if (patt.test(phone))
		return false;
	
	return true;
}
$("#insideAustralia").change(function(e){
	if (this.checked){
		createInsideAustralia(true);
	}else{
		createInsideAustralia(false);
	}
});
$("#stage1Form").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
       submitMSG(false, "One or more compulsory fields is blank!");
    } else {
        event.preventDefault();
        if (!validatePostcode($("#postcode").val())){
        	$("#dialog-7").html("<b> Postcode just allows not more than 5 digits!");
	 		$( "#dialog-7" ).dialog( "open" );
	 		return false;
        }
        if (!validatePhone($("#mobilePhone").val())){
        	$("#dialog-7").html("<b> Invalid Mobile Phone!");
	 		$( "#dialog-7" ).dialog( "open" );
	 		return false;
        }
        if (!validatePhone($("#businessPhone").val())){
        	$("#dialog-7").html("<b> Invalid Business Phone!");
	 		$( "#dialog-7" ).dialog( "open" );
	 		return false;
        }
        if (!validatePhone($("#workPhone").val())){
        	$("#dialog-7").html("<b> Invalid Work Phone!");
	 		$( "#dialog-7" ).dialog( "open" );
	 		return false;
        }
        submitStage1Form();
        
    }
});
function submitStage1Form(){
	
	var firstName= $("#firstName").val();
	
    var lastName= $("#lastName").val();
    var addressLine1= $("#addressLine1").val();
    var addressLine2= $("#addressLine2").val();
    var suburb= $("#suburb").val();
    if (insideAustralia){
    	var state= $("#stateList").val();
    }else{
    	var state= $("#stateText").val();
    }
    
    var country= $("#country").val();
    var postcode= $("#postcode").val();
    var email = $("#email").val();
    var mobilePhone= $("#mobilePhone").val();
    var businessPhone= $("#businessPhone").val();
    var workPhone= $("#workPhone").val();
    var customer = new Object();
    customer.firstName= firstName;
    customer.lastName=lastName;
    customer.addressLine1= addressLine1;
    customer.addressLine2= addressLine2;
    customer.suburb=suburb;
    customer.state = state;
    customer.country=country;
    customer.postcode=postcode;
    customer.email=email;
    customer.mobilePhone= mobilePhone;
    customer.businessPhone=businessPhone;
    customer.workPhone=workPhone;
    var jsonStr = JSON.stringify(customer);
    var urlStr = "checkoutStage2.php?customer="+jsonStr;
	console.log(urlStr);
	$.ajax({
		type: "GET",
		url : urlStr,
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
    
}
function formError(){
    $("#stage1Form").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}
function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
function createInsideAustralia(inside){
	if (inside){
		insideAustralia = true;
		document.getElementById("country").value="Australia";
		document.getElementById("country").disabled = true;
		
		document.getElementById("stateList").style.display="block";
		document.getElementById("stateText").style.display="none";
		$("#stateLabel").html("State <span class='redAsterisks'>*</span>");
		$("#postcodeLabel").html("Postcode <span class='redAsterisks'>*</span>");
		$("#state").attr('required', 'true');
		$("#postcode").attr('required', 'true');
		
	}else{ // outside Australia
		insideAustralia = false;
		document.getElementById("country").disabled = false;
		
		document.getElementById("stateList").style.display="none";
		document.getElementById("stateText").style.display="block";
		$("#stateLabel").html("State ");
		$("#state").removeAttr( "required" );
		$("#postcodeLabel").html("Postcode");
		$("#postcode").removeAttr( "required" );
		
		//$("p").append(
	}
}
</script>