<?php
// Include the session file
require_once 'session.php';

// Check if the user is already logged in, if yes, redirect to dashboard
if (isLoggedIn()) {
    redirectToDashboard();
}

// Rest of the login page logic
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Restaurant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Welcome to our Restaurant</h2>
                <p class="lead">Please select your login mode:</p>
                <div class="mb-3">
                    <label class="form-label">Login As:</label>
                    <select class="form-select" id="loginMode" onchange="changeLoginForm()">
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
                <form action="customer_login.php" method="POST" id="customerLoginForm">
                    <!-- Customer Login Form -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login as Customer</button>

                    <p class="mt-3">Don't have an account? <a href="customer_register.php">Register here</a></p>
                    <p class="mt-3">Forgot your password? <a href="customer_forgot_password.php">Recover it here</a></p>
                </form>

                <!-- Admin and Employee Login Forms -->
                <!-- Admin Login Form -->
                <form action="admin_login.php" method="POST" class="d-none" id="adminLoginForm">
                    <!-- <p class="lead">Admin Login:</p> -->
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="adminEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="adminPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login as Admin</button>
                    <p class="mt-3">Forgot your password? <a href="admin_forgot_password.php">Recover it here</a></p>
                </form>
                
                <form action="employee_login.php" method="POST" class="d-none" id="employeeLoginForm">
                    <!-- <p class="lead">Employee Login:</p> -->
                    <div class="mb-3">
                        <label for="employeeEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="employeeEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="employeePassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="employeePassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login as Employee</button>
                    <p class="mt-3">Forgot your password? <a href="employee_forgot_password.php">Recover it here</a></p>
                </form>


            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function changeLoginForm() {
            var loginMode = document.getElementById("loginMode").value;
            if (loginMode === "customer") {
                document.getElementById("customerLoginForm").classList.remove("d-none");
                document.getElementById("adminLoginForm").classList.add("d-none");
                document.getElementById("employeeLoginForm").classList.add("d-none");
            } else if (loginMode === "admin") {
                document.getElementById("customerLoginForm").classList.add("d-none");
                document.getElementById("adminLoginForm").classList.remove("d-none");
                document.getElementById("employeeLoginForm").classList.add("d-none");
            } else if (loginMode === "employee") {
                document.getElementById("customerLoginForm").classList.add("d-none");
                document.getElementById("adminLoginForm").classList.add("d-none");
                document.getElementById("employeeLoginForm").classList.remove("d-none");
            }
        }
    </script>

</body>

</html>