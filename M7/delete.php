<?php
require_once("config/app_config.php");
    $maklumat = mysqli_query($conn,"SELECT users.id, username as pengguna, email, password ,name as peranan  FROM spmp.users join roles on users.role_id = roles.id;");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userid = $_POST['user_id'];

        $stmt = mysqli_prepare($conn,'DELETE FROM users WHERE id=?;');
        mysqli_stmt_bind_param($stmt,'i', $userid);

        if(mysqli_stmt_execute($stmt)) {
            $mesej = "<p style = 'color:green'>User succesfully deleted</p>";
    } else {
        $mesej = "<p style = 'color:red'>User fail to be deleted</p>";
    }
}
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
                    <form action="" method = "POST">
                        <input type="hidden" class="btn btn-danger" name="user_id" value="<?php echo $pengguna['id']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
                </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>