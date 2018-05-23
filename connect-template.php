<?php

// Production config file

$dbHost = "host";
$dbUser = "user";
$dbPass = "password";
$dbName = "database name";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if(!$conn){
    echo mysqli_connect_error();
    exit;
} 
// ensures swedish characters
mysqli_set_charset($conn, "utf8");

?>