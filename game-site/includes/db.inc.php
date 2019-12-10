<?php

$dBServername = "alandenz.dk.mysql";
$dBUsername = "alandenz_dk_gamesite";
$dBPassword = "Dogangt11";
$dBName = "alandenz_dk_gamesite";


// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) { //fejl meddelelse
  die("Connection didn't work properly: ".mysqli_connect_error());
}






//$dBServername = "alandenz.dk.mysql";
//$dBUsername = "alandenz_dk_gamesite";
//$dBPassword = "Dogangt11";
//$dBName = "alandenz_dk_gamesite";