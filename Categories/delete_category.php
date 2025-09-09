<?php
// Include database connection
require_once 'db_connection.php';

// Check if category ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $category_id = $_GET['id'];

    // Delete category from the database
    $sql = "DELETE FROM categories WHERE categorie_id = $category_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Category ID not provided.";
}

// Close database connection
$conn->close();
?>
