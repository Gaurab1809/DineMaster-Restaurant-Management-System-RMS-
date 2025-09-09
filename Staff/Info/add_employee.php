<?php
include 'db_connection.php';

$role = $_POST['role'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$emergencyContact = $_POST['emergencyContact'];
$salary = $_POST['salary'];
$hiredDate = $_POST['hiredDate'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

// File upload handling
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
// Check if image file is an actual image or fake image
$check = getimagesize($_FILES["picture"]["tmp_name"]);
if ($check === false) {
    echo "File is not an image.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["picture"]["size"] > 5000000) { // 5MB limit
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
$allowedTypes = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedTypes)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
        // Insert employee into database
        $sql = "INSERT INTO employees (role_id, first_name, last_name, email, phone, address, emergency_contact, photo, salary, hired_date, password) 
                VALUES ('$role', '$firstName', '$lastName', '$email', '$phone', '$address', '$emergencyContact', '$targetFile', '$salary', '$hiredDate', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Employee added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
