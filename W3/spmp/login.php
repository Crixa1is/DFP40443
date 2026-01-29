<?php
session_start();

 if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    if($username = "brandon" && $password == "root"){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        header("Location:dashboard.php");
        exit();
    }
 }
?>
<form method = "POST" action="">
    <input type="text" name="username" id="username" placeholder='Enter your username'>
    <br><br>
    <input type="password" name="password" id="password" placeholder='Enter your password'>
    <br><br>
    <input type="submit" value="Click here to Login">
</form>