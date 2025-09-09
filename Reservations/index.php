<?php
// section for session start
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
    <title>Restaurant Reservation System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: rgba(0, 0, 0, 0.5); 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 0;
        }
        .container {
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            max-width: 500px;
            padding: 20px; 
            background-color: #fff; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


        input[type="text"],
        input[type="email"],
        input[type="datetime-local"],
        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 22px); 
            padding: 10px; 
            margin: 5px 0; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            box-sizing: border-box; 
            font-size: 16px;
        }
        input[type="submit"] {
            font-weight: bold; 
            background-color: #4CAF50;
            color: #fff; 
            border: none; 
            cursor: pointer; 
        }
        input[type="submit"]:hover {
            background-color: #45a049; 
        }
        input[type="number"]:focus {
            border: 2px solid #4CAF50; 
            outline: none; 
        }
        .see-list-button {
            background-color: #008CBA;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px; 
            border-radius: 3px;
            padding: 10px 20px; 
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .see-list-button:hover {
            background-color: #005f79; 
        }

        #search_button {
            padding: 8px 12px; 
            font-size: 14px; 
        }

        .reservation-form {
            margin-top: 20px;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Restaurant Management System</h2>
        <form class="reservation-form" id="reservation_form" action="updatedelete.php" method="get">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid email address" required>
            <input type="datetime-local" name="datetime" required>
            <input type="number" name="guests" placeholder="Number of Guests" required>
            <input type="submit" name="submit" value="Reserve">
        </form>
        <button type="button" class="btn btn-cancel" onclick="cancelReservation()">Cancel</button>
    </div>
    <script>
        function cancelReservation() {
            window.location.href = "updatedelete.php"; // Redirect to updatedelete.php
        }
    </script>
</body>

</html>
