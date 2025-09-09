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

// Display success message
if(isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']);
}

// Delete event operation
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $event_id = sanitize_input($_GET['id']);

    // Delete event from database
    $sql = "DELETE FROM events WHERE id='$event_id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Event deleted successfully.";
        header("Location: events.php"); // Redirect back to events page
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting event: " . $conn->error . "</div>";
    }
}

// event details for editing
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $event_id = sanitize_input($_GET['id']);

    // event details from database
    $sql = "SELECT * FROM events WHERE id='$event_id' ORDER BY Startdate DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $edit_id = $row["id"];
        $edit_name = $row["NAME"];
        $edit_description = $row["description"];
        $edit_start_date = isset($row["Startdate"]) ? $row["Startdate"] : ""; 
        $edit_end_date = isset($row["Enddate"]) ? $row["Enddate"] : "";
        $edit_start_time = $row["start_time"];
        $edit_end_time = $row["end_time"];
        
        // Redirect to edit page
        header("Location: edit_event.php?id=$edit_id&name=$edit_name&description=$edit_description&start_date=$edit_start_date&end_date=$edit_end_date&start_time=$edit_start_time&end_time=$edit_end_time");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error retrieving event details: Event not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .table-bordered th,
        .table-bordered td {
            border: 2px solid #dee2e6;
        }
        .table thead th {
            background-color: #e9ecef; 
            color: #495057;
            text-align: Center;
        }
        .list-container {
        padding: 20px;
        position: relative;
        width: 80%; 
        margin: 0 auto;
        margin-top: 20px; 
        margin-right: 50px; 
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
        .btn-actions {
            display: flex;
            justify-content: center;
        }
        .btn-actions .btn {
            margin: 0 5px; 
            border: none; 
        }
        .btn-delete {
            margin-left: 5px; 
        }
        .table td {
            white-space: nowrap;
            text-align: center;
        }
        .search-form {
            margin-bottom: 20px; 
            position: absolute; 
            top: 20px;
            right: 20px; 
        }
        .search-form .form-control {
            width: 200px; 
            height: 45px;
        }
    </style>
</head>
<header>
        <h1>Event Management System</h1>
        <p>Welcome, Admin</p>
    </header>
    <nav>
        <div id="nav-wrapper">
            <ul id="nav-list">
                <li><a href="http://localhost/RMS/Dashboard/index.php" class="active"><span class="material-icons">home</span>Dashboard</a></li>
                <li><a href="http://localhost/RMS/Categories/index.php"><span class="material-icons">category</span>Categories</a></li>
                <li><a href="http://localhost/RMS/Products/index.php"><span class="material-icons">local_drink</span>Products</a></li>
                <li><a href="http://localhost/RMS/Tables/index.php"><span class="material-icons">table_chart</span>Tables</a></li>
                <li><a href="http://localhost/RMS/Events/events.php"><span class="material-icons">event</span>Events</a></li>
                <li><a href="http://localhost/RMS/Staff/Info/index.php"><span class="material-icons">group</span>Staff</a></li>
                <li><a href="http://localhost/RMS/POS/index.php"><span class="material-icons">payment</span>POS</a></li>
                <li><a href="http://localhost/RMS/Kitchen/index.php"><span class="material-icons">kitchen</span>Kitchen</a></li>
                <li><a href="http://localhost/RMS/Reports/index.php"><span class="material-icons">bar_chart</span>Reports</a></li>
                <li><a href="http://localhost/RMS/Settings/index.php"><span class="material-icons">settings</span>Settings</a></li>
                <li><a href="http://localhost/RMS/Exit/index.php"><span class="material-icons">exit_to_app</span>Exit</a></li>
            </ul>
        </div>
    </nav>
<body>
    <div class="container mt-5 list-container">
        <h2 class="text-primary mb-4 text-center">Event List</h2>
        <!-- Search form -->
        <form class="search-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by event name" name="query">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- End of search form -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Booked Guests</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $searchQuery = "";
                    if (isset($_GET['query'])) {
                        $searchQuery = sanitize_input($_GET['query']);
                        // search by event name
                        $sql = "SELECT * FROM events WHERE name LIKE '%$searchQuery%' ORDER BY Startdate DESC";
                    } else {
                        $sql = "SELECT * FROM events ORDER BY Startdate DESC";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["NAME"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . $row["Startdate"] . "</td>";
                            echo "<td>" . $row["Enddate"] . "</td>";
                            echo "<td>" . $row["start_time"] . "</td>";
                            echo "<td>" . $row["end_time"] . "</td>";
                            echo "<td>" . $row["booked_guests"] . "</td>";
                            echo "<td class='action-links'>";
                            echo "<a href='edit_event.php?id=" . $row["id"] . "' class='btn btn-primary btn-square'><i class='fas fa-edit'></i></a>";
                            echo "<span class='divider'></span>";
                            echo "<a href='?id=" . $row["id"] . "&action=delete' class='btn btn-danger btn-square btn-delete' onclick='return confirm(\"Are you sure you want to delete this event?\")'><i class='fas fa-trash-alt'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No events found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-primary btn-home"><i class="fas fa-plus fa-lg"></i> Add Event</a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>
</html>
