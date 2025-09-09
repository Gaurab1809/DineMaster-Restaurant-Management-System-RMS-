<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style></style>
    <title>Restaurant Management System</title>
</head>
<body>
    <header>
        <h1>Products</h1>
        <p>Welcome, Admin</p>
    </header>
    <nav>
        <div id="nav-wrapper">
            <ul id="nav-list">
                <li><a href="http://localhost/RMS/Dashboard/index.php"><span class="material-icons">home</span>Dashboard</a></li>
                <li><a href="http://localhost/RMS/Categories/index.php"><span class="material-icons">category</span>Categories</a></li>
                <li><a href="http://localhost/RMS/Products/index.php" class="active"><span class="material-icons">local_drink</span>Products</a></li>
                <li><a href="http://localhost/RMS/Tables/index.php"><span class="material-icons">table_chart</span>Tables</a></li>
                <li><a href="http://localhost/RMS/Staff/index.php"><span class="material-icons">group</span>Staff</a></li>
                <li><a href="http://localhost/RMS/POS/index.php"><span class="material-icons">payment</span>POS</a></li>
                <li><a href="http://localhost/RMS/Kitchen/index.php"><span class="material-icons">kitchen</span>Kitchen</a></li>
                <li><a href="http://localhost/RMS/Reports/index.php"><span class="material-icons">bar_chart</span>Reports</a></li>
                <li><a href="http://localhost/RMS/Settings/index.php"><span class="material-icons">settings</span>Settings</a></li>
                <li><a href="http://localhost/RMS/Exit/index.php"><span class="material-icons">exit_to_app</span>Exit</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <?php
        // Include database connection
        include('db.php');

        // Fetch categories
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sql);

        // Fetch products
        $product_sql = "SELECT * FROM products";
        $product_result = mysqli_query($conn, $product_sql);

        // Add new category
        if(isset($_POST['add_category'])) {
            $categorie_name = $_POST['categorie_name'];
            $insert_category_sql = "INSERT INTO categories (categorie_name) VALUES ('$categorie_name')";
            mysqli_query($conn, $insert_category_sql);
            header("Location: products.php"); // Redirect to refresh the page
            exit();
        }

        // Add new product
        if(isset($_POST['add_product'])) {
            $categorie_id = $_POST['categorie_id'];
            $product_name = $_POST['product_name'];

            // File upload handling
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["product_picture"]["name"]);
            move_uploaded_file($_FILES["product_picture"]["tmp_name"], $target_file);
            $product_picture = $target_file;

            $product_price = $_POST['product_price'];
            $available_status = isset($_POST['available_status']) ? 1 : 0;
            $product_description = $_POST['product_description'];

            $insert_product_sql = "INSERT INTO products (categorie_id, product_name, product_picture, product_price, available_status, product_description) VALUES ('$categorie_id', '$product_name', '$product_picture', '$product_price', '$available_status', '$product_description')";
            mysqli_query($conn, $insert_product_sql);
            header("Location: products.php"); // Redirect to refresh the page
            exit();
        }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Management System</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Product Management System</h1>
            
            <!-- Add Category Form -->
            <h2>Add Category</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="categorie_name">Category Name:</label>
                    <input type="text" name="categorie_name" class="form-control" required>
                </div>
                <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
            </form>

            <!-- Add Product Form -->
            <h2>Add Product</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="categorie_id">Category:</label>
                    <select name="categorie_id" class="form-control" required>
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo $row['categorie_id']; ?>"><?php echo $row['categorie_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="product_picture">Product Picture:</label>
                    <input type="file" name="product_picture" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price:</label>
                    <input type="number" name="product_price" step="0.01" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="available_status">Available:</label>
                    <input type="checkbox" name="available_status" value="1" class="form-control" checked>
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description:</label>
                    <textarea name="product_description" class="form-control"></textarea>
                </div>
                <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
            </form>
            
            <!-- Products -->
            <div class="container">
                <h2>Products</h2>
                <?php
                include 'db.php'; // Include the database connection file

                // Query to fetch categories
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                // Display categories and corresponding products
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<h3>" . $row["categorie_name"] . "</h3>";

                        // Query to fetch products of this category
                        $products_sql = "SELECT * FROM products WHERE categorie_id=" . $row["categorie_id"];
                        $products_result = $conn->query($products_sql);

                        // Display products in a table
                        if ($products_result->num_rows > 0) {
                            echo "<table class='table'>";
                            echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Status</th><th>Action</th></tr>";
                            while($product_row = $products_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $product_row["product_id"] . "</td>";
                                echo "<td>" . $product_row["product_name"] . "</td>";
                                echo "<td>" . $product_row["product_price"] . "</td>";
                                echo "<td>" . $product_row["product_description"] . "</td>";
                                echo "<td><input type='checkbox' class='availability_toggle' data-productid='" . $product_row["product_id"] . "' " . ($product_row["available_status"] ? "checked" : "") . "></td>";
                                echo "<td>
                                        <a href='edit_product.php?id=" . $product_row['product_id'] . "' class='btn btn-sm btn-primary'>Edit</a>
                                        <a href='delete_product.php?id=" . $product_row['product_id'] . "' class='btn btn-sm btn-danger'>Delete</a>
                                    </td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No products found.";
                        }
                    }
                } else {
                    echo "No categories found.";
                }
                ?>
            </div>

            <script>
                $(document).ready(function() {
                    // Toggle availability status using AJAX
                    $(".availability_toggle").change(function() {
                        var product_id = $(this).data('productid');
                        var status = $(this).prop('checked') ? 1 : 0;

                        $.ajax({
                            url: 'update_availability.php',
                            type: 'POST',
                            data: { product_id: product_id, status: status },
                            success: function(response) {
                                // Handle success
                            },
                            error: function(xhr, status, error) {
                                // Handle error
                            }
                        });
                    });
                });
            </script>
        </div>
    </body>
    </html>

    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>
</html>
