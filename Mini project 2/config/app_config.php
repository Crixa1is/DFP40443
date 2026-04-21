<?php
session_start();
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "movie_db";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
 die("DB Connection failed: " . mysqli_connect_error());
}
?>
