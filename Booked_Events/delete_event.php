<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rms_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete event booking from the database
    $sql = "DELETE FROM EventBookings WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page after successful deletion
        header("Location: display_events.php");
        exit();
    } else {
        echo "Error deleting event booking: " . $conn->error;
    }
} else {
    echo "No event booking ID provided.";
}

// Close connection
$conn->close();
?>
