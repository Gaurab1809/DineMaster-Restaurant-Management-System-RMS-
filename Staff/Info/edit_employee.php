<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>

    <div class="container mt-5">
        <h2>Edit Employee</h2>
        <?php
        include 'db_connection.php';

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $employee_id = $_POST['employee_id'];
            $first_name = $_POST['firstName'];
            $last_name = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $emergency_contact = $_POST['emergencyContact'];
            $salary = $_POST['salary'];
            $hired_date = $_POST['hiredDate'];
            $role_id = $_POST['role']; // Get the selected role ID

            // Check if a new photo file is uploaded
            if ($_FILES['photo']['size'] > 0) {
                $target_dir = "uploads/"; // Directory where the file will be stored
                $target_file = $target_dir . basename($_FILES["photo"]["name"]); // Full path of the file
                $uploadOk = 1; // Flag to check if the file was uploaded successfully
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // File extension

                // Check if the file is an actual image
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists, if yes, remove the old photo file
                if (file_exists($target_file)) {
                    unlink($target_file);
                }

                // Upload the new photo file
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                
                // Update query including the photo and role
                $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', emergency_contact='$emergency_contact', salary='$salary', hired_date='$hired_date', photo='$target_file', role_id='$role_id' WHERE employee_id=$employee_id";
            } else {
                // Update query without changing the photo
                $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', emergency_contact='$emergency_contact', salary='$salary', hired_date='$hired_date', role_id='$role_id' WHERE employee_id=$employee_id";
            }

            if ($conn->query($sql) === TRUE) {
                echo "Employee updated successfully.";
                header("Location: index.php");
            } else {
                echo "Error updating employee: " . $conn->error;
            }
        } else {
            // Check if employee ID is provided
            if (isset($_GET['id'])) {
                $employee_id = $_GET['id'];

                // Query to retrieve employee details
                $sql_employee = "SELECT * FROM employees WHERE employee_id=$employee_id";
                $result_employee = $conn->query($sql_employee);

                // Query to retrieve roles
                $sql_roles = "SELECT * FROM roles";
                $result_roles = $conn->query($sql_roles);

                if ($result_employee->num_rows > 0) {
                    $row_employee = $result_employee->fetch_assoc();
                    // Employee details
                    $first_name = $row_employee['first_name'];
                    $last_name = $row_employee['last_name'];
                    $email = $row_employee['email'];
                    $phone = $row_employee['phone'];
                    $address = $row_employee['address'];
                    $emergency_contact = $row_employee['emergency_contact'];
                    $salary = $row_employee['salary'];
                    $hired_date = $row_employee['hired_date'];
                    $photo = $row_employee['photo'];
                    $role_id = $row_employee['role_id']; // Get current role ID

                    // Display form for editing
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="employee_id" value="<?= $employee_id ?>">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $first_name ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $last_name ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?= $phone ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3"><?= $address ?></textarea>
            </div>
            <div class="form-group">
                <label for="emergencyContact">Emergency Contact</label>
                <input type="text" class="form-control" id="emergencyContact" name="emergencyContact" value="<?= $emergency_contact ?>">
            </div>
            <div class="form-group">
                <label for="salary">Salary ($)</label>
                <input type="number" class="form-control" id="salary" name="salary" min="0" step="0.01" value="<?= $salary ?>" required>
            </div>
            <div class="form-group">
                <label for="hiredDate">Hired Date</label>
                <input type="date" class="form-control" id="hiredDate" name="hiredDate" value="<?= $hired_date ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control-file" id="photo" name="photo" onchange="previewImage(event)">
                <img id="preview" src="<?= $photo ?>" alt="Employee Photo" style="max-width: 100px;">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <?php
                    // Loop through roles and display options
                    while ($role_row = $result_roles->fetch_assoc()) {
                        $rolee_id = $role_row['role_id'];
                        $rolee_name = $role_row['role_name'];
                        ?>
                        <option value="<?= $rolee_id ?>" <?= ($rolee_id == $role_id) ? 'selected' : '' ?>>
                            <?= $rolee_name ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
        <?php
                } else {
                    echo "Employee not found.";
                }
            } else {
                echo "Employee ID not provided.";
            }
        }
        ?>
    </div>
</body>
</html>
