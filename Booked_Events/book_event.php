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

// Form data
$event_id = $_POST['event']; 
$contact_name = $_POST['contact_name'];
$contact_email = $_POST['contact_email'];
$contact_phone = $_POST['contact_phone'];
$num_guests = $_POST['num_guests'];
$special_requests = $_POST['special_requests'];

// insert event booking
$sql = "INSERT INTO EventBookings (event_id, contact_name, contact_email, contact_phone, num_guests, special_requests)
        VALUES ('$event_id', '$contact_name', '$contact_email', '$contact_phone', '$num_guests', '$special_requests')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Reservation successfully made!";
    header("Location: display_events.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
