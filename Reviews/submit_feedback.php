<?php
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

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comment) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $name, $email, $rating, $comment);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "Feedback submitted successfully";
    header("Location: display_feedback.php");
    exit(); // Make sure to exit after redirection
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
