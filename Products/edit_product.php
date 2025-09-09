<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>

    <div class="container mt-5">
        <h2>Edit Product</h2>
        <?php
        include 'db_connection.php';

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['productName'];
            $product_price = $_POST['productPrice'];
            $available_status = $_POST['availableStatus'];
            $product_description = $_POST['productDescription'];
            $category_id = $_POST['category']; // Get the selected category ID

            // Check if a new image file is uploaded
            if ($_FILES['productPicture']['size'] > 0) {
                $target_dir = "uploads/"; // Directory where the file will be stored
                $target_file = $target_dir . basename($_FILES["productPicture"]["name"]); // Full path of the file
                $uploadOk = 1; // Flag to check if the file was uploaded successfully
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // File extension

                // Check if the file is an actual image
                $check = getimagesize($_FILES["productPicture"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists, if yes, remove the old image file
                if (file_exists($target_file)) {
                    unlink($target_file);
                }

                // Upload the new image file
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["productPicture"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["productPicture"]["name"])). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                
                // Update query including the product picture and category
                $sql = "UPDATE products SET product_name='$product_name', product_price='$product_price', available_status='$available_status', product_description='$product_description', product_picture='$target_file', category_id='$category_id' WHERE product_id=$product_id";
            } else {
                // Update query without changing the product picture
                $sql = "UPDATE products SET product_name='$product_name', product_price='$product_price', available_status='$available_status', product_description='$product_description', category_id='$category_id' WHERE product_id=$product_id";
            }

            if ($conn->query($sql) === TRUE) {
                echo "Product updated successfully.";
                header("Location: index.php");
            } else {
                echo "Error updating product: " . $conn->error;
            }
        } else {
            // Check if product ID is provided
            if (isset($_GET['id'])) {
                $product_id = $_GET['id'];

                // Query to retrieve product details
                $sql_product = "SELECT * FROM products WHERE product_id=$product_id";
                $result_product = $conn->query($sql_product);

                // Query to retrieve categories
                $sql_categories = "SELECT * FROM categories";
                $result_categories = $conn->query($sql_categories);

                if ($result_product->num_rows > 0) {
                    $row_product = $result_product->fetch_assoc();
                    // Product details
                    $product_name = $row_product['product_name'];
                    $product_picture = $row_product['product_picture'];
                    $product_price = $row_product['product_price'];
                    $available_status = $row_product['available_status'];
                    $product_description = $row_product['product_description'];
                    $category_id = $row_product['category_id']; // Get current category ID

                    // Display form for editing
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" value="<?= $product_name ?>" required>
            </div>
            <div class="form-group">
                <label for="productPicture">Product Picture</label>
                <input type="file" class="form-control-file" id="productPicture" name="productPicture" onchange="previewImage(event)">
                <img id="preview" src="<?= $product_picture ?>" alt="Product Image" style="max-width: 100px;">
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price ($)</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" min="0" step="0.01" value="<?= $product_price ?>" required>
            </div>
            <div class="form-group">
                <label for="availableStatus">Availability</label>
                <select class="form-control" id="availableStatus" name="availableStatus">
                    <option value="1" <?= $available_status ? 'selected' : '' ?>>Available</option>
                    <option value="0" <?= !$available_status ? 'selected' : '' ?>>Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?= $product_description ?></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    // Loop through categories and display options
                    while ($category_row = $result_categories->fetch_assoc()) {
                        $cat_id = $category_row['category_id'];
                        $cat_name = $category_row['category_name'];
                        ?>
                        <option value="<?= $cat_id ?>" <?= ($cat_id == $category_id) ? 'selected' : '' ?>>
                            <?= $cat_name ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
        <?php
                } else {
                    echo "Product not found.";
                }
            } else {
                echo "Product ID not provided.";
            }
        }
        ?>
    </div>
</body>
</html>
