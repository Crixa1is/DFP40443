<?php
    $host = "127.0.0.1:3307";
    $user = "root";
    $pass = "";
    $db = "spmp";

    $conn = mysqli_connect($host,$user,$pass,$db);
    if (!$conn){
        die("Failure to connect: ".mysqli_connect_error());
    }
?>