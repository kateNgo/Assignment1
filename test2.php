<?php
include 'globals.php';
session_start();
$customers =$_SESSION['customer'];

echo $customers->firstName."<br>";
echo $customers->lastName."<br>";

?>