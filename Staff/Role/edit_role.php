<?php
// Include database connection
require_once 'db_connection.php';

// Check if role ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $role_id = $_GET['id'];
    
    // Fetch role details from the database
    $sql = "SELECT * FROM roles WHERE role_id = $role_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $role = $result->fetch_assoc();
    } else {
        echo "Role not found.";
        exit();
    }
} else {
    echo "Role ID not provided.";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL Injection
    $roleName = mysqli_real_escape_string($conn, $_POST['roleName']);

    // Update role in the database
    $sql = "UPDATE roles SET role_name = '$roleName' WHERE role_id = $role_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Role</h2>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="roleName">Role Name</label>
                <input type="text" class="form-control" id="roleName" name="roleName" value="<?php echo $role['role_name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
