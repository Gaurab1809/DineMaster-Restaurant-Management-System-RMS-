<?php
// edit_feedback.php

// Start session
session_start();

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

// Get feedback ID from query parameter
$id = $_GET['id'];

// Retrieve feedback data from the database
$sql = "SELECT * FROM feedback WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['NAME'];
    $email = $row['email'];
    $rating = $row['rating'];
    $comment = $row['COMMENT'];
} else {
    $_SESSION['edit_message'] = "Feedback not found!";
    header("Location: display_feedback.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update feedback data in the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $sql = "UPDATE feedback SET name='$name', email='$email', rating='$rating', comment='$comment' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['edit_message'] = "Feedback updated successfully!";
        header("Location: display_feedback.php");
        exit();
    } else {
        $_SESSION['edit_message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: display_feedback.php");
        exit();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Edit Feedback</h2>
        <form method="post" action="edit_feedback.php?id=<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" class="form-control" id="rating" name="rating" value="<?php echo $rating; ?>" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" required><?php echo $comment; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="display_feedback.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
