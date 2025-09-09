<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navigation Bar -->
    <!-- Include the same navigation bar code as in your other pages -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Restaurant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Forgot Password</h2>
                <form action="customer_forgot_password.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Recover Password</button>
                </form>
            </div>
        </div>
    </div>



    <?php
    // Include the database connection file
    require_once 'db_config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if email is set
        if (isset($_POST['email'])) {
            // Retrieve email from the form
            $email = $_POST['email'];

            // Prepare and execute the SQL query to fetch user data by email
            $sql = "SELECT * FROM customer WHERE customer_email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists
            if ($user) {
                // Generate a unique token for password reset
                $token = bin2hex(random_bytes(32));

                // Store the token in the database along with the user's email
                $sql = "INSERT INTO password_reset_tokens (customer_email, token) VALUES (:email, :token)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['email' => $email, 'token' => $token]);

                // Construct the password reset link with the token
                // $resetLink = "http://yourwebsite.com/reset_password.php?token=$token";
                $resetLink = "http://localhost/RMS/reset_password.php?token=$token";

                // Send password recovery email
                $to = $email;
                $subject = "Password Recovery";
                $message = "Please click the following link to reset your password: $resetLink";
                $headers = "From: syedrifat411@gmail.com"; // Replace with your email address
                mail($to, $subject, $message, $headers);

                // Redirect the user to a confirmation page
                header('Location: password_recovery_confirmation.php');
                exit;
            } else {
                // User with the provided email does not exist
                // Redirect back to the forgot password page with an error message
                header('Location: customer_forgot_password.php?error=1');
                exit;
            }
        }
    }
    ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>