<?php
    require_once "config/app_config.php";

    if($conn){
        echo "Connection Establish";
    }else{
        echo "Connection Failed";
        echo "<p>Error: ". mysqli_connect_error() . "</p>";
    }
?>