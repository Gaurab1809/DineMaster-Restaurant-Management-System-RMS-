<?php
include 'db_connection.php';

// Check if product ID is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM products WHERE product_id=$product_id";

    echo "<script>alert('Do you want to Delete the Product?');</script>";

    if ($conn->query($sql) === TRUE) {
        // Display JavaScript alert message
        echo "<script>alert('Product deleted successfully.');</script>";

        // Redirect to index.php after successful deletion
        echo "<script>window.location.href = 'index.php';</script>";
        exit(); // Ensure that script execution stops after redirect
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "Product ID not provided.";
}
?>
