<?php
include("config/app_config.php");

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: main_page.php?error=unauthorized");
    exit();
}

$message = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM movies WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $movie = mysqli_fetch_assoc($result);

    if (!$movie) {
        header("Location: main_page.php");
        exit();
    }
}

if (isset($_POST['update_movie'])) {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $genre = $_POST['genre'];
    $date  = $_POST['release_date'];
    $desc  = trim($_POST['desc']);
    $old_image = $_POST['old_image'];

    if ($_FILES['pic']['name'] != "") {
        $image_name = time() . "_" . $_FILES['pic']['name'];
        $target = "images/" . $image_name;

        if (file_exists("images/" . $old_image)) {
            unlink("images/" . $old_image);
        }
        move_uploaded_file($_FILES['pic']['tmp_name'], $target);
    } else {
        $image_name = $old_image;
    }

    $sql = "UPDATE movies SET title=?, genre=?, release_date=?, description=?, image=? WHERE id=?";
    $stmt_upd = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt_upd, "sssssi", $title, $genre, $date, $desc, $image_name, $id);

    if (mysqli_stmt_execute($stmt_upd)) {
        header("Location: main_page.php?status=updated");
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Update failed: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie - MovieDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Movie Details</h4>
                    </div>
                    <div class="card-body p-4">
                        <?= $message ?>
                        
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                            <input type="hidden" name="old_image" value="<?= $movie['image'] ?>">

                            <div class="mb-3">
                                <label class="form-label">Movie Title</label>
                                <input type="text" name="title" class="form-control" 
                                       value="<?= htmlspecialchars($movie['title']) ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Genre</label>
                                    <select name="genre" class="form-select" required>
                                        <option value="Action" <?= $movie['genre'] == 'Action' ? 'selected' : '' ?>>Action</option>
                                        <option value="Comedy" <?= $movie['genre'] == 'Comedy' ? 'selected' : '' ?>>Comedy</option>
                                        <option value="Drama" <?= $movie['genre'] == 'Drama' ? 'selected' : '' ?>>Drama</option>
                                        <option value="Sci-Fi" <?= $movie['genre'] == 'Sci-Fi' ? 'selected' : '' ?>>Sci-Fi</option>
                                        <option value="Horror" <?= $movie['genre'] == 'Horror' ? 'selected' : '' ?>>Horror</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Release Date</label>
                                    <input type="date" name="release_date" class="form-control" 
                                           value="<?= $movie['release_date'] ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="desc" class="form-control" rows="4" required><?= htmlspecialchars($movie['description']) ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Update Movie Poster (Optional)</label>
                                <div class="mb-2">
                                    <img src="images/<?= $movie['image'] ?>" width="100" class="img-thumbnail" alt="Current Poster">
                                    <small class="text-muted d-block">Current Poster</small>
                                </div>
                                <input type="file" name="pic" class="form-control" accept="image/*">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="update_movie" class="btn btn-success px-4">Update Movie</button>
                                <a href="main_page.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>