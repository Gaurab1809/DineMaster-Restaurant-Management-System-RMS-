<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_name = $_POST['role_name'];

    // Check if role already exists
    $sql_check = "SELECT * FROM roles WHERE role_name = '$role_name'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo 'exists';
    } else {
        // Insert role into the database
        $sql_insert = "INSERT INTO roles (role_name) VALUES ('$role_name')";
        if ($conn->query($sql_insert) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    $conn->close();
}
?>
