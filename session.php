<?php
session_start(); // Start the session

// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_email']);
}

// Function to redirect if not logged in
function redirectToLogin() {
    header('Location: http://localhost/RMS/index.php');
    exit;
}

// Function to redirect if already logged in
function redirectToDashboard() {
    header('Location: http://localhost/RMS/customerDashboard/index.php');
    exit;
}

// Function to log out
function logout() {
    session_destroy();
    redirectToLogin();
}
?>
