
<?php
/* Constants*/
define("ORIGIN","Origin");
define("DESTINATION", "Destionation");
define("COMPANYNAME","Thi Ngo Travel Agency");
define("ROUTENO", "routeNo");
define("FROMCITY", "fromCity");
define("TOCITY", "toCity");
define("PRICE", "price");
define("TICKET", "ticket");
define("CHILD", "child");

define("WHEELCHAIR", "wheelchair");
define("SPECIALDIET", "specialDiet");
define("NUMBERTICKET","numberTicket");
define("NUMBERADULT","numberAdult");
define("NUMBERCHILDREN","numberChildren");
define("NUMBERWHEELCHAIR","numberWheelchair");
define("NUMBERSPECIALDIET","numberSpecialDiet");


/* Database Connection */


class BookedFlight{
	public $bookingId;
	public $routeNo;
	public $fromCity;
	public $toCity;
	public  $price;
	public $numberTicket;
	public $numberChildren;
	public  $numberWheelchair;
	public $numberSepecialDiet;


}
class Customer{
	public $firstName;
	public $lastName;
	public $addressLine1;
	public $addressLine2;
	public $suburb;
	public $state;
	public $postcode;
	public $country;
	public $email;
	public $mobilePhone;
	public $businessPhone;
	public $workPhone;
}
function getPhones($mobilePhone, $businessPhone, $workPhone) {
	$phone = "";
	if (($mobilePhone != "")) {
		$phone = $mobilePhone;
	}
	if (($businessPhone != "")) {
		if ($phone == "") {
			$phone = $businessPhone;
		} else {
			$phone .= " - " . $businessPhone;
		}
	}
	if (($workPhone != "")) {
		if ($phone == "") {
			$phone = $workPhone;
		} else {
			$phone .= " - " . $workPhone;
		}
	}
	return $phone;
}
?>