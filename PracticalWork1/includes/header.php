<?php
$loggedIn= isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
        <nav>
            <a href="" >Home</a>
        <?php if($loggedIn): ?>
            <a href="Q1.php">Quiz</a>
            <a href="finish.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Log in</a>
        <?php endif; ?>
        </nav>
            <h1>Practical Work 1</h1>
    </header>
    <main>