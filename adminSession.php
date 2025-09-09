<?php
session_start(); // Start the session

// Function to check if the admin is logged in
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_email']);
}

// Function to redirect if not logged in
function redirectToAdminLogin() {
    header('Location: http://localhost/RMS/index.php');
    exit;
}

// Function to redirect if already logged in
function redirectToAdminDashboard() {
    header('Location: http://localhost/RMS/Dashboard/index.php');
    exit;
}

// Function to log out
function adminLogout() {
    session_destroy();
    redirectToAdminLogin();
}
?>

