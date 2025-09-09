<?php
session_start(); // Start the session


// section for session       start

// Include the session file
require_once 'C:/xampp/htdocs/RMS/session.php';

// Check if the user is already logged in, if yes, redirect to dashboard
if (isLoggedIn()) {
    redirectToDashboard();
}

// Rest of the login page logic
// end



// Include the database connection file
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Retrieve email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the SQL query to fetch user data by email
        $sql = "SELECT * FROM customer WHERE customer_email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password matches
        if ($user && password_verify($password, $user['customer_password'])) {
            // Authentication successful
            // Set session variables to store user data
            $_SESSION['user_id'] = $user['customer_id'];
            $_SESSION['user_email'] = $user['customer_email'];
            // Redirect the user to the dashboard or home page
            header('Location: customerDashboard/index.php');
            exit;
        } else {
            // Authentication failed
            // Redirect back to the login page with an error message
            header('Location: index.php?error=1');
            exit;
        }
    }
}
?>
