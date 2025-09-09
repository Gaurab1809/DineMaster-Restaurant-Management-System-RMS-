<?php
// Start the session
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

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
                <li><a href="http://localhost/RMS/Reservations/updatedelete.php"><span class="material-icons">event_seat</span>Reservations</a></li>
                <li><a href="#"><span class="material-icons">local_offer</span>Specials</a></li>
                <li><a href="http://localhost/RMS/Reviews/index.php"><span class="material-icons">rate_review</span>Reviews</a></li>
                <li><a href="http://localhost/RMS/Booked_Events/display_events.php"><span class="material-icons">event</span>Event Booking</a></li>
                <li><a href="#"><span class="material-icons">help</span>Support</a></li>
                <li><a href="http://localhost/RMS/customerProfile/index.php" class="active"><span class="material-icons">account_circle</span>Profile</a></li>
                <li><a href="http://localhost/RMS/customerLogout/index.php"><span class="material-icons">exit_to_app</span>Logout</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="container">
            <h1>User Profile</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-photo">
                        <?php if (!empty($customer['photo'])) : ?>
                            <img src="<?php echo $customer['photo']; ?>" alt="Profile Photo" class="img-fluid">
                        <?php else : ?>
                            <i class="bi bi-person-circle" style="font-size: 10rem;"></i> <!-- Default icon -->
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile-info">
                        <p><strong>First Name:</strong> <?php echo $customer['first_name']; ?></p>
                        <p><strong>Last Name:</strong> <?php echo $customer['last_name']; ?></p>
                        <p><strong>Email:</strong> <?php echo $customer['customer_email']; ?></p>
                        <p><strong>Phone:</strong> <?php echo $customer['customer_phn']; ?></p>
                        <p><strong>Address:</strong> <?php echo $customer['customer_address']; ?></p>
                        <!-- Add more profile fields as needed -->
                    </div>
                </div>
            </div>
            <div class="profile-actions mt-3">
                <a href="#" id="changePasswordBtn" class="btn btn-primary">Change Password</a>
                <a href="#" id="editProfileBtn" class="btn btn-secondary">Edit Profile</a>
            </div>
        </div>

        <!-- Change Password Form -->
        <form action="update_password.php" method="POST" id="changePasswordForm" style="display: none;">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
            <div class="mb-3">
                <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>


        <!-- Edit Profile Form -->
        <form action="update_profile.php" method="POST" id="editProfileForm" enctype="multipart/form-data" style="display: none;">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $customer['first_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $customer['last_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer['customer_email']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $customer['customer_phn']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" required><?php echo $customer['customer_address']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Profile Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>

        <div id="successMessageContainer" style="display: none;"></div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Change Password Button
                document.getElementById('changePasswordBtn').addEventListener('click', function(e) {
                    e.preventDefault();
                    showForm('changePasswordForm');
                });

                // Edit Profile Button
                document.getElementById('editProfileBtn').addEventListener('click', function(e) {
                    e.preventDefault();
                    showForm('editProfileForm');
                });

                // Submit Change Password Form
                document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    fetch('update_password.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            // Handle response
                        })
                        .catch(error => {
                            // Handle error
                        });
                });

                // Submit Edit Profile Form
                document.getElementById('editProfileForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    fetch('update_profile.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            // Handle response
                        })
                        .catch(error => {
                            // Handle error
                        });
                });
            });

            function showForm(formId) {
                // Hide all forms
                document.querySelectorAll('form').forEach(function(form) {
                    form.style.display = 'none';
                });

                // Show the selected form
                document.getElementById(formId).style.display = 'block';
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Check if success message exists in session
                var successMessage = "<?php echo isset($_SESSION['success']) ? $_SESSION['success'] : '' ?>";

                // Check if success message is not empty
                if (successMessage.trim() !== "") {
                    // Hide the edit profile form
                    document.getElementById('editProfileForm').style.display = 'none';

                    // Show the success message container and set its content
                    var successMessageContainer = document.getElementById('successMessageContainer');
                    successMessageContainer.textContent = successMessage;
                    successMessageContainer.style.display = 'block';

                    // Remove the success message from the session
                    <?php unset($_SESSION['success']); ?>;
                }
            });
        </script>

    </main>

    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>