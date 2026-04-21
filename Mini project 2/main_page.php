<?php
include("config/app_config.php");
if(!isset($_SESSION['user'])) { header("Location: login_page.php"); exit(); }

$res = mysqli_query($conn, "SELECT * FROM movies ORDER BY release_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Movie Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <span class="navbar-brand">Movie Management System</span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>Recent Movies</h3>
            <?php if($_SESSION['role_id'] == 1): ?>
                <a href="add_movie.php" class="btn btn-primary">+ Add Movie</a>
            <?php endif; ?>
        </div>

        <div class="row mt-3">
            <?php while($movie = mysqli_fetch_assoc($res)): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="images/<?= $movie['image'] ?>" class="card-img-top" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
                        <p class="text-muted small"><?= $movie['genre'] ?> | <?= $movie['release_date'] ?></p>
                        <?php if($_SESSION['role_id'] == 1): ?>
                            <a href="edit_movie.php?id=<?= $movie['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_movie.php?id=<?= $movie['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>