<?php
include("config/app_config.php");
if(!isset($_SESSION['user'])) { header("Location: login_page.php"); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Movie Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS to ensure the full picture is visible without stretching */
        .image-container {
            width: 100%;
            height: 350px;
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .card { transition: transform 0.2s; }
        .card:hover { transform: scale(1.02); }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <span class="navbar-brand">Movie Management System</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-light small">Welcome, <?= htmlspecialchars($_SESSION['user']) ?></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Movie Catalog</h3>
            <?php if($_SESSION['role_id'] == 1): ?>
                <a href="add_movie.php" class="btn btn-primary">+ Add New Movie</a>
            <?php endif; ?>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by movie title...">
            </div>
            <div class="col-md-4">
                <select id="genreFilter" class="form-select">
                    <option value="">All Genres</option>
                    <option value="Action">Action</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Drama">Drama</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Horror">Horror</option>
                </select>
            </div>
        </div>

        <div id="movieContainer" class="row">
            </div>
    </div>

    <script>
    const movieContainer = document.getElementById('movieContainer');
    const searchInput = document.getElementById('searchInput');
    const genreFilter = document.getElementById('genreFilter');
    const userRole = <?= $_SESSION['role_id'] ?>;

    function loadMovies() {
        const searchVal = searchInput.value;
        const genreVal = genreFilter.value;

        fetch(`fetch_movies.php?search=${searchVal}&genre=${genreVal}`)
            .then(response => response.json())
            .then(data => {
                movieContainer.innerHTML = ''; 

                if (data.length === 0) {
                    movieContainer.innerHTML = '<div class="col-12 text-center mt-5"><p class="text-muted">No movies found.</p></div>';
                    return;
                }

                data.forEach(movie => {
                    let adminButtons = '';
                    if (userRole == 1) {
                        adminButtons = `
                            <div class="mt-auto pt-3 border-top">
                                <a href="edit_movie.php?id=${movie.id}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete_movie.php?id=${movie.id}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this movie?')">Delete</a>
                            </div>
                        `;
                    }

                    movieContainer.innerHTML += `
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="image-container">
                                    <img src="images/${movie.image}" alt="${movie.title}">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title fw-bold">${movie.title}</h6>
                                    <p class="text-muted small mb-0">${movie.genre}</p>
                                    <p class="text-muted small">${movie.release_date}</p>
                                    ${adminButtons}
                                </div>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading movies:', error));
    }

    // Event listeners for real-time filtering
    searchInput.addEventListener('input', loadMovies);
    genreFilter.addEventListener('change', loadMovies);

    // Load movies on page load
    window.onload = loadMovies;
    </script>
</body>
</html>