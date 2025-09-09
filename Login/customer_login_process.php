<?php
session_start();
include 'db_connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Encrypt the password
$hashed_password = md5($password);

// Retrieve customer data from the database based on email
$query = "SELECT * FROM customer WHERE customer_email='$email'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    
    // Verify if the entered password matches the one stored in the database
    if($row['customer_password'] == $hashed_password) {
        // Password is correct, set session variables and redirect to dashboard
        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['customer_name'] = $row['first_name']; // Change this to the appropriate column name in your database
        header("Location: customer_dashboard.php");
        exit();
    } else {
        // Password is incorrect, show error message
        $_SESSION['login_error'] = "Incorrect password";
        header("Location: customer_login.php");
        exit();
    }
} else {
    // Email does not exist in the database, show error message
    $_SESSION['login_error'] = "Email not found";
    header("Location: customer_login.php");
    exit();
}
?>
