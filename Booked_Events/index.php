<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(0, 0, 0, 0.5); 
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }

        form {
            margin-top: 20px;
        }

        label {
            margin-bottom: 5px;
        }

        textarea {
            height: 100px;
        }

        .btn-book-event {
            padding: 10px 20px;
            font-size: 18px;
            margin-bottom: 20px;
            margin-top: 10px;
            width: 30%;
        }

        .button-container {
            text-align: center;
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
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <h2>Event Booking</h2>
            <form action="book_event.php" method="POST" onsubmit="return validateForm()">
                <label for="event" class="form-label">Select Event:</label>
                <select id="event" name="event" class="form-select" required>
                    <option value="" selected disabled>Select an event</option>
                    <?php

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "rms_database";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to fetch events from the database, filtering out expired events
                    $currentDateTime = date('Y-m-d H:i:s');
                    $sql = "SELECT id, name, Startdate, start_time FROM Events WHERE Startdate >= '$currentDateTime'";
                    $result = $conn->query($sql);

                    // Display events as options in the select dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $event_name = $row["name"];
                            $start_date = $row["Startdate"];
                            $start_time = $row["start_time"];
                            echo "<option value='{$row['id']}'>$event_name - $start_date $start_time</option>";
                        }
                    } else {
                        echo "No upcoming events found";
                    }

                    $conn->close();
                    ?>
                </select>
                <label for="contact_name" class="form-label">Contact Name:</label>
                <input type="text" id="contact_name" name="contact_name" class="form-control" required>
                <label for="contact_email" class="form-label">Contact Email:</label>
                <input type="email" id="contact_email" name="contact_email" class="form-control" required>
                <span id="email-error" class="error-message"></span> 
                <label for="contact_phone" class="form-label">Contact Phone:</label>
                <input type="tel" id="contact_phone" name="contact_phone" class="form-control" required>
                <span id="phone-error" class="error-message"></span> 
                <label for="num_guests" class="form-label">Number of Guests:</label>
                <input type="number" id="num_guests" name="num_guests" class="form-control" required>
                <label for="special_requests" class="form-label">Special Requests:</label>
                <textarea id="special_requests" name="special_requests" class="form-control"></textarea>
                <div class="button-container">
                    <button type="submit" class="btn btn-primary btn-book-event">Book Event</button>
                    <button type="button" class="btn btn-cancel" onclick="cancelBooking()">Cancel</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function validateForm() {
            // Validate email
            var email = document.getElementById('contact_email').value;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var emailError = document.getElementById('email-error');
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                return false;
            } else {
                emailError.textContent = ''; // Clear error message
            }

            // Validate phone number
            var phone = document.getElementById('contact_phone').value;
            var phonePattern = /^(01)[0-9]{9}$/; // Must start with '01' and be 11 characters long
            var phoneError = document.getElementById('phone-error');
            if (!phonePattern.test(phone)) {
                phoneError.textContent = 'Please enter a valid phone number starting with "01".';
                return false;
            } else {
                phoneError.textContent = ''; // Clear error message
            }

            return true;
        }

        function cancelBooking() {
            window.location.href = "display_events.php"; // Redirect to display_events.php
        }
    </script>
</body>

</html>
