
<style>
<!--
.bookingImg {
	width: 2.5rem;
	height: 2.5rem;
}
-->
</style>
<?php
include 'globals.php';
$value = $_GET ['selectedRouteNo'];

$link = mysql_connect ( "rerun", "potiro", "pcXZb(kL" );

if (! $link) {
	die ( "can not cennect db server" );
	echo "Can not connect to database server";
} else {
	mysql_select_db ( "poti", $link );
	$sql_str = " select DISTINCT route_no, from_city, to_city, price  from flights where route_no=" . $value;
	
	$result = mysql_query ( $sql_str );
	$row = mysql_fetch_row ( $result );
	$routeNo = $row [0];
	$fromCity = $row [1];
	$toCity = $row [2];
	$price = $row [3];
	
	?>
<div class="col-sm-8 col-sm-offset-2">
	<div class="well row" style="margin-top: 5%;">
		<h3 style="margin-bottom: 20px; font-weight: bold;">Booking flight</h3>
		<h4 style="margin-bottom: 10px;">
			From &nbsp;<img src="images/departure_icon.png" class="bookingImg"
				alt="Logo" width="auto" height="30%" />&nbsp; <?php echo $fromCity;?> &nbsp;to &nbsp;<img
				src="images/arrival_icon.png" alt="Logo" width="auto"
				class="bookingImg" height="30%" />&nbsp;<?php echo $toCity;?>&nbsp; - Fare <?php echo "$".$price;?> </h4>

		<form role="form" id="makeBookingForm" class="shake">
		
			<table class="table">
				<caption>
					<img src="images/person.jpg" alt="Logo" class="bookingImg"
						width="auto" height="30%" />Who's going?
				</caption>
				<thead>
					<tr>
						<th>Select ticket</th>
						<th class='centerText'>Child</th>
						<th class='centerText'>Adult</th>
						<th class='centerText'>Wheelchair</th>
						<th class='centerText'>Special Diet</th>
					</tr>
				</thead>
				<tbody>
				<?php
	for($i = 1; $i <= 5; $i ++) {
		echo "<tr>
						<td><select name=\"selectTicket" . $i . "\" id=\"selectTicket" . $i . "\" class=\"btn btn-primary dropdown-toggle form-control\"
							data-toggle=\"dropdown\" >";
		for($j = 0; $j < 10; $j ++) {
			echo "<option value='" . $j . "'>" . $j . "</option>";
		}
		echo "</select></td>
						<td class='centerText'><input type=\"radio\" name=\"ticketType" . $i . "\" id=\"child" . $i . "\" value=\"child" . $i . "\"/></td>
						<td class='centerText'><input type=\"radio\" name=\"ticketType" . $i . "\" id=\"adult" . $i . "\" value=\"adult" . $i . "\"/></td>
						<td class='centerText'><input type=\"checkbox\" name=\"wheelchair" . $i . "\" id=\"wheelchair" . $i . "\" value='wheelchair" . $i . "'/></td>
						<td class='centerText'><input type=\"checkbox\" name=\"specialDiet" . $i . "\" id=\"specialDiet" . $i . "\" value='specialDiet" . $i . "' /></td>
					</tr>";
	} //for($i = 1; $i <= 5; $i ++) {
	?>
					
					<tr>
						<td><div id="totalTickets"></div></td>
						<td id="totalChild"></td>
						<td id="totalAdult"></td>
						<td id="totalWheelchair"></td>
						<td id="totalSpecialDiet"></td>
					</tr>
				</tbody>
			</table>
			
				<button id="addToBookingsBtn"
					style="padding: 5px; margin-right: 10px; margin-left: 8px;"
					class="btn btn-success btn-lg pull-left ">Add to Bookings</button>
				<div id="dialog-3" title="Add to Booking!"></div>
			<?php 
			echo "<input type='text' hidden name='routeNo' value='".$routeNo."'>";
			echo "<input type='text' hidden name='fromCity' value='".$fromCity."'>";
			echo "<input type='text' hidden name='toCity' value='".$toCity."'>";
			echo "<input type='text' hidden name='price' value='".$price."'>";
			?>
		</form>
	</div>
</div>
<?php
} // if (! $link) else
?>
<script type="text/javascript">
var total=0;
var totalAdult=0;
var totalWheelchair=0;
var totalSpecialDiet=0;
$( "#dialog-3" ).dialog({
	modal: true,
    autoOpen: false,  
    buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
 });
 
 $("#addToBookingsBtn").click(function(e){
	 e.preventDefault();
		
		if (total ==0) {
			$("#dialog-3").html("<b> Please select number of ticket!");
	 		$( "#dialog-3" ).dialog( "open" );
			  
		}else{
			var fromCity = $("input[name=fromCity]").val();
			var toCity = $("input[name=toCity]").val();
			var price = $("input[name=price]").val();
			var routeNo= $("input[name=routeNo]").val();
		    	
			var bookedFlights = createBookingObjects();
			var selectedFlight = makeSelectedFlight(routeNo, fromCity, toCity, price);
			var selectedFlightJsonStr = JSON.stringify(selectedFlight);
			var jsonStr = JSON.stringify(bookedFlights);
						
			var urlStr = "allBookedFlights.php?selectedFlight="+selectedFlightJsonStr;
			console.log(urlStr);
			$.ajax({
				type: "GET",
				url : urlStr,
				success : function(result) {
					//console.log(result);
					$("#mainContent").html(result);
					//return true;
				},
			     complete: function() {console.log('ajax loading success...');},
			     error: function(xhr, textStatus, errorThrown) {
			       console.log('ajax loading error...'+textStatus);
			       return false;
			     }
			});
		}
 });
 
 function makeSelectedFlight(routeNo, fromCity, toCity,price){
	 var selectedFlight = new Object();
	 selectedFlight.routeNo=routeNo;
	 selectedFlight.fromCity=fromCity;
	 selectedFlight.toCity = toCity;
	 selectedFlight.price=price;
	 selectedFlight.numberTicket=total;
	 selectedFlight.numberChildren= total-totalAdult;
	 selectedFlight.numberWheelchair=totalWheelchair;
	 selectedFlight.numberSpecialDiet=totalSpecialDiet;
	 return selectedFlight;
 }
 function createBookingObjects(){
	 var bookedFlights = [];
	 var j=0;
	 for (i=1;i<=5;i++){
		 var flight = createBookedFlight(i);
		 if (flight != null){
			bookedFlights[j] = 	 flight;
			j++;
		 }
	 }
	 return bookedFlights;
	  
 }
 function createBookedFlight(i){
	 var ticket = parseInt(document.getElementById("selectTicket"+i).value);
	 var child=false;
	 var wheelchair=false;
	 var specialDiet= false;
	 if (ticket >0){
		 if (document.getElementById("adult"+i).checked) {
			 child = true;
		 }
		 if (document.getElementById("wheelchair"+i).checked) {
			 wheelchair = true;
		 }
		 if (document.getElementById("specialDiet"+i).checked) {
			 specialDiet = true;
		 }
		 var flight = new Object();
		 flight.ticket=ticket;
		 flight.child=child;
		 flight.wheelchair=wheelchair;
		 flight.specialDiet=specialDiet;
		 return flight;
	 }
	 return null;
 }
$('#selectTicket1, #selectTicket2, #selectTicket3, #selectTicket4, #selectTicket5').change(function(e){
	var id = e.target.id;
	total=0
	for (i=1;i<=5;i++){
		total +=parseInt(document.getElementById("selectTicket"+i).value);
	}	
	$("#totalTickets").html("Total selected tickets: <strong>" +total+ "<strong>");
	handleTicketType(id);
	handleAdultTicket();
	handleWheelchair();
	handleSpecialDiet();
 });
$("#adult1,#adult2,#adult3,#adult4,#adult5,#child1,#child2,#child3,#child4,#child5" ).change(function(e){
	handleAdultTicket();
});
function handleAdultTicket(){
	totalAdult=0;
	for (i=1;i<=5;i++){
		
		if (document.getElementById("adult"+i).checked) {
			totalAdult += parseInt(document.getElementById("selectTicket"+i).value);
		}
	}
	if(!isNaN(totalAdult)){
		$("#totalAdult").html("Adult: <strong>" +totalAdult+ "<strong>");
	}else{
		$("#totalAdult").html("Adult: <strong>" +0+ "<strong>");
	}
	var totalChild = total - totalAdult;
	
	if(!isNaN(totalChild)){
		$("#totalChild").html("Child: <strong>" +totalChild+ "<strong>");
	}else{
		$("#totalChild").html("Child: <strong>" +0+ "<strong>");
	}
	return totalAdult;
}
$("#specialDiet1,#specialDiet2,#specialDiet3,#specialDiet4,#specialDiet5").change(function(e){
	handleSpecialDiet();
});
$("#wheelchair1,#wheelchair2,#wheelchair3,#wheelchair4,#wheelchair5").change(function(e){
	handleWheelchair();
});
function handleWheelchair(){
	totalWheelchair=0;
	for (i=1;i<=5;i++){
		
		if (document.getElementById("wheelchair"+i).checked) {
			totalWheelchair += parseInt(document.getElementById("selectTicket"+i).value);
		}
	}
	$("#totalWheelchair").html("Wheelchair: <strong>" +totalWheelchair+ "<strong>");
	return totalWheelchair;
}

$("#specialDiet1,#specialDiet2,#specialDiet3,#specialDiet4,#specialDiet5").change(function(e){
	handleSpecialDiet();
});
function handleSpecialDiet(){
	totalSpecialDiet=0;
	for (i=1;i<=5;i++){
		
		if (document.getElementById("specialDiet"+i).checked) {
			totalSpecialDiet += parseInt(document.getElementById("selectTicket"+i).value);
		}
	}
	$("#totalSpecialDiet").html("Special Diet: <strong>" +totalSpecialDiet+ "<strong>");
	return totalSpecialDiet;
}
function handleTicketType(id){
	if (document.getElementById(id).value!="0"){
		var order = id.charAt(id.length-1);
		var ticketType = "ticketType"+order;
	
		if (document.querySelector('input[name ="'+ ticketType+'"]:checked')== null){
			
			document.getElementById("adult"+order).checked= true;
		}
	}
	
	
	
}

</script>
