<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Customer Registration</h1>
        <form action="customer_registration_process.php" method="post">
            <input type="text" name="first_name" placeholder="First Name" required><br><br>
            <input type="text" name="last_name" placeholder="Last Name" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="text" name="phone" placeholder="Phone" required><br><br>
            <textarea name="address" placeholder="Address" required></textarea><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="customer_login.php">Login here</a></p>
    </div>
</body>
</html>
