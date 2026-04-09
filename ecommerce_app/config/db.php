<?php

$host     = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname   = "ecommerce_db";

$conn = mysqli_connect($host,$username,$password,$dbname);
if (!$conn) {
 die("DB Connection failed: " . mysqli_connect_error());
}
?>
