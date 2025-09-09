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

// Initialize variables
$eventName = "";
$description = "";
$contactName = "";
$contactEmail = "";
$contactPhone = "";
$numGuests = "";
$specialRequests = "";

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // event booking details from the database
    $sql = "SELECT Events.name AS eventName, Events.description AS eventDescription, EventBookings.* FROM EventBookings INNER JOIN Events ON EventBookings.event_id = Events.id WHERE EventBookings.id = $id";
    $result = $conn->query($sql);

    if ($result === false) {
        // Handle query execution error
        echo "Error executing query: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        // Display event booking details in a form for editing
        $row = $result->fetch_assoc();
        $eventName = $row['eventName'];
        $description = $row['eventDescription'];
        $contactName = $row['contact_name'];
        $contactEmail = $row['contact_email']; 
        $contactPhone = $row['contact_phone'];
        $numGuests = $row['num_guests']; 
        $specialRequests = $row['special_requests']; 
    } else {
        echo "No event booking found with ID: $id";
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-control {
            border-radius: 3px;
            border-color: #ccc;
        }

        h2 {
            color: #007bff;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Event Booking</h2>
        <!-- Error message display -->
        <?php if(isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        <form action="update_event.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" class="form-control" id="eventName" name="eventName" value="<?php echo $eventName; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" readonly><?php echo $description; ?></textarea>
            </div>
            <!-- Fields for editing personal information -->
            <div class="form-group">
                <label for="contactName">Your Name:</label>
                <input type="text" class="form-control" id="contactName" name="contactName" value="<?php echo $contactName; ?>" required>
            </div>
            <div class="form-group">
                <label for="contactEmail">Your Email:</label>
                <input type="email" class="form-control" id="contactEmail" name="contactEmail" value="<?php echo $contactEmail; ?>" required>
            </div>
            <div class="form-group">
                <label for="contactPhone">Your Phone:</label>
                <input type="text" class="form-control" id="contactPhone" name="contactPhone" value="<?php echo $contactPhone; ?>" required>
            </div>
            <div class="form-group">
                <label for="numGuests">Number of Guests:</label>
                <input type="number" class="form-control" id="numGuests" name="numGuests" value="<?php echo $numGuests; ?>" required>
            </div>
            <div class="form-group">
                <label for="specialRequests">Special Requests:</label>
                <textarea class="form-control" id="specialRequests" name="specialRequests"><?php echo $specialRequests; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
