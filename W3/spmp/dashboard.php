<?php
    session_start();
    if (!isset($_SESSION['loggedin']) ||
    $_SESSION['loggedin'] !== true){
        header("Location:login.php");
        exit();
    }
?>

<html>
    <head>
        
    </head>
    <body>
        <h2>Welcome to The Dashboard <?php echo $_SESSION['username']; ?> </h2>
        <a href="logout.php" >Log out</a>
    </body>
</html>