<?php
require_once 'config/app_config.php';
$error='';
    if($_SERVER ['REQUEST_METHOD']=== 'POST'){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if(isset($users[$username]) && $users[$username] === $password){
            //if it is right
            $_SESSION['username'] = $username;
            $_SESSION['score'] = 0;
            $_SESSION['soalanSemasa'] = 0;

            header('Location: Q1.php');
        } else {
            // if it is wrong
            $error = 'Invalid username or password';
        }
}

$pageTitle = 'Login';
require_once 'includes/heading.php';
?>
<?php
echo '<div style="text-align: center;"> <h3>Welcome to the Quiz<h> </div>';
echo '<div style="text-align: center;"> Please Enter your name before answering </div>';
?>
<?php if ($error): ?>
    <?php echo $error ?>
<?php endif; ?>
<form action="login.php" method= "POST" >
    <?php echo '<div style="text-align: center;">PHP Knowledge Questions</div>';?>
    <br>
    <?php
    echo  '<div style="text-align: center;"><p>Enter Name :
    <input type="text" name="username" id="username">
    <input type="password" name="password" id="password">
    <input type="submit" value="Start Quiz"></div>'
    ?>
</p>
</div>
</form>
<?php require_once 'includes/footer.php'; ?>