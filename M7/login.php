<?php
    //function will be here
    include("includes/header.php");
    $config = include ('config/app_config.php')
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale-1.0">
    </head>
    <body>
        
<form action="process_login.php" method="POST">
    Enter Username
    <input type="text" name="username">
    <br><br>
    Enter Password 
    <input type="password" name="password">
    <br><br>
    <input type="submit" value="Enter">
</form>
</body>
</html>