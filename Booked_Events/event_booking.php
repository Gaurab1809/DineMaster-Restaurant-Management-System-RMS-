<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
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
            padding: 10px 30px; 
            font-size: 18px;
            margin-bottom: 20px; 
            margin-top: 10px; 
            width: 100%;
        }
        .btn-see-list {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            display: block;
            margin: 0 auto; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Event Booking</h2>
        <form action="book_event.php" method="POST">
            <label for="event" class="form-label">Select Event:</label>
            <select id="event" name="event" class="form-select" required>
                <option value="" selected disabled>Select an event</option>

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

                // events from the database
                $sql = "SELECT id, name, Startdate, start_time FROM Events";
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
                    echo "No events found";
                }
                $conn->close();
                ?>
            </select>
            <label for="contact_name" class="form-label">Contact Name:</label>
            <input type="text" id="contact_name" name="contact_name" class="form-control" required>
            <label for="contact_email" class="form-label">Contact Email:</label>
            <input type="email" id="contact_email" name="contact_email" class="form-control" required>
            <label for="contact_phone" class="form-label">Contact Phone:</label>
            <input type="tel" id="contact_phone" name="contact_phone" class="form-control" required>
            <label for="num_guests" class="form-label">Number of Guests:</label>
            <input type="number" id="num_guests" name="num_guests" class="form-control" required>
            <label for="special_requests" class="form-label">Special Requests:</label>
            <textarea id="special_requests" name="special_requests" class="form-control"></textarea>
            <button type="submit" class="btn btn-primary btn-book-event">Book Event</button>
            <a class="btn btn-success btn-see-list" href="display_events.php">See List</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
