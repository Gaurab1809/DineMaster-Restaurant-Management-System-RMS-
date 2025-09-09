<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style></style>
    <title>Restaurant Management System</title>
</head>

<body>
    <header>
        <h1>Categories</h1>
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
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Category Management System</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="styles.css">
        </head>

        <body>
            <div class="container">
                <h1>Category Management System</h1>
                <form id="addCategoryForm">
                    <div class="form-group">
                        <label for="category_name">Category Name:</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
                <hr>

                <div class="form-group">
                    <label for="searchInput">Search Categories:</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="Enter category name...">
                </div>

                <hr>
                <h2>Categories:</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTable">
                            <!-- Categories will be loaded here using JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('addCategoryForm');

                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent default form submission

                        const formData = new FormData(form);

                        // Send a POST request to add_category.php
                        fetch('add_category.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.text()) // Convert response to text
                            .then(data => {
                                // Check the response from the server
                                if (data === 'exists') {
                                    // Display a message if the category name already exists
                                    alert('Category name already exists in the database.');
                                } else {
                                    // Reload the category table if the category is added successfully
                                    loadCategories();
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });

                    // Function to handle search
                    function handleSearch() {
                        const searchInput = document.getElementById('searchInput').value;

                        // Send AJAX request to get_categories.php with search query
                        fetch(`get_categories.php?search=${searchInput}`)
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('categoryTable').innerHTML = data;
                                attachDeleteEventListeners(); // Reattach delete event listeners if necessary
                            })
                            .catch(error => console.error('Error:', error));
                    }

                    // Attach event listener to search input field
                    document.getElementById('searchInput').addEventListener('input', handleSearch);


                    // Function to load categories from get_categories.php
                    function loadCategories() {
                        fetch('get_categories.php')
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('categoryTable').innerHTML = data;
                                attachDeleteEventListeners(); // Attach delete event listeners after loading categories
                            })
                            .catch(error => console.error('Error:', error));
                    }

                    // Function to attach event listeners to delete buttons
                    function attachDeleteEventListeners() {
                        const deleteButtons = document.querySelectorAll('.delete-category-btn');
                        deleteButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const categoryId = this.dataset.id;

                                // Ask for confirmation before deleting
                                if (confirm("Are you sure you want to delete this category?")) {
                                    // Send a DELETE request to delete_category.php with the category ID
                                    fetch(`delete_category.php?id=${categoryId}`, {
                                            method: 'DELETE'
                                        })
                                        .then(response => {
                                            if (response.ok) {
                                                // Reload categories after successful deletion
                                                loadCategories();
                                                alert('Category deleted successfully.');
                                            } else {
                                                // Handle error if deletion fails
                                                alert('Failed to delete category.');
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                }
                            });
                        });
                    }


                    // Load categories on page load
                    loadCategories();
                });
            </script>
        </body>

        </html>
    </main>
    <footer>
        <p>&copy; 2024 Restaurant Management System. All rights reserved.</p>
    </footer>
</body>

</html>