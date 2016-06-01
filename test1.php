<?php
include 'globals.php';
session_start();
  $customer= new customer();
  $customer->firstName="aaa";
  $customer->lastName="bbbb";
  
  $_SESSION['customer'][]=$customer;
  $customer= new customer();
  $customer->firstName="cc";
  $customer->lastName="dd";
  $_SESSION['customer'][]=$customer;
?>

