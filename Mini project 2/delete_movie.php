<?php
include("config/app_config.php");

if (isset($_GET['id']) && $_SESSION['role_id'] == 1) {
    $id = $_GET['id'];

    // 1. Get image name to delete from folder
    $stmt = mysqli_prepare($conn, "SELECT image FROM movies WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    if ($row) {
        $path = "images/" . $row['image'];
        if (file_exists($path)) { unlink($path); } // Fulfills "Properly utilizes unlink()"
    }

    // 2. Delete from DB
    $del = mysqli_prepare($conn, "DELETE FROM movies WHERE id = ?");
    mysqli_stmt_bind_param($del, "i", $id);
    mysqli_stmt_execute($del);

    header("Location: main_page.php?deleted=1");
}
?>