<!DOCTYPE html>
<html>
<head>
<title>Thi Bich Phuong Ngo Travel Agency</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/mycss.css">
</head>
<?php
include 'globals.php';
?>

<body>
	<!-- Menu bar -->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="images/logo_1.png"
					alt="Logo" width="auto" height="90%" /> </a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a id="home" href="javascript:homeMenu()">Home</a></li>
					<li><a id="searchFlights" href="javascript:searchFlights()">Search
							Flights</a></li>
					<li><a id="yourBookings" href="javascript:yourBookings()">Your
							Bookings</a></li>
					<li><a id="contact" href="javascript:contactMenu()">Contact</a></li>
				</ul>

			</div>
		</div>
	</nav>
	<!--  end menu bar -->
	<!--  Main Content -->
	<div class="container-fluid" id="mainContent" style="">
		<?php include 'home.html';?>
	</div>

	<!--  End Content -->
</body>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/validator.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/form-scripts.js"></script>
</html>
