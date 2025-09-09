<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $availableStatus = $_POST['availableStatus'];
    $productDescription = $_POST['productDescription'];

    // File upload handling
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["productPicture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["productPicture"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["productPicture"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["productPicture"]["tmp_name"], $targetFile)) {
            // Insert product into database
            $sql = "INSERT INTO products (category_id, product_name, product_picture, product_price, available_status, product_description) 
                    VALUES ('$category', '$productName', '$targetFile', '$productPrice', '$availableStatus', '$productDescription')";

            if ($conn->query($sql) === TRUE) {
                echo "Product added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
