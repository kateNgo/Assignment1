<?php
include 'globals.php';

// collect value of input field
$fromCity = $_POST ['fromCity'];
$toCity = $_POST ['toCity'];

$result = null;
$num_rows = 0;
$link = mysql_connect ( "rerun", "potiro", "pcXZb(kL" );

if (! $link) {
	die ( "can not cennect db server" );
	echo "Can not connect to database server";
} else {
	mysql_select_db ( "poti", $link );
	$sql_str = " select DISTINCT route_no, from_city, to_city, price  from flights "; // where from_city='".$fromCity."' and to_city='".$toCity."'";
	$conditionSql = "";
	if ($fromCity != "") {
		$conditionSql .= " where from_city='" . $fromCity . "' ";
	}
	if ($toCity != "") {
		if ($conditionSql == "") {
			$conditionSql .= " where to_city='" . $toCity . "' ";
		} else {
			$conditionSql .= " and to_city='" . $toCity . "' ";
		}
	}
	$sql_str .= $conditionSql;
	$result = mysql_query ( $sql_str );
	$num_rows = mysql_num_rows ( $result );
}

?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="well" style="margin-top: 5%;">
		<h3 style="margin-bottom: 30px; font-weight: bold;">Search Flight
			Results</h3>
		<form role="form" id="searchFlightForm" class="shake">
			
			   <?php
						if ($num_rows == 0) {
							echo "<p style='font-style:bold;'> No flight found</p> ";
						} else {
							?>
							<div class="row table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Select</th>
							<th>Origin</th>
							<th>Destination</th>
							<th>Price</th>

						</tr>
					</thead>
					<tbody>
					<?php
							while ( $row = mysql_fetch_row ( $result ) ) {
								echo "<tr>";
								echo "<td> <input type=\"radio\" name='route_no' value='" . $row [0] . "'></td>";
								echo "<td>" . $row [1] . "</td>";
								echo "<td>" . $row [2] . "</td>";
								echo "<td>" . $row [3] . "</td>";
								echo "</tr>";
							}
							?>
						
					</tbody>
				</table>
			</div>
			
			
						<?php
							// end else
						}
						
						?>
						<div class="row">
				<button id="newSearchBtn"
					style="padding: 5px; margin-right: 10px; margin-left: 8px;"
					class="btn btn-success btn-lg pull-left ">New Search</button>
				<button id="makeBookingBtn"
					style="padding: 5px; margin-right: 10px;"
					class="btn btn-success btn-lg pull-left ">Make Booking</button>
				<div id="dialog-2" title="Make Booking"></div>
			</div>

		</form>
	</div>
</div>
<script type="text/javascript">
$( "#dialog-2" ).dialog({
	modal: true,
    autoOpen: false,  
    buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
 });
$("#newSearchBtn").click(function(event){
	event.preventDefault();
	$.ajax({
		url : "searchFlights.php",
		success : function(result) {
			$("#mainContent").html(result);
		}
	});
});
$("#makeBookingBtn").click(function(event){
	event.preventDefault();
	var selectedRouteNo = document.querySelector('input[name = "route_no"]:checked');
	if (selectedRouteNo ==null) {
		$("#dialog-2").html("<b> Please select a flight!");
 		$( "#dialog-2" ).dialog( "open" );
		  
	}else{
		var urlStr = "makeBooking.php?selectedRouteNo="+selectedRouteNo.value;
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

</script>
