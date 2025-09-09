<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <header>
        <h1>Staff/Role</h1>
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
        <div class="container">


            <h2>Add Role</h2>
            <form id="addRoleForm">
                <div class="form-group">
                    <label for="role_name">Role Name:</label>
                    <input type="text" class="form-control" id="role_name" name="role_name" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Role</button>
            </form>
            <hr>

            <a href="http://localhost/RMS/Staff/Info/index.php">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Employee
                </button>
            </a>

            <!-- toggle button -->
            <!-- <button id="toggleButton" class="btn btn-primary">
<i class="fas fa-user-plus"></i> Employee
</button> -->
            <hr>

            <div class="form-group">
                <label for="searchInput">Search Roles:</label>
                <input type="text" class="form-control" id="searchInput" placeholder="Enter role name...">
            </div>

            <hr>
            <h2>Roles:</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="roleTable">
                        <!-- Roles will be loaded here using JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('addRoleForm');

                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const formData = new FormData(form);

                    // Send a POST request to add_role.php
                    fetch('add_role.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text()) // Convert response to text
                        .then(data => {
                            // Check the response from the server
                            if (data === 'exists') {
                                // Display a message if the role name already exists
                                alert('Role name already exists in the database.');
                            } else {
                                // Reload the role table if the role is added successfully
                                loadRoles();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });

                // Function to handle search
                function handleSearch() {
                    const searchInput = document.getElementById('searchInput').value;

                    // Send AJAX request to get_roles.php with search query
                    fetch(`get_roles.php?search=${searchInput}`)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('roleTable').innerHTML = data;
                            attachEditEventListeners(); // Attach edit event listeners after loading roles
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Attach event listener to search input field
                document.getElementById('searchInput').addEventListener('input', handleSearch);

                // Function to load roles from get_roles.php
                function loadRoles() {
                    fetch('get_roles.php')
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('roleTable').innerHTML = data;
                            attachEditEventListeners(); // Attach edit event listeners after loading roles
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Function to attach event listeners to edit buttons
                function attachEditEventListeners() {
                    const editButtons = document.querySelectorAll('.edit-role-btn');
                    editButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const roleId = this.dataset.id;
                            const newRoleName = prompt("Enter the new role name:");

                            if (newRoleName !== null) {
                                // Send a POST request to edit_role.php with the new role name and ID
                                fetch(`edit_role.php?id=${roleId}`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: `roleName=${encodeURIComponent(newRoleName)}`
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            // Reload roles after successful edit
                                            loadRoles();
                                            alert('Role updated successfully.');
                                        } else {
                                            // Handle error if edit fails
                                            alert('Failed to update role.');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        });
                    });
                }

                // Load roles on page load
                loadRoles();
            });


            //for toggle button

            $(document).ready(function() {
                $('#toggleButton').click(function() {
                    $.ajax({
                        url: 'http://localhost/RMS/Staff/Info/index.php',
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
