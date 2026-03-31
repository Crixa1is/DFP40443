<?php
require_once("config/app_config.php");
    $maklumat = mysqli_query($conn,"UPDATE users SET username=?,role_id? WHERE id=?;");
    if($_SERVER["REQUEST_METHOD"] == "POST" &&isset($_POST["update_user"])){
        $userid = $_POST['user_id'];

       $userid = $_POST["user_id"];
       $user_id = $_POST["user_id"];
       $username = $_POST["username"];
       $role_id = $_POST["role_id"];

       $stmt = mysqli_prepare($conn,"UPDATE users SET username=?,role_id? WHERE id=?;");
       mysqli_stmt_bind_param($stmt,"ssi",$user_id,$username,$role_id);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_close($conn);
}

    if(isset($_POST["edit_id"])){
        $id = $_GET["edit_id"];
        $stmt = mysqli_prepare($conn,"SELECT * FROM users WHERE id=?;");
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($conn);
    
    }
    $roles_result = mysqli_query($conn,"SELECT * FROM roles ;");
    $user_roles_result = mysqli_query($conn,"SELECT * ");
?>
<?php
   echo "<h2>Edit Form</h2>" 
   echo <form action="">
        Username <input type="text" name="username">
        Role <select>
        <?php while($row = mysqli_fetch_array($roles_result)): ?>
        <?php if($row["id"] == $edit_user[role_id]) echo 'selected'; ?>
            <?php echo $row['name']; ?>
        </select>
   </form>
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h2>DELETE USER</h2>
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>username</th>
            <th>peranan</th>
            <th>tindakan</th>
        </tr>
        <?php while ($pengguna = mysqli_fetch_assoc($maklumat)): ?>
                <tr>
                <td><?php echo $pengguna['id']; ?></td>
                <td><?php echo $pengguna['pengguna']; ?></td>
                <td><?php echo $pengguna['peranan']; ?></td>
                <td>
                    <a href="update.php?edit_id=<?php echo $pengguna['id']; ?>">Update data</a>
                </td>
                </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>