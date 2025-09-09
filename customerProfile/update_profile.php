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
    if (isset($_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['address'])) {
        // Retrieve form data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Handle profile photo upload
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Define directory for storing uploaded photos
            $uploadDir = 'uploads/';

            // Generate a unique filename for the uploaded photo
            $photoName = uniqid('photo_') . '_' . basename($_FILES['photo']['name']);
            
            // Path to store the uploaded photo
            $targetFilePath = $uploadDir . $photoName;

            // Move the uploaded photo to the designated directory
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                // Photo uploaded successfully, update the database with the photo path
                $photoPath = $targetFilePath;
            } else {
                // Failed to move uploaded photo, set error message
                $_SESSION['error'] = "Failed to upload photo.";
                header("Location: http://localhost/RMS/customerProfile/index.php");
                exit;
            }
        }

        // Update user profile in the database
        $updateSql = "UPDATE customer SET first_name = :firstName, last_name = :lastName, customer_phn = :phone, customer_address = :address";
        // Include photo path in the SQL query if a new photo was uploaded
        if (isset($photoPath)) {
            $updateSql .= ", photo = :photoPath";
        }
        $updateSql .= " WHERE customer_id = :userID";
        
        $updateStmt = $pdo->prepare($updateSql);
        $params = ['firstName' => $firstName, 'lastName' => $lastName, 'phone' => $phone, 'address' => $address, 'userID' => $userID];
        // Include photo path in the parameters array if a new photo was uploaded
        if (isset($photoPath)) {
            $params['photoPath'] = $photoPath;
        }
        $updateStmt->execute($params);

        // Profile updated successfully, set success message
        $_SESSION['success'] = "Profile updated successfully.";
        // Redirect back to the edit_profile.php page
        header("Location: http://localhost/RMS/customerProfile/index.php");
        exit;
    } else {
        // Required fields not filled, set error message
        $_SESSION['error'] = "Please fill all the required fields.";
        header("Location: http://localhost/RMS/customerProfile/index.php");
        exit;
    }
} else {
    // Redirect to the edit profile page if accessed directly without submitting the form
    $_SESSION['error'] = "Invalid request.";
    header("Location: http://localhost/RMS/customerProfile/index.php");
    exit;
}
?>
