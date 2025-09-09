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

// sanitize input data
function sanitize_input($data) {
    global $conn;
    return htmlspecialchars(strip_tags($conn->real_escape_string($data)));
}

// update operation
if(isset($_POST['update'])) {
    $reservation_id = sanitize_input($_POST['id']);
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $datetime = sanitize_input($_POST['datetime']);
    $num_of_guests = sanitize_input($_POST['num_of_guests']); // New line for number of guests

    // Update reservation in database
    $sql = "UPDATE reservation SET customer_name='$name', email='$email', reservation_date=DATE('$datetime'), reservation_time=TIME('$datetime'), num_guests='$num_of_guests' WHERE reservation_id='$reservation_id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Reservation updated successfully.";
        header("Location: updatedelete.php");
        exit();
    } else {
        echo "Error updating reservation: " . $conn->error;
    }
}

if(isset($_GET['id'])) {
    $reservation_id = sanitize_input($_GET['id']);
    $sql = "SELECT * FROM reservation WHERE reservation_id='$reservation_id' ORDER BY reservation_id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Reservation not found.";
        exit();
    }
} else {
    echo "Reservation ID not provided.";
    exit();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            padding-top: 50px;
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

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="datetime-local"],
        input[type="number"],
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 16px;
            text-align: left;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="datetime-local"]:focus,
        input[type="number"]:focus {
            border-color: #007bff;
        }

        .form-control {
            border-radius: 3px;
            border-color: #ccc;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-sm {
            font-size: 14px; 
            text-align: center; 
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Reservation</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['reservation_id']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['customer_name']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="datetime">Date & Time:</label>
                <input type="datetime-local" class="form-control" id="datetime" name="datetime" value="<?php echo date('Y-m-d\TH:i', strtotime($row['reservation_date'] . ' ' . $row['reservation_time'])); ?>">
            </div>
            <div class="form-group">
                <label for="num_of_guests">Number of Guests:</label>
                <input type="number" class="form-control" id="num_of_guests" name="num_of_guests" value="<?php echo $row['num_guests']; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-primary btn-sm" style="width: 70px;">Update</button>

            <a href="updatedelete.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        // Open the page in a popup window
        window.onload = function () {
            window.open('', '_self', '').focus();
        };
    </script>
</body>

</html>
