<?php
<<<<<<< HEAD
include 'db.php';
$nameErr = $priceErr = $imageErr = "";
$pname = $pprice = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = htmlspecialchars(stripslashes(trim($_POST['product_name'])));
    $pprice = $_POST['price'];
    
    $valid = true;

    if (empty($pname)) { $nameErr = "Name is required"; $valid = false; }
    if (!is_numeric($pprice) || $pprice <= 0) { $priceErr = "Valid price required"; $valid = false; }

    $target_dir = "product_images/";
    if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
    
    $file_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["image"]["size"] > 2000000) { $imageErr = "File too large (Max 2MB)"; $valid = false; }
    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) { $imageErr = "Only JPG, JPEG, PNG allowed"; $valid = false; }

    if ($valid) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO products (product_name, price, image_path) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sds", $pname, $pprice, $target_file);
            
            if (mysqli_stmt_execute($stmt)) {
                header("Location: add_product.php");
                    exit();
            }
            mysqli_stmt_close($stmt);
        }
    }
}
=======
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

>>>>>>> 7be615c34e67db10c24081f18f91dbdf80c28782
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary">
            Add New Product
        </div>
        <div class="card-body">
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class>
            <label>Product Name</label>
            <input type="text" name="product_name" id="pname" class="form-control" value="<?php echo $pname; ?>">
            <span class="text-danger"><?php echo $nameErr; ?></span>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" id="pprice" class="form-control" value="<?php echo $pprice; ?>">
            <span class="text-danger"><?php echo $priceErr; ?></span>
        </div>
        <div class="mb-3">
            <label>Product Image</label>
            <input type="file" name="image" id="pimage" class="form-control">
            <span class="text-danger"><?php echo $imageErr; ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Upload Product</button>
        <a href="view_products.php" class="btn btn-danger">Cancel</a>
    </p>    
    </form></div>


    <script>
    function validateForm() {
        let name = document.getElementById('pname').value;
        let price = document.getElementById('pprice').value;
        let image = document.getElementById('pimage').value;
        if (name == "" || price == "" || image == "" || price <= 0) {
            alert("All fields are required and price must be positive!");
            return false;
        }
        return true;
    }
    </script>
=======
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
    
>>>>>>> 7be615c34e67db10c24081f18f91dbdf80c28782
</body>
</html>