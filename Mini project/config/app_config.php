<?php
session_start();
<<<<<<< HEAD

$host     = "PMU-ADL2-PC22";
=======
$host     = "localhost";
>>>>>>> 6df05af60730f4e564c3601b475230724153f813
$username = "root";
$password = "";
$dbname   = "mini_project";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
 die("DB Connection failed: " . mysqli_connect_error());
}
?>
