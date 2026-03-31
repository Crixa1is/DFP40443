<?php
require_once "config/app_config.php";
if ($conn) {
 echo "<h1>Database Connection Successful!</h1>";
 echo "<p>Connected to database: " . $dbname . "</p>";
}
