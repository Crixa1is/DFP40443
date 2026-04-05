<?php
require_once "config/app_config.php";
if ($conn) {
 echo "<h1>Database Connection Successful!</h1>";
 echo "<p>Connected to database: " . $dbname . "</p>";
}else {
    echo "<h1>Failed to connect</h1>";
    echo "<p>Not able to connected to database: " . $dbname . "</p>";
}
