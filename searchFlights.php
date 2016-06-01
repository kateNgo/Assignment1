<?php
include 'globals.php';
$link = mysql_connect ( "rerun", "potiro", "pcXZb(kL" );
$from_cities = array ();
$to_cities = array ();
if (! $link) {
	die ( "can not cennect db server" );
} else {
	mysql_select_db ( "poti", $link );
	$sql_from_cities = " select DISTINCT from_city  from flights";
	$sql_to_cities = " select DISTINCT to_city  from flights";
	
	$result_from_cities = mysql_query ( $sql_from_cities );
	$result_to_cities = mysql_query ( $sql_to_cities );
	
	$num_rows_from_cities = mysql_num_rows ( $result_from_cities );
	$num_rows_to_cities = mysql_num_rows ( $result_to_cities );
	
	if (($num_rows_from_cities == 0) or ($num_rows_to_cities == 0)) {
		echo "No flight found";
	} else {
		while ( $row = mysql_fetch_row ( $result_from_cities ) ) {
			$from_cities [] = $row [0];
		}
		while ( $row = mysql_fetch_row ( $result_to_cities ) ) {
			$to_cities [] = $row [0];
		}
	}
}

?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="well" style="margin-top: 5%;">
		<h3 style="margin-bottom: 30px;">Search Flight</h3>
		<form role="form" id="searchFlightForm" class="shake">
			<div class="row">

				<div class="form-group col-sm-12">
					<div class="dropdown">
						<label for="fromCity" class="h4">From</label> <select
							class="btn btn-primary dropdown-toggle form-control"
							data-toggle="dropdown" name="fromCity" id="fromCity">
							<option value="">ORIGIN</option>
										<?php
										for($i = 0; $i < $num_rows_from_cities; $i ++) {
											echo "<option value='" . $from_cities [$i] . "'>" . $from_cities [$i];
										}
										
										?>
									
											
											</select>
					</div>
				</div>
				<div class="form-group col-sm-12">
					<div class="dropdown">
						<label for="toCity" class="h4">To</label> <select
							class="btn btn-primary dropdown-toggle form-control"
							data-toggle="dropdown" name="toCity" id="toCity">
							<option value="">DESTINATION</option>
										
										<?php
										
										for($i = 0; $i < $num_rows_to_cities; $i ++) {
											echo "<option value='" . $to_cities [$i] . "'>" . $to_cities [$i];
										}
										
										?>
									
											
											</select>
					</div>
				</div>
				<button id="searchBtn" name="searchBtn"
					class="btn btn-success btn-lg pull-right" style="margin-right: 16px;">Search</button>
				<div id="dialog-1" title="Search Flights!"></div>
			</div>
		</form>
	</div>
</div>
<script>
$( "#dialog-1" ).dialog({
	modal: true,
    autoOpen: false, 
    buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      } 
 });
$("#searchBtn").click(function(event){
	
	event.preventDefault();
	var fromCity = $("#fromCity").val();
 	var toCity = $("#toCity").val();
 	if ((fromCity == "") && (toCity=="")){
 		
 		$("#dialog-1").html("<b> Please select origin or destination city!");
 		$( "#dialog-1" ).dialog( "open" );
 		return;
 	}else{
 		$.ajax({
 	        type: "POST",
 	        url: "searchResult.php",
 	        data: "fromCity=" + fromCity + "&toCity=" +toCity,
 	        success : function(result){
 	        	$("#mainContent").html(result); 
 	        }
 	    });
 	}
});
	</script>