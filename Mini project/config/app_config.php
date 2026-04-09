<?php
session_start();

$host     = "PMU-ADL2-PC22";
$username = "root";
$password = "";
$dbname   = "mini_project";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
 die("DB Connection failed: " . mysqli_connect_error());
}
?>