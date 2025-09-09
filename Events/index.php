<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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

        .event-form {
            margin-top: 20px;
        }

        label {
            margin-bottom: 5px;
        }

        textarea {
            height: 100px;
        }
        .btn-create-event {
            padding: 10px 20px; 
            font-size: 16px;
            background-color: #007bff; 
            margin-bottom: 20px; 
            margin-top: 10px; 
            width: 30%;
            transition: background-color 0.3s; 
            color: #fff; 
            font-weight: bold;
        }
        .btn-create-event:hover {
            background-color: #0056b3; 
            color: #fff; 
        }
        .btn-cancel {
            padding: 10px 10px;
            font-size: 16px;
            background-color: #dc3545; 
            display: block;
            margin: 10px auto;
            float: right; 
            transition: background-color 0.3s; 
            color: #fff; 
        }
        .btn-cancel:hover {
            background-color: #c82333; 
            color: #fff; 
        }
    </style>
</head>

<body>
    <main>
    <div class="container">
        <h2>Event Management System</h2>
        <form action="process_event.php" method="post" class="event-form">
            <div class="form-group">
                <label for="name" class="form-label">Event Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col">
                    <label for="start_time" class="form-label">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
                <div class="col">
                    <label for="end_time" class="form-label">End Time:</label>
                    <input type="time" id="end_time" name="end_time" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-create-event">Create Event</button>
            <button type="button" onclick="location.href='events.php';" class="btn btn-cancel">Cancel</button>
        </form>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
