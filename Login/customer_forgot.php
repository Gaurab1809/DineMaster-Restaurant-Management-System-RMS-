<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Forgot Password</h1>
        <form action="customer_forgot_process.php" method="post">
            <input type="email" name="email" placeholder="Email" required><br><br>
            <button type="submit">Reset Password</button>
        </form>
        <p>Remember your password? <a href="customer_login.php">Login here</a></p>
    </div>
</body>
</html>
