<?php
include 'db_connection.php';

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];

// Encrypt the password (for better security, consider using password_hash() function)
$hashed_password = md5($password);

// Insert customer data into the database
$query = "INSERT INTO customer (first_name, last_name, customer_email, customer_phn, customer_address, customer_password) 
          VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', '$hashed_password')";

if(mysqli_query($conn, $query)) {
    // Registration successful, redirect to login page or index page
    echo "Registration successful! Redirecting...";
    header("refresh:2; url=customer_login.php"); // Change 'customer_login.php' to your login page URL
    exit();
} else {
    // Registration failed, show error message
    echo "Error: " . mysqli_error($conn);
}
?>
