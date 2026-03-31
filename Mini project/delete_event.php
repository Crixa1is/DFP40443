<?php
include("config/app_config.php");

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: main_page.php?error=unauthorized");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    
    $sql = "DELETE FROM event WHERE event_id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: main_page.php?status=deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: main_page.php");
}
?>