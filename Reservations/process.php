<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rms_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert reservation
if (isset($_GET['submit'])) { 
    $name = $_GET['name'];
    $email = $_GET['email'];
    $datetime = $_GET['datetime'];
    $guests = $_GET['guests']; 

    // Separate date and time
    $datetime_parts = explode('T', $datetime);
    $date = $datetime_parts[0];
    $time = $datetime_parts[1];

    $sql = "INSERT INTO reservation (customer_name, email, reservation_date, reservation_time, num_guests) VALUES ('$name', '$email', '$date', '$time', '$guests')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Reservation successfully made!";
        // Redirect to updatedelete.php
        header("Location: updatedelete.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
