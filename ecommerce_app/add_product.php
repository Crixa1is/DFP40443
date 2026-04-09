<?php
    include("config/db.php");

    if(isset($_POST['submit'])){
        $name = $_POST['product_name'];
        $price = $_POST['price'];

        $sql = "INSERT INTO products (product_name,product_price) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sd",$name,$price);
        if($stmt->execute()){
            echo "Sucess";
           } else {
            echo "Failure";
    
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
        <div class="card m-4">
            <div class="card-header">Products</div>
            <form method="POST" action="db.php" enctype="multipart/form-data">
            <div class="card-body">
                
                <div class="form-label">Enter Product Name</div>
                <input type="text" name="product_name" id="product_name">
            </div>
            <div class="card-body">
                <div class="form-label">Enter Product Price</div>
                <input type="number" name="price" id="prie">
            </div>
            <div class="card-body">
                <div class="form-label">Enter Product Image</div>
                <input type="file" name="image_path" id="image_path">
            </div>
            <input class="m-3 btn btn-success" type="submit" value="Submit" name="submit">
        </form>
        </div>
    
</body>
</html>