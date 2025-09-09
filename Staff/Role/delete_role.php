<?php
require_once 'db_connection.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $role_id = $_GET['id'];

    $sql = "DELETE FROM roles WHERE role_id = $role_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Role ID not provided.";
}

$conn->close();
?>
