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
    <link rel="stylesheet" href="style.css">
<style>
        /* Style for the "See List" button */
        .btn-see-list {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-left: auto; /* Align the button to the right side */
            display: inline-block;
        }

        /* Style for the container */
        .container {
            width: 80%; /* Adjust the width as needed */
            margin: 0 auto; /* Center the container horizontally */
        }
    </style>
<head>
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
                <li><a href="http://localhost/RMS/Reviews\index.php" class="active"><span class="material-icons">rate_review</span>Reviews</a></li>
                <li><a href="http://localhost/RMS/Booked_Events/display_events.php"><span class="material-icons">event</span>Event Booking</a></li>
                <li><a href="#"><span class="material-icons">help</span>Support</a></li>
                <li><a href="http://localhost/RMS/customerProfile/index.php"><span class="material-icons">account_circle</span>Profile</a></li>
                <li><a href="http://localhost/RMS/customerLogout/index.php"><span class="material-icons">exit_to_app</span>Logout</a></li>
            </ul>
        </div>
    </nav>
    <main>
    <div class="container">
        <h2>Feedback Form</h2>
        <form action="submit_feedback.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Very Good</option>
                <option value="3">3 - Good</option>
                <option value="2">2 - Fair</option>
                <option value="1">1 - Poor</option>
            </select><br><br>
            <label for="comment">Comment:</label><br>
            <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Submit">
            <a href="display_feedback.php" class="btn-see-list">See List</a> <!-- Added See List button within the form -->
        </form>
    </div>
    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>

</html>