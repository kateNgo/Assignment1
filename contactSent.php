<?php
$subject = $_POST['subject'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$message = $_POST["message"];
$email = $_POST["email"];

$EmailTo = "thibichphuong.ngo@student.uts.edu.au";
$Body = "";
$Body .= "Name: ";
$Body .= $firstName." ".$lastName;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";
$theBody = "<h4>Your message has been sent to Thi Ngo Travel Agency with your message:</h>";
$theBody .=$Body;
// send email
mail($EmailTo, $subject, $Body, "From:".$email);
$success = mail($email, $subject, $theBody, "From:".$EmailTo);
// redirect to success page
if ($success && $errorMSG == ""){
	echo "success";
}else{
	if($errorMSG == ""){
		echo "Something went wrong :(";
	} else {
		echo $errorMSG;
	}
}
?>