<?php
include("config/app_config.php");

// Security: Only allow Administrators (Role 1) to access this page
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: main_page.php?error=unauthorized");
    exit();
}

$message = "";

if (isset($_POST['save_movie'])) {
    $title = trim($_POST['title']);
    $genre = $_POST['genre'];
    $date  = $_POST['release_date'];
    $desc  = trim($_POST['desc']);

    // Image Upload Logic
    $image_name = $_FILES['pic']['name'];
    $temp_name  = $_FILES['pic']['tmp_name'];
    
    // Generate a unique name to prevent overwriting files with the same name
    $unique_image_name = time() . "_" . $image_name;
    $folder = "images/" . $unique_image_name;

    if (!is_dir('images')) {
        mkdir('images');
    }

    // 1. Prepared Statement for Secure Insertion
    $sql = "INSERT INTO movies (title, genre, release_date, description, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $title, $genre, $date, $desc, $unique_image_name);

    if (mysqli_stmt_execute($stmt)) {
        move_uploaded_file($temp_name, $folder);
        header("Location: main_page.php?success=added");
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieDB - Add New Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Add New Movie to Database</h4>
                    </div>
                    <div class="card-body p-4">
                        <?= $message ?>
                        
                        <form method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Movie Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Please put the movie title here" 
                                       value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Genre</label>
                                    <select name="genre" class="form-select" required>
                                        <option value="">Select Genre--</option>
                                        <option value="Action">Action</option>
                                        <option value="Comedy">Comedy</option>
                                        <option value="Drama">Drama</option>
                                        <option value="Sci-Fi">Sci-Fi</option>
                                        <option value="Horror">Horror</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Release Date</label>
                                    <input type="date" name="release_date" class="form-control" 
                                           value="<?= isset($_POST['release_date']) ? $_POST['release_date'] : '' ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="desc" class="form-control" rows="4" required><?= isset($_POST['desc']) ? htmlspecialchars($_POST['desc']) : '' ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Movie Poster (Image)</label>
                                <input type="file" name="pic" class="form-control" accept="image/*" required>
                                <small class="text-muted">Accepted formats: JPG, PNG, GIF</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="save_movie" class="btn btn-primary px-4">Save Movie</button>
                                <a href="main_page.php" class="btn btn-outline-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>