<?php
require_once 'config/app_config.php';

$message = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']); 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role_id'];

    $check_sql = "SELECT username FROM users WHERE username = ?";
    $stmt_check = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt_check, "s", $username);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        $message = "<div class='alert alert-warning text-center'>Username already exists.</div>";
    } else {
        $sql = "INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        
        mysqli_stmt_bind_param($stmt, "ssi", $username, $password, $role);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php?status=success");
            exit(); 
        } else {
            $message = "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_stmt_close($stmt_check);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieDB - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="text-center mb-4">Create Account</h2>
        
        <?= $message ?>

        <form method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" 
                       value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role_id" class="form-select" required>
                    <option value="">Please select role</option>
                    <option value="2">User</option>
                    <option value="1">Administrator</option>
                </select>
            </div>
            
            <button type="submit" name="register" class="btn btn-primary w-100">Sign Up</button>
            
            <p class="mt-3 text-center">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </form>
    </div>
</body>
</html>