<?php
include("config/app_config.php");

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: main_page.php?error=unauthorized");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM event WHERE event_id = '$id'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Event not found!";
        exit();
    }
} else {
    header("Location: main_page.php");
    exit();
}


if (isset($_POST['update_event'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $date  = mysqli_real_escape_string($conn, $_POST['date']);
    $loc   = mysqli_real_escape_string($conn, $_POST['loc']);
    $desc  = mysqli_real_escape_string($conn, $_POST['desc']);
    $type  = mysqli_real_escape_string($conn, $_POST['type']);

    if (!empty($_FILES['pic']['name'])) {
        // User uploaded a NEW image
        $image_name = $_FILES['pic']['name'];
        $temp_name  = $_FILES['pic']['tmp_name'];
        move_uploaded_file($temp_name, "images/" . $image_name);
    } else {
        $image_name = $row['event_image'];
    }

    $update_sql = "UPDATE event SET 
                   event_name = '$title', 
                   event_date = '$date', 
                   event_location = '$loc', 
                   event_description = '$desc', 
                   event_image = '$image_name',
                   event_type = '$type' 
                   WHERE event_id = '$id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: main_page.php?status=updated");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Event</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 650px;">
            <div class="card-header text-dark fw-bold">
                Edit Event Details
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label class="form-label">Event Name</label>
                        <input type="text" name="title" class="form-control" value="<?= $row['event_name'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="<?= $row['event_date'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="loc" class="form-control" value="<?= $row['event_location'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Event Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="" <?= ($row['event_type'] == '') ? 'selected' : '' ?>>Select event type--</option>
                            <option value="Sport" <?= ($row['event_type'] == 'Sport') ? 'selected' : '' ?>>Sport</option>
                            <option value="Academic" <?= ($row['event_type'] == 'Academic') ? 'selected' : '' ?>>Academic</option>
                            <option value="Fundraiser" <?= ($row['event_type'] == 'Fundraiser') ? 'selected' : '' ?>>Fundraiser</option>
                            <option value="Sport" <?= ($row['event_type'] == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="desc" class="form-control" rows="5" required><?php echo $row['event_description']; ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Event Image</label>
                        <div class="mb-2">
                            <small class="text-muted">Current image: <b><?= $row['event_image'] ?></b></small>
                        </div>
                        <input type="file" name="pic" class="form-control">
                        <small class="text-secondary">Only upload a file if you want to change the current photo.</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="update_event" class="btn btn-primary px-4">Save Changes</button>
                        <a href="main_page.php" class="btn btn-outline-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>