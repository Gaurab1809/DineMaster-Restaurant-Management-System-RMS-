<?php
// display_feedback.php

// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Display</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom styles */
        body {
            background-color: #f4f4f4;
            padding-top: 20px; /* Add top padding */
            padding-bottom: 20px; /* Add bottom padding */
        }
        .table-bordered th,
        .table-bordered td {
            border: 2px solid #dee2e6; /* Increased border thickness */
        }
        .table thead th {
            background-color: #e9ecef; /* Slightly darker gray for the column name row */
            color: #495057;
        }
        .btn-back,
        .btn-home {
            position: absolute; /* Position the buttons */
            top: 20px; /* Adjust top position */
            background-color: #007bff; /* Button color */
            color: #fff; /* Text color */
            padding: 10px; /* Padding */
            width: 40px; /* Set width */
            height: 40px; /* Set height */
            border-radius: 5px; /* Make it round */
            text-decoration: none; /* Remove underlines */
            transition: background-color 0.3s; /* Smooth color transition */
            display: flex; /* Enable flex layout */
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            font-weight: bold; /* Make the text bold */
        }
        .btn-back i,
        .btn-home i {
            font-size: 20px; /* Icon size */
        }
        .btn-back {
            left: 20px; /* Adjust left position for back button */
        }
        .btn-home {
            left: 80px; /* Adjust left position for home button */
        }
        .btn-back:hover,
        .btn-home:hover {
            background-color: #0069d9; /* Lighter shade of blue on hover */
        }
        .btn-actions {
            display: flex;
            justify-content: center;
        }
        .btn-actions .btn {
            margin: 0 5px; /* Add space between buttons */
            border: none; /* Remove button borders */
        }
        /* Ensure all names appear on a single line */
        .table td {
            white-space: nowrap;
        }
        /* Center align the rating column */
        .rating-column {
            text-align: center;
        }
        .search-form {
            margin-bottom: 20px; /* Add some space below the search form */
            margin-right: 20px; /* Add right margin */
            margin-left: 20px; /* Add left margin */
            display: flex; /* Use flexbox */
            align-items: center; /* Align items vertically */
        }
        /* Adjust the width and height of the search input */
        .search-form .form-control {
            width: 150px; /* Adjust the width as needed */
            height: 45px; /* Adjust the height as needed */
            flex: 1; /* Allow the input to grow */
        }
        /* Adjust the width of the search button */
        .search-form .input-group-append .btn {
            width: 50px; /* Adjust the width as needed */
            height: 45px; /* Adjust the height as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-primary mb-4 text-center">Feedback Display</h2>

        <?php
        // Display success message for edit operation
        if (isset($_SESSION['edit_message'])) {
            echo '<div class="alert alert-success" role="alert">';
            echo $_SESSION['edit_message'];
            echo '</div>';
            unset($_SESSION['edit_message']); // Clear the session variable
        }

        // Display success message for delete operation
        if (isset($_SESSION['delete_message'])) {
            echo '<div class="alert alert-success" role="alert">';
            echo $_SESSION['delete_message'];
            echo '</div>';
            unset($_SESSION['delete_message']); // Clear the session variable
        }
        ?>
        <!-- Search form -->
        <form class="search-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <input type="text" class="form-control" placeholder="Search" name="query" value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- End of search form -->
    </div>
    
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Timestamp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $servername = "localhost";
                    $username = "root"; // Change to your MySQL username
                    $password = ""; // Change to your MySQL password
                    $dbname = "rms_database"; // Change to your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Select data from database
                    $sql = "SELECT * FROM feedback";
                    
                    // Filter by search query if provided
                    if (isset($_GET['query']) && !empty($_GET['query'])) {
                        $query = $_GET['query'];
                        $sql .= " WHERE NAME LIKE '%$query%' OR email LIKE '%$query%'";
                    }

                    $sql .= " ORDER BY created_at DESC"; // Modified query to order by timestamp in descending order
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["NAME"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["rating"] . "</td>";
                            echo "<td>" . $row["COMMENT"] . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "<a href='edit_feedback.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                            echo "<a href='delete_feedback.php?id=" . $row["id"] . "' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 results</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back and Home buttons -->
    <a href="javascript:history.back()" class="btn btn-primary btn-back"><i class="fas fa-arrow-left fa-lg"></i></a> <!-- Back button with back arrow icon -->
    <a href="index.php" class="btn btn-primary btn-home"><i class="fas fa-home fa-lg"></i></a> <!-- Home button with home icon -->
</body>
</html>
