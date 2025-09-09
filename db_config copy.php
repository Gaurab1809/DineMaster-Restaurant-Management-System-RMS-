<?php
// Database configuration
$dbHost = 'localhost'; // MySQL server hostname
$dbUsername = 'root'; // MySQL username
$dbPassword = ''; // MySQL password
$dbName = 'RMS_database'; // MySQL database name

// Attempt to connect to the database
try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUsername, $dbPassword);

    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Display error message and terminate script execution if unable to connect to the database
    die("Database connection failed: " . $e->getMessage());
}
?>
