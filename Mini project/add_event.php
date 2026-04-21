<?php
    include("config/app_config.php");

    if (isset($_POST['save_event'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $date  = mysqli_real_escape_string($conn, $_POST['date']);
    $loc   = mysqli_real_escape_string($conn, $_POST['loc']);
    $desc  = mysqli_real_escape_string($conn, $_POST['desc']);
    $type  = mysqli_real_escape_string($conn, $_POST['type']);

    $image_name = $_FILES['pic']['name'];
    $temp_name  = $_FILES['pic']['tmp_name'];
    $folder     = "images/" . $image_name;

    $sql = "INSERT INTO event (event_name, event_date, event_location, event_description, event_image, event_type) 
    VALUES ('$title', '$date', '$loc', '$desc', '$image_name', '$type')";

    

    if (mysqli_query($conn, $sql)) {
        if (!is_dir('images')) {
            mkdir('images');
            }

        move_uploaded_file($temp_name, $folder);

        header("Location: main_page.php?success=added");
        exit();
    } else {
        echo "Error saving event: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>   
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo "<div class='alert alert-success text-center'> Event successfully added to the system!</div>";
        } elseif ($_GET['status'] == 'error') {
            echo "<div class='alert alert-danger text-center'> Error: Could not save event. Check your database connection.</div>";
        }
    }
    ?>
    <form method = 'POST' enctype='multipart/form-data'>
    <div class='card mt-6' style='margin: 20px; margin-bottom: 20px;' >
            <div class='container'>
            <div class='row mt-4'>
                <h6>Title</h6>
                <input type='text' name='title' id='title' class='form-control' required>
            </div>
            <br>
            <div class='row'>
                <h6>Date</h6>
                <input type='date' name='date' id='date' class='form-control' required>
            </div> 
            <br>
            <div class='row'>
                <h6>Location</h6>
                <input type='text' name='loc' id='loc' class='form-control' required>
            </div>
            <br>
            <div class='row'>
                <h6>Event Type</h6>
            <select name='type' id='type' class='form-control' required>
                <option value=''>Select event type--</option>
                <option value='Academic'>Academic</option>
                <option value='Sport'>Sport</option>
                <option value='Fundraiser'>Fundraiser</option>
                <option value='Other'>Other</option>    
            </select>
            </div>
            <br>
            <div class='row'>
                <h6> Description </h6>
                <textarea name='desc' class='form-control' rows='4'required></textarea>
            <div class='row'>
                <h6>Event Image</h6>
                <input type='file' name='pic' id='pic' class='form-control' required>
            </div></div>
            <br>
            <div class='col-sm-6 mb-5' >
                <input type='submit' name='save_event' value='Save Event' class='btn btn-primary'>
                <a href='main_page.php' class='btn btn-danger'>Cancel</a>
            </div></div></div>" 
    ?>
</body>
</html>