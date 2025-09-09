<?php
// Include the admin session file
require_once 'adminSession.php';

// Check if the admin is already logged in, if yes, redirect to admin dashboard
if (isAdminLoggedIn()) {
    redirectToAdminDashboard();
}

// Include the database connection file
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Retrieve email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the SQL query to fetch admin data by email
        $sql = "SELECT * FROM admin WHERE admin_email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if admin exists and password matches
        if ($admin && $password === $admin['admin_password']) {
            // Authentication successful
            // Set session variables to store admin data
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_email'] = $admin['admin_email'];
            // Redirect the admin to the admin dashboard
            header('Location: Dashboard/index.php');
            exit;
        } else {
            // Authentication failed
            // Redirect back to the admin login page with an error message
            header('Location: index.php?error=1');
            exit;
        }
    }
}
?>
