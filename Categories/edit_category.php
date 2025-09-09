<?php
// Include database connection
require_once 'db_connection.php';

// Check if category ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $category_id = $_GET['id'];
    
    // Fetch category details from the database
    $sql = "SELECT * FROM categories WHERE category_id = $category_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
    } else {
        echo "Category not found.";
        exit();
    }
} else {
    echo "Category ID not provided.";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL Injection
    $categoryName = mysqli_real_escape_string($conn, $_POST['categoryName']);

    // Update category in the database
    $sql = "UPDATE categories SET category_name = '$categoryName' WHERE category_id = $category_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Category</h2>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $category['category_name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
