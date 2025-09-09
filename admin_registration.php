<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Admin Registration</h2>
        <?php
        // Display error message if password mismatch or missing fields error occurred
        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'password_mismatch') {
                echo '<div class="alert alert-danger" role="alert">Passwords do not match. Please try again.</div>';
            } elseif ($_GET['error'] === 'missing_fields') {
                echo '<div class="alert alert-danger" role="alert">Please fill in all the required fields.</div>';
            }
        }
        ?>
        <form action="save_admin.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
