<?php
session_start();

// Check if feedback ID is provided
if (!isset($_GET['id'])) {
    $_SESSION['delete_message'] = "Feedback ID not provided!";
    header("Location: display_feedback.php");
    exit();
}

$id = $_GET['id'];

// Authentication
$authorized_host = "localhost"; // Change this to the authorized host
$current_host = $_SERVER['HTTP_HOST'];
if ($current_host !== $authorized_host) {
    $_SESSION['delete_message'] = "Unauthorized access!";
    header("Location: display_feedback.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "rms_database"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete feedback data from the database
$sql = "DELETE FROM feedback WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['delete_message'] = "Feedback deleted successfully!";
} else {
    $_SESSION['delete_message'] = "Error deleting feedback: " . $conn->error;
}

// Close connection
$conn->close();

// Redirect back to display_feedback.php
header("Location: display_feedback.php");
exit();
?>
