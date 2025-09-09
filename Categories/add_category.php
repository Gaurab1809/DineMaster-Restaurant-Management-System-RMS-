<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];

    // Check if category already exists
    $sql_check = "SELECT * FROM categories WHERE category_name = '$category_name'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo 'exists';
    } else {
        // Insert category into the database
        $sql_insert = "INSERT INTO categories (category_name) VALUES ('$category_name')";
        if ($conn->query($sql_insert) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    $conn->close();
}
?>
