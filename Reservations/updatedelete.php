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

// current date and time
$current_date = date("Y-m-d");
$current_time = date("H:i:s");

// Display success message
if(isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']);
}

// sanitize input data
function sanitize_input($data) {
    global $conn;
    return htmlspecialchars(strip_tags($conn->real_escape_string($data)));
}

// Insert reservation
if (isset($_GET['submit'])) { // Change to $_GET since form uses GET method
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

// delete operation
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $reservation_id = sanitize_input($_GET['id']);

    // Delete reservation from database
    $sql = "DELETE FROM reservation WHERE reservation_id='$reservation_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Reservation deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting reservation: " . $conn->error . "</div>";
    }
}

// Handle search operation
if(isset($_GET['search'])) {
    $searchTerm = sanitize_input($_GET['search']);

    // search for reservations by name or email
    $sql = "SELECT * FROM reservation WHERE customer_name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
} else {
    // Display all reservations
    $sql = "SELECT * FROM reservation ORDER BY reservation_date DESC, reservation_time DESC";
    $result = $conn->query($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0; 
            padding: 0;
        }
        .container {
            padding: 20px;
            position: relative; 
            box-sizing: border-box; 
            width: 100%;
            max-width: 1200px;
        }
        .search-container {
            position: absolute;
            top: 20px; 
            right: 20px; 
            display: flex; 
        }
        .search-container .form-control {
            width: 200px; 
            height: 45px; 
            margin-right: 5px;
        }
        .search-container button[type="submit"] {
            height: 45px; 
        }
        .table-container {
            margin-top: 20px; 
            overflow-x: auto; 
        }
        .table {
            margin-top: 20px; 
            width: 100%; 
        }
        .table-bordered th,
        .table-bordered td {
            border: 2px solid #dee2e6;
        }
        .table thead th {
            background-color: #e9ecef;
            color: #495057;
        }
        .list-container {
            padding: 10px;
            position: relative; 
        }
        .btn-home {
            padding: 15px 30px; 
            border-radius: 8px; 
            font-size: 18px;
            font-weight: bold; 
            transition: background-color 0.3s, color 0.3s; 
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .btn-home:hover {
            background-color: #0056b3;
            color: #fff; 
        }

        td.num-guests {
            text-align: center;
        }
        .table td {
            white-space: nowrap;
        }
        .search-form .form-control {
            width: 200px; 
            height: 45px; 
        }
        .search-form {
            position: absolute;
            top: 45px;
            right: 20px;
        }
        .status-active {
            background-color: #28a745; 
            color: white; 
            text-align: center;
        }
        .status-expired {
            background-color: #dc3545;
            color: white; 
            text-align: center;
        }

    </style>
</head>
<body>
<header>
    <h1>Restaurant Management System</h1>
    <p>Welcome, Guest</p>
</header>
<nav>
    <div id="nav-wrapper">
        <ul id="nav-list">
            <li><a href="http://localhost/RMS/customerDashboard/index.php"><span class="material-icons">restaurant_menu</span>Menu</a></li>
            <li><a href="http://localhost/RMS/Reservations/updatedelete.php" class="active"><span class="material-icons">event_seat</span>Reservations</a></li>
            <li><a href="#"><span class="material-icons">local_offer</span>Specials</a></li>
            <li><a href="http://localhost/RMS/Reviews/index.php"><span class="material-icons">rate_review</span>Reviews</a></li>
            <li><a href="http://localhost/RMS/Booked_Events/display_events.php"><span class="material-icons">event</span>Event Booking</a></li>
            <li><a href="#"><span class="material-icons">help</span>Support</a></li>
            <li><a href="http://localhost/RMS/customerProfile/index.php"><span class="material-icons">account_circle</span>Profile</a></li>
            <li><a href="http://localhost/RMS/customerLogout/index.php"><span class="material-icons">exit_to_app</span>Logout</a></li>
        </ul>
    </div>
</nav>
<main>
    <div class="container">
        <h2 class="text-primary mb-4 text-center">Reservation Management System</h2>
        <div class="btn-home-container">
            <a href="index.php" class="btn btn-primary btn-home"><i class="fas fa-plus fa-lg"></i> Add Reservation</a>
        </div>
        <!-- Search form -->
        <form class="search-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name or email" name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- End of search form -->
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date & Time</th>
                        <th>Number of Guests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // reservation status
                            $reservation_datetime = $row["reservation_date"] . " " . $row["reservation_time"];
                            $status = ($current_date > $row["reservation_date"] || ($current_date == $row["reservation_date"] && $current_time > $row["reservation_time"])) ? "Expired" : "Active";

                            $status_class = ($status === "Expired") ? "status-expired" : "status-active";

                            // Check if the reservation is for today or future
                            $highlight_class = ($current_date == $row["reservation_date"]) ? "highlight-day" : "";

                            echo "<tr class='$highlight_class'>";
                            echo "<td>" . $row["customer_name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["reservation_date"] . " " . $row["reservation_time"] . "</td>";
                            echo "<td class='num-guests'>" . $row["num_guests"] . "</td>"; 
                            echo "<td class='$status_class'>" . $status . "</td>"; 
                            echo "<td class='action-links'>
                                    <a href='edit.php?id=" . $row["reservation_id"] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>
                                    <a href='?id=" . $row["reservation_id"] . "&action=delete' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this reservation?\")'><i class='fas fa-trash-alt'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No reservations found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<footer>
    <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
</footer>
</body>
</html>
