<?php
// Include the session file for handling authentication
require_once 'C:/xampp/htdocs/RMS/session.php';

// Include the database connection file
require_once 'C:/xampp/htdocs/RMS/db_config.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    // Redirect to the login page if not logged in
    $_SESSION['error'] = "You must be logged in to perform this action.";
    header("Location: http://localhost/RMS/index.php");
    exit;
}

// Retrieve user ID from session
$userID = $_SESSION['user_id'];

// Validate form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'])) {
        // Retrieve current password from the form
        $currentPassword = $_POST['currentPassword'];

        // Retrieve new password and its confirmation from the form
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        // Check if new password matches its confirmation
        if ($newPassword !== $confirmNewPassword) {
            // Passwords don't match, set error message
            $_SESSION['error'] = "New password and confirm new password do not match.";
            header("Location: change_password.php");
            exit;
        }

        // Retrieve the current hashed password from the database
        $sql = "SELECT customer_password FROM customer WHERE customer_id = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['userID' => $userID]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify current password
        if (password_verify($currentPassword, $userData['customer_password'])) {
            // Hash the new password before updating it in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password in the database
            $updateSql = "UPDATE customer SET customer_password = :password WHERE customer_id = :userID";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute(['password' => $hashedPassword, 'userID' => $userID]);

            // Password updated successfully, set success message
            $_SESSION['success'] = "Password updated successfully.";
            header("Location: change_password.php");
            exit;
        } else {
            // Current password is incorrect, set error message
            $_SESSION['error'] = "Current password is incorrect.";
            header("Location: change_password.php");
            exit;
        }
    } else {
        // Required fields not filled, set error message
        $_SESSION['error'] = "Please fill all the required fields.";
        header("Location: change_password.php");
        exit;
    }
} else {
    // Redirect to the change password page if accessed directly without submitting the form
    $_SESSION['error'] = "Invalid request.";
    header("Location: change_password.php");
    exit;
}
?>
