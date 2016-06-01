
 // Menu actions
function homeMenu(){
	$.ajax({
		url : "home.html",
		success : function(result) {
			$("#mainContent").html(result);
		}
	});
}
function searchFlights(){
	$.ajax({
		url : "searchFlights.php",
		success : function(result) {
			$("#mainContent").html(result);
		}
	});
}
function yourBookings(){
	$.ajax({
		url : "yourBookings.php",
		success : function(result) {
			$("#mainContent").html(result);
		}
	});
}
function yourBookings(){
	$.ajax({
		url : "yourBookings.php",
		success : function(result) {
			$("#mainContent").html(result);
		}
	});
}
function contactMenu(){
	$.ajax({
		url : "contact.php",
		success : function(result) {
			$("#mainContent").html(result);
		}
	});
}
// end menu action
// Search Flights Action

// end Search flights 
