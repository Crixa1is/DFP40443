<?php
require 'includes/function.php';
include 'includes/header.php';
// Check if data was actually posted
if (isset($_POST['user']) && isset($_POST['pass'])) {
 $user = $_POST['user'];
 $pass = $_POST['pass'];
 // Use our reusable function!
 if (isValidUser($user, $pass)) {
 echo "<h1>Welcome to your Dashboard</h1>";
 echo "<p>Successfully authenticated as: " . htmlspecialchars($user) . "</p>";
 } else {
 echo "<h2 style='color:red;'>Access Denied!</h2>";
 echo "<a href='index.php'>Try Again</a>";}
} else {
 // If someone tries to access dashboard.php directly without the form
 echo "<h2>Please login first.</h2>";}
include 'includes/footer.php';
?>