<?php
session_start();
include 'db_connection.php';

$email = $_POST['email'];

// Check if email exists in the database
$query = "SELECT * FROM customer WHERE customer_email='$email'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1) {
    // Email exists, generate a random password
    $new_password = generateRandomString(8);

    // Encrypt the new password (for better security, consider using password_hash() function)
    $hashed_password = md5($new_password);

    // Update the password in the database
    $update_query = "UPDATE customer SET customer_password='$hashed_password' WHERE customer_email='$email'";
    if(mysqli_query($conn, $update_query)) {
        // Send the new password to the user's email (you may implement this part)
        echo "Your password has been reset. Check your email for the new password.";
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
} else {
    echo "Email not found.";
}

// Function to generate a random string
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
