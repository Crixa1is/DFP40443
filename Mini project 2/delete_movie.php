<?php
include("config/app_config.php");

if (isset($_GET['id']) && $_SESSION['role_id'] == 1) {
    $id = $_GET['id'];

    $stmt = mysqli_prepare($conn, "SELECT image FROM movies WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    if ($row) {
        $path = "images/" . $row['image'];
        if (file_exists($path)) { unlink($path); } 
    }
    
    $del = mysqli_prepare($conn, "DELETE FROM movies WHERE id = ?");
    mysqli_stmt_bind_param($del, "i", $id);
    mysqli_stmt_execute($del);

    header("Location: main_page.php?deleted=1");
}
?>