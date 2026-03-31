<?php
    include("config/app_config.php");
    require_once "includes/header.php";

    if(!isset($_SESSION['user'])){
    header("Location: login_page.php");
    exit();}

    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $date   = isset($_GET['date']) ? mysqli_real_escape_string($conn, $_GET['date']) : '';

    $sql = "SELECT * FROM event WHERE 1=1";
    if (!empty($search)) { $sql .= " AND event_name LIKE '%$search%'"; }
    if (!empty($date)) { $sql .= " AND event_date = '$date'"; }
    $sql .= " ORDER BY event_date ASC";

    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Club Events</title>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
        <?php
        // We REMOVED the $sql and $result lines from here 
        // because they are already handled at the very top of the file.

        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)): 
        ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="images/<?= $row['event_image'] ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                    
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold"><?= $row['event_name'] ?></h5>
                        <p class="mb-1"><small>📅 <?= $row['event_date'] ?></small></p>
                        <p class="mb-2"><small>📍 <?= $row['event_location'] ?></small></p>
                        <p class="card-text text-secondary"><?= $row['event_description'] ?></p>
                    </div>

                    <div class="card-footer bg-white border-0 pb-3">
                        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                            <div class="d-flex gap-2 mt-2">
                                <a href="edit_event_page.php?id=<?= $row['event_id'] ?>" class="btn btn-primary btn-sm flex-grow-1">Edit</a>
                                <a href="delete_event.php?id=<?= $row['event_id'] ?>" 
                                   class="btn btn-danger btn-sm flex-grow-1" 
                                   onclick="return confirm('Are you sure you want to delete this event?');">
                                   Delete
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php 
            endwhile; 
        else: 
        ?>
            <div class="col-12 text-center mt-5">
                <h3 class="text-muted">No events found matching your filter.</h3>
                <a href="main_page.php" class="btn btn-secondary mt-3">Reset Filters</a>
            </div>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>