<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "rms_database"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving data from the form
$name = $_POST['name'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

// Inserting data into the database
$sql = "INSERT INTO events (name, description, Startdate, Enddate, start_time, end_time) VALUES ('$name', '$description', '$start_date', '$end_date', '$start_time', '$end_time')";

if ($conn->query($sql) === TRUE) {
    echo "Event created successfully";
    header("Location: events.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
