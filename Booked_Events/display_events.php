<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Events</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
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
            text-align: center;
        }
        .container {
            padding: 20px; 
            position: relative;
            box-sizing: border-box; 
            width: 100%;
            max-width: 1300px;
        }
       
        .btn-actions {
            display: flex;
            justify-content: center;
        }
        .btn-actions .btn {
            margin: 0 10px; 
            border: none; 
        }
        .table td {
            white-space: nowrap;
        }
        td.guests-column {
            text-align: center;
        }
        .search-form {
            margin-bottom: 20px; 
            position: absolute; 
            top: 10px; 
            right: 20px; 
        }
        .search-form .form-control {
            width: 200px; 
            height: 45px;
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
                <li><a href="http://localhost/RMS/Reservations/updatedelete.php"><span class="material-icons">event_seat</span>Reservations</a></li>
                <li><a href="#"><span class="material-icons">local_offer</span>Specials</a></li>
                <li><a href="http://localhost/RMS/Reviews/index.php"><span class="material-icons">rate_review</span>Reviews</a></li>
                <li><a href="http://localhost/RMS/Booked_Events/display_events.php" class="active"><span class="material-icons">event</span>Event Booking</a></li>
                <li><a href="#"><span class="material-icons">help</span>Support</a></li>
                <li><a href="http://localhost/RMS/customerProfile/index.php"><span class="material-icons">account_circle</span>Profile</a></li>
                <li><a href="http://localhost/RMS/customerLogout/index.php"><span class="material-icons">exit_to_app</span>Logout</a></li>
            </ul>
        </div>
    </nav>
    <main>
    <div class="container mt-5 list-container">
        <h2 class="text-primary mb-4 text-center">Booked Events</h2>
        <div class="btn-home-container">
            <a href="index.php" class="btn btn-primary btn-home"><i class="fas fa-plus fa-lg"></i> Book Events </a>
        </div>
        <!-- Search form -->
        <form class="search-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name or email" name="query">
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
                        <th>Booked Event</th>
                        <th>Event Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Contact Name</th>
                        <th>Contact Email</th>
                        <th>Contact Phone</th>
                        <th class="guests-column">Number of Guests</th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Check if a search query is provided
                    $searchQuery = "";
                    if (isset($_GET['query'])) {
                        $searchQuery = $_GET['query'];
                        // for search
                        $sql = "SELECT EventBookings.id, Events.name AS eventName,Events.description, Events.StartDate, Events.EndDate, EventBookings.contact_name, EventBookings.contact_email, EventBookings.contact_phone, EventBookings.num_guests
                                FROM EventBookings
                                INNER JOIN Events ON EventBookings.event_id = Events.id
                                WHERE EventBookings.contact_name LIKE '%$searchQuery%' OR EventBookings.contact_email LIKE '%$searchQuery%'
                                ORDER BY EventBookings.id DESC";
                    } else {
                        // event bookings in descending order
                        $sql = "SELECT EventBookings.id, Events.name AS eventName, Events.description, Events.StartDate, Events.EndDate, EventBookings.contact_name, EventBookings.contact_email, EventBookings.contact_phone, EventBookings.num_guests
                                FROM EventBookings
                                INNER JOIN Events ON EventBookings.event_id = Events.id
                                ORDER BY EventBookings.id DESC"; 
                    }

                    $result = $conn->query($sql);

                    // Check if the query was successful
                    if ($result === false) {
                        echo "Query failed: " . $conn->error;
                    } else {
                        // Check if there are rows returned
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["eventName"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";
                                echo "<td>" . $row["StartDate"] . "</td>";
                                echo "<td>" . $row["EndDate"] . "</td>";
                                echo "<td>" . $row["contact_name"] . "</td>";
                                echo "<td>" . $row["contact_email"] . "</td>";
                                echo "<td>" . $row["contact_phone"] . "</td>";
                                echo "<td class='guests-column'>" . $row["num_guests"] . "</td>";
                                echo "<td class='btn-actions'>
                                        <div class='btn-group'>
                                            <a href='edit_event.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a>
                                            <a href='delete_event.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirmDelete()'><i class='fas fa-trash'></i></a>
                                        </div>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No event bookings found</td></tr>";
                        }
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this event booking?");
        }
    </script>
    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>
</html>
