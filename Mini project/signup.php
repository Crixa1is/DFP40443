<?php

require_once 'config/app_config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = ($_POST['password']);
    $role = $_POST['role_id'];

    $checking = mysqli_query($conn, "SELECT*FROM user WHERE username='$username'");

    if(mysqli_num_rows($checking)> 0){
        echo "<h6 style = 'text-align: center'>Username already exist</h6>";
    }else {
        $sql = "INSERT INTO user(username,password,role_id) VALUES('$username','$password','$role')";
        if(mysqli_query($conn,$sql)){
        echo "<h6 style = 'text-align: center'>Registration Successful!</h6>";
        } else {
        echo "<h6 style = 'text-align: center'> Error: ' . mysqli_error($conn)";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
        echo "
            <form method='POST'>
            <div class='container mt-5'>
            <div class='row'>
            <h2 style='text-align: center;'>Sign up <br> to access latest <br> events news</h2>
        
            <h6>Enter username</h6>
            <input type='text' name='username' id='username' class='form-control' required>
            <h6>Enter password</h6>
            <input type='password' name='password' id='password' class='form-control' required>
            <h6>Select role</h6>
            <select name='role_id' id='role_id' class='form-control' required>
                <option value=''>Select role--</option>
                <option value='2'>Student</option>
                <option value='1'>Admin</option>
            </select>
        </div>
        <br>
        <input type='submit' name='register' value='Sign up' class='btn btn-primary'>
        
    </div>
    </form>"
    ?>
</body>
</html>