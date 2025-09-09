<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Employee Management System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <header>
        <h1>Staff</h1>
        <p>Welcome, Admin</p>
    </header>
    <nav>
        <div id="nav-wrapper">
            <ul id="nav-list">
                <li><a href="http://localhost/RMS/Dashboard/index.php" class="active"><span class="material-icons">home</span>Dashboard</a></li>
                <li><a href="http://localhost/RMS/Categories/index.php"><span class="material-icons">category</span>Categories</a></li>
                <li><a href="http://localhost/RMS/Products/index.php"><span class="material-icons">local_drink</span>Products</a></li>
                <li><a href="http://localhost/RMS/Tables/index.php"><span class="material-icons">table_chart</span>Tables</a></li>
                <li><a href="http://localhost/RMS/Events/events.php"><span class="material-icons">event</span>Events</a></li>
                <li><a href="http://localhost/RMS/Staff/Info/index.php"><span class="material-icons">group</span>Staff</a></li>
                <li><a href="http://localhost/RMS/POS/index.php"><span class="material-icons">payment</span>POS</a></li>
                <li><a href="http://localhost/RMS/Kitchen/index.php"><span class="material-icons">kitchen</span>Kitchen</a></li>
                <li><a href="http://localhost/RMS/Reports/index.php"><span class="material-icons">bar_chart</span>Reports</a></li>
                <li><a href="http://localhost/RMS/Settings/index.php"><span class="material-icons">settings</span>Settings</a></li>
                <li><a href="http://localhost/RMS/Exit/index.php"><span class="material-icons">exit_to_app</span>Exit</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <!-- Add Employee button -->
                    <!-- 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">
                    <i class="fas fa-plus"></i> Add Employee
                </button> 
                -->

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">
                        <i class="fas fa-user-plus"></i> Add Employee
                    </button>

                    <a href="http://localhost/RMS/Staff/Role/index.php">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Roles
                        </button>
                    </a>


                    <!-- toggle button -->
                    <!-- <button id="toggleButton" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Roles
                </button> -->

                </div>
                <div class="col-md-6">
                    <!-- Search bar -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Employee" id="searchInput">
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form content -->
                            <form id="employeeForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="">Select Role</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="emergencyContact">Emergency Contact</label>
                                    <input type="text" class="form-control" id="emergencyContact" name="emergencyContact">
                                </div>
                                <div class="form-group">
                                    <label for="salary">Salary ($)</label>
                                    <input type="number" class="form-control" id="salary" name="salary" min="0" step="0.01" required>
                                </div>
                                <div class="form-group">
                                    <label for="hiredDate">Hired Date</label>
                                    <input type="date" class="form-control" id="hiredDate" name="hiredDate" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Picture</label>
                                    <input type="file" class="form-control-file" id="picture" name="picture" required>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" onclick="addEmployee()">Add Employee</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-5">
            <h2>Employees by Role</h2>

            <?php
            include 'db_connection.php'; // Include the database connection file

            // Function to display employee table row
            function displayEmployeeRow($employee_row)
            {
            ?>
                <tr>
                    <td><?= $employee_row["employee_id"] ?></td>
                    <td><?= $employee_row["first_name"] ?></td>
                    <td><?= $employee_row["last_name"] ?></td>
                    <td><?= $employee_row["email"] ?></td>
                    <td><?= $employee_row["phone"] ?></td>
                    <td><?= $employee_row["address"] ?></td>
                    <td><?= $employee_row["emergency_contact"] ?></td>
                    <td><?= $employee_row["salary"] ?></td>
                    <td><?= $employee_row["hired_date"] ?></td>
                    <td>
                        <img src="<?= $employee_row["photo"] ?>" alt="Employee Photo" style="max-width: 100px;">
                    </td>
                    <td>
                        <a href='edit_employee.php?id=<?= $employee_row['employee_id'] ?>' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='delete_employee.php?id=<?= $employee_row['employee_id'] ?>' class='btn btn-sm btn-danger'>Delete</a>
                    </td>
                </tr>
                <?php
            }

            // Query to fetch roles
            $sql = "SELECT * FROM roles";
            $result = $conn->query($sql);

            // Display roles and corresponding employees
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                ?>
                    <h3><?= $row["role_name"] ?></h3>
                    <?php

                    // Query to fetch employees of this role
                    $employees_sql = "SELECT * FROM employees WHERE role_id=" . $row["role_id"];
                    $employees_result = $conn->query($employees_sql);

                    // Display employees in a table
                    if ($employees_result->num_rows > 0) {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-bordered custom-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Emergency Contact</th>
                                        <th>Salary</th>
                                        <th>Hired Date</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($employee_row = $employees_result->fetch_assoc()) {
                                        displayEmployeeRow($employee_row);
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
            <?php
                    } else {
                        echo "<p>No employees found for this role.</p>";
                    }
                }
            } else {
                echo "<p>No roles found.</p>";
            }
            ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome for icons -->
        <script>
            $(document).ready(function() {
                // Fetch roles
                $.ajax({
                    url: 'get_roles.php',
                    type: 'GET',
                    success: function(response) {
                        $('#role').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            function addEmployee() {
                var formData = new FormData();
                formData.append('role', $('#role').val());
                formData.append('firstName', $('#firstName').val());
                formData.append('lastName', $('#lastName').val());
                formData.append('email', $('#email').val());
                formData.append('phone', $('#phone').val());
                formData.append('address', $('#address').val());
                formData.append('emergencyContact', $('#emergencyContact').val());
                formData.append('salary', $('#salary').val());
                formData.append('hiredDate', $('#hiredDate').val());
                formData.append('password', $('#password').val());
                formData.append('picture', $('#picture')[0].files[0]);

                // Validate inputs
                var firstName = $('#firstName').val();
                var lastName = $('#lastName').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var password = $('#password').val();
                if (!firstName || !lastName || !email || !phone || !password) {
                    alert('Please fill in all required fields.');
                    return;
                }

                $.ajax({
                    url: 'add_employee.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response); // Display success or error message
                        $('#employeeForm')[0].reset(); // Clear form fields after successful submission
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            //for toggle button 
            $(document).ready(function() {
                $('#toggleButton').click(function() {
                    $.ajax({
                        url: 'http://localhost/RMS/Staff/Role/index.php',
                        success: function(data) {
                            $('body').html(data);
                        }
                    });
                });
            });
        </script>
    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>

</html>
