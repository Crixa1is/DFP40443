<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        die("Product not found in database!");
    }
} else {
    header("Location: view_products.php");
    exit();
}

if (isset($_POST['update_product'])) {
    $new_name = $_POST['product_name'];
    $new_price = $_POST['price'];
    $old_path = $_POST['old_image_path']; 
    $final_path = $old_path;

    if (!empty($_FILES["image"]["name"])) {
        $target_file = "product_images/" . time() . "_" . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            if (file_exists($old_path) && !empty($old_path)) {
                unlink($old_path); 
            }
            $final_path = $target_file;
        }
    }

    $update_sql = "UPDATE products SET product_name=?, price=?, image_path=? WHERE id=?";
    $up_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($up_stmt, "sdsi", $new_name, $new_price, $final_path, $id);
    
    if (mysqli_stmt_execute($up_stmt)) {
        header("Location: add_product.php?status=success");
        exit();
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Product</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary fw-bold">Edit Product</div>
            <div class="card-body">
                <form action="edit_product.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="old_image_path" value="<?= $product['image_path'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($product['product_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price (RM)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Current Image</label>
                        <img src="<?= $product['image_path'] ?>" width="100" class="d-block mb-2 img-thumbnail">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
                        <a href="view_products.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>