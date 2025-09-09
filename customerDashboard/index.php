<?php
// section for session       start
require_once 'C:/xampp/htdocs/RMS/session.php';
// Check if the user is not logged in, if not, redirect to login
if (!isLoggedIn()) {
    redirectToLogin();
}
// end
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System - Customer</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Restaurant Management System</h1>
        <p>Welcome, Guest</p>
    </header>
    <nav>
        <div id="nav-wrapper">
            <ul id="nav-list">
                <li><a href="http://localhost/RMS/customerDashboard/index.php" class="active"><span class="material-icons">restaurant_menu</span>Menu</a></li>
                <li><a href="http://localhost/RMS/Reservations/updatedelete.php"><span class="material-icons">event_seat</span>Reservations</a></li>
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
        <!-- Content for the main section goes here -->
        <h2>Welcome to our Restaurant!</h2>
        <p>Explore our delicious menu and make reservations for an unforgettable dining experience.</p>
    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>

</html>