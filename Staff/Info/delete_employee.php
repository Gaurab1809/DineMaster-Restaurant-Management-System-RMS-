<?php
include 'db_connection.php';

// Check if employee ID is provided
if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM employees WHERE employee_id=$employee_id";

    echo "<script>alert('Do you want to delete the employee?');</script>";

    if ($conn->query($sql) === TRUE) {
        // Display JavaScript alert message
        echo "<script>alert('Employee deleted successfully.');</script>";

        // Redirect to index.php after successful deletion
        echo "<script>window.location.href = 'index.php';</script>";
        exit(); // Ensure that script execution stops after redirect
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
} else {
    echo "Employee ID not provided.";
}
?>
