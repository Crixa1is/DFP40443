<?php
include("config/app_config.php");

    $error ="";
    if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $sql ="SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

        if($password === $row['password']){
            $_SESSION['user'] = $row['username'];
            $_SESSION['role_id'] = $row['role_id'];
            header("Location: main_page.php");
        exit();
        } else {
            $error ="Invalid Password!";}
        } else {
            $error ="User not register!";
}}?>

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
    echo"
    
    <div class='container mt-5'>
        <div class='row'>
            <h1 style='text-align: center;'>SITS Club Event <br> Management System <br> Login</h1>  
        </div>
        ";

        if (!empty($error)){
            echo "<div class='alert alert-danger text-center'>$error</div>";
        }

        echo"
        <form method = 'POST'>
        <div class='row'>
            
            <h6>Username</h6>
            <input type='text' name='username' id='username' class='form-control' required>
        </div>
        <br>
        <div class='row'>
            <h6>Password</h6>
            <input type='password' name='password' id='password' class='form-control' required>
    </div>
    <br>
    <div class='row'><input type='submit' name='login' class='btn btn-primary' value='Login'>
    <br><br>
    <h6 style='text-align: center;'> Not registered yet? 
    <a href='signup.php'>Sign Up</a> </h6>
    </form>   
</div>"
?>
</body>
</html>