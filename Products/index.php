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
                <li><a href="http://localhost/RMS/Dashboard/index.php" class="active"><span class="material-icons">home</span>Dashboard</a></li>
                <li><a href="http://localhost/RMS/Categories/index.php"><span class="material-icons">category</span>Categories</a></li>
                <li><a href="http://localhost/RMS/Products/index.php"><span class="material-icons">local_drink</span>Products</a></li>
                <li><a href="http://localhost/RMS/Tables/index.php"><span class="material-icons">table_chart</span>Tables</a></li>
                <li><a href="http://localhost/RMS/Events/events.php"><span class="material-icons">event</span>Events</a></li>
                <li><a href="http://localhost/RMS/Staff/Info/index.php"><span class="material-icons">group</span>Staff</a></li>
                <li><a href="http://localhost/RMS/POS/index.php"><span class="material-icons">payment</span>POS</a></li>
                <li><a href="http://localhost/RMS/Kitchen/index.php"><span class="material-icons">kitchen</span>Kitchen</a></li>
                <li><a href="http://localhost/RMS/Reports/index.php"><span class="material-icons">bar_chart</span>Reports</a></li>
                <li><a href="http://localhost/RMS/Settings/index.php"><span class="material-icons">settings</span>Settings</a></li>
                <li><a href="http://localhost/RMS/Exit/index.php"><span class="material-icons">exit_to_app</span>Exit</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Product Management System</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <!-- <link rel="stylesheet" href="style.css"> -->
        </head>

        <body>
            <div class="container mt-5">
                <!-- Add icon and modal trigger button -->
                <!-- <div class="text-left mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-plus"></i> Add Product
            </button>
        </div>
         -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- Add Product button -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                            <i class="fas fa-plus"></i> Add Product
                        </button>
                    </div>
                    <div class="col-md-6">
                        <!-- Search bar -->
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Category" id="searchInput">
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form content -->
                                <form id="productForm" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" class="form-control" id="productName" name="productName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPrice">Product Price ($)</label>
                                        <input type="number" class="form-control" id="productPrice" name="productPrice" min="0" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="availableStatus">Availability</label>
                                        <select class="form-control" id="availableStatus" name="availableStatus">
                                            <option value="1">Available</option>
                                            <option value="0">Not Available</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productDescription">Product Description</label>
                                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPicture">Product Picture</label>
                                        <input type="file" class="form-control-file" id="productPicture" name="productPicture" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary" onclick="addProduct()">Add Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Search Bar -->



            <div id="searchResults">
                <!-- Search results will be loaded here -->
            </div>



            <!-- Table for showing the data from database -->
            <div class="container">
                <h2>Products by Category</h2>
                <style>
                    .custom-table th,
                    .custom-table td {
                        text-align: left;
                        /* Update to left alignment */
                        vertical-align: middle;
                    }

                    .custom-table th:nth-child(1),
                    .custom-table td:nth-child(1) {
                        width: 5%;
                    }

                    .custom-table th:nth-child(2),
                    .custom-table td:nth-child(2) {
                        width: 10%;
                    }

                    .custom-table th:nth-child(3),
                    .custom-table td:nth-child(3) {
                        width: 15%;
                    }

                    .custom-table th:nth-child(4),
                    .custom-table td:nth-child(4) {
                        width: 7%;
                    }

                    .custom-table th:nth-child(5),
                    .custom-table td:nth-child(5) {
                        width: 44%;
                    }

                    .custom-table th:nth-child(6),
                    .custom-table td:nth-child(6) {
                        width: 5%;
                    }

                    .custom-table th:nth-child(7),
                    .custom-table td:nth-child(7) {
                        width: 14%;
                    }
                </style>

                <?php
                include 'db_connection.php'; // Include the database connection file

                // Function to display product table row
                function displayProductRow($product_row)
                {
                ?>
                    <tr>
                        <td><?= $product_row["product_id"] ?></td>
                        <td>
                            <img src="<?= $product_row["product_picture"] ?>" alt="Product Image" style="max-width: 100px;">
                        </td>
                        <td><?= $product_row["product_name"] ?></td>
                        <td>$<?= $product_row["product_price"] ?></td>
                        <td><?= $product_row["product_description"] ?></td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input availability_toggle" id="customSwitch<?= $product_row["product_id"] ?>" data-productid="<?= $product_row["product_id"] ?>" <?= $product_row["available_status"] ? "checked" : "" ?>>
                                <label class="custom-control-label" for="customSwitch<?= $product_row["product_id"] ?>"></label>
                            </div>
                        </td>
                        <td>
                            <a href='edit_product.php?id=<?= $product_row['product_id'] ?>' class='btn btn-sm btn-primary'>Edit</a>
                            <a href='delete_product.php?id=<?= $product_row['product_id'] ?>' class='btn btn-sm btn-danger'>Delete</a>
                        </td>
                    </tr>
                    <?php
                }

                // Query to fetch categories
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                // Display categories and corresponding products
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <h3><?= $row["category_name"] ?></h3>
                        <?php

                        // Query to fetch products of this category
                        $products_sql = "SELECT * FROM products WHERE category_id=" . $row["category_id"];
                        $products_result = $conn->query($products_sql);

                        // Display products in a table
                        if ($products_result->num_rows > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($product_row = $products_result->fetch_assoc()) {
                                            displayProductRow($product_row);
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                <?php
                        } else {
                            echo "<p>No products found.</p>";
                        }
                    }
                } else {
                    echo "<p>No categories found.</p>";
                }
                ?>
            </div>







            <script src="script.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome for icons -->
            <script src="script.js"></script>
        </body>

        </html>

    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>

</html>