

<?php

// Include the session file for handling authentication
require_once 'C:/xampp/htdocs/RMS/session.php';

// Include the database connection file
require_once 'C:/xampp/htdocs/RMS/db_config.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    // Redirect to the login page if not logged in
    redirectToLogin();
}

// Retrieve the user's information from the database
$userID = $_SESSION['user_id'];
$sql = "SELECT * FROM customer WHERE customer_id = :userID";
$stmt = $pdo->prepare($sql);
$stmt->execute(['userID' => $userID]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle profile picture upload
    // Assuming you have a file input field named 'profile_picture' in your HTML form
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Directory where profile pictures will be stored
        $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
            // Update the profile picture path in the database
            $profilePicture = $uploadFile;
            $sql = "UPDATE customer SET photo = :photo WHERE customer_id = :userID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['photo' => $profilePicture, 'userID' => $userID]);
        }
    }

    // Handle other profile fields
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone'], $_POST['address'])) {
        // Sanitize and validate input data
        $firstName = htmlspecialchars(trim($_POST['first_name']));
        $lastName = htmlspecialchars(trim($_POST['last_name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $address = htmlspecialchars(trim($_POST['address']));

        // Update the customer's information in the database
        $sql = "UPDATE customer SET first_name = :firstName, last_name = :lastName, customer_email = :email, customer_phn = :phone, customer_address = :address WHERE customer_id = :userID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phone' => $phone, 'address' => $address, 'userID' => $userID]);
    }

    // Redirect to the profile page after updating
    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Restaurant Management System</h1>
        <p>Welcome, Guest</p>
    </header>

    <nav>
        <div id="nav-wrapper">
            <ul id="nav-list">
                <li><a href="http://localhost/RMS/customerDashboard/index.php"><span class="material-icons">restaurant_menu</span>Menu</a></li>
                <li><a href="#"><span class="material-icons">event_seat</span>Reservations</a></li>
                <li><a href="#"><span class="material-icons">local_offer</span>Specials</a></li>
                <li><a href="#"><span class="material-icons">rate_review</span>Reviews</a></li>
                <li><a href="#"><span class="material-icons">loyalty</span>Loyalty</a></li>
                <li><a href="#"><span class="material-icons">help</span>Support</a></li>
                <li><a href="http://localhost/RMS/customerProfile/index.php" class="active"><span class="material-icons">account_circle</span>Profile</a></li>
                <li><a href="http://localhost/RMS/customerLogout/index.php"><span class="material-icons">exit_to_app</span>Logout</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2>Edit Profile</h2>
                    <form action="profile.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $customer['first_name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $customer['last_name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $customer['customer_email'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $customer['customer_phn'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" required><?= $customer['customer_address'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>