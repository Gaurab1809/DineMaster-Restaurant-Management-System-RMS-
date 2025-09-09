<?php
session_start();

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

// Function to sanitize input data
function sanitize_input($data) {
    // Remove leading and trailing whitespace
    $data = trim($data);
    // Remove HTML and PHP tags from the data
    $data = htmlspecialchars($data);
    return $data;
}

// event details for editing
if(isset($_GET['id'])) {
    $event_id = sanitize_input($_GET['id']);

    // event details from database
    $sql = "SELECT * FROM events WHERE id='$event_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Event found, fetch details
        $row = $result->fetch_assoc();
        $event_name = $row['NAME'];
        $description = $row['description'];
        $start_date = $row['Startdate'];
        $end_date = $row['Enddate'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
    } else {
        $_SESSION['error_message'] = "Event not found.";
        header("Location: events.php");
        exit();
    }
}

// Update event details
if(isset($_POST['update'])) {
    $event_id = sanitize_input($_POST['id']);
    $event_name = sanitize_input($_POST['name']);
    $description = sanitize_input($_POST['description']);
    $start_date = sanitize_input($_POST['start_date']);
    $end_date = sanitize_input($_POST['end_date']);
    $start_time = sanitize_input($_POST['start_time']);
    $end_time = sanitize_input($_POST['end_time']);

    // Update event in database
    $sql = "UPDATE events SET name='$event_name', description='$description', Startdate='$start_date', Enddate='$end_date', start_time='$start_time', end_time='$end_time' WHERE id='$event_id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Event updated successfully.";
        header("Location: events.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error updating event: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
        h2 {
            color: #007bff;
            text-align: center;
        }

        .form-control {
            border-radius: 3px;
            border-color: #ccc;
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
        <h2>Edit Event</h2>
        <?php
        if(isset($_SESSION['error_message'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']);
        }
        ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $event_id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $event_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date; ?>" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date; ?>" required>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo $start_time; ?>" required>
            </div>
            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo $end_time; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="events.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
