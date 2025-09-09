// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.getElementById('addCategoryForm');

//     form.addEventListener('submit', function(event) {
//         event.preventDefault(); // Prevent default form submission

//         const formData = new FormData(form);

//         // Send a POST request to add_category.php
//         fetch('add_category.php', {
//                 method: 'POST',
//                 body: formData
//             })
//             .then(response => response.text()) // Convert response to text
//             .then(data => {
//                 // Check the response from the server
//                 if (data === 'exists') {
//                     // Display a message if the category name already exists
//                     alert('Category name already exists in the database.');
//                 } else {
//                     // Reload the category table if the category is added successfully
//                     loadCategories();
//                 }
//             })
//             .catch(error => console.error('Error:', error));
//     });

//     // Function to handle search
//     function handleSearch() {
//         const searchInput = document.getElementById('searchInput').value;

//         // Send AJAX request to get_categories.php with search query
//         fetch(`get_categories.php?search=${searchInput}`)
//             .then(response => response.text())
//             .then(data => {
//                 document.getElementById('categoryTable').innerHTML = data;
//                 attachDeleteEventListeners(); // Reattach delete event listeners if necessary
//             })
//             .catch(error => console.error('Error:', error));
//     }

//     // Attach event listener to search input field
//     document.getElementById('searchInput').addEventListener('input', handleSearch);


//     // Function to load categories from get_categories.php
//     function loadCategories() {
//         fetch('get_categories.php')
//             .then(response => response.text())
//             .then(data => {
//                 document.getElementById('categoryTable').innerHTML = data;
//                 attachDeleteEventListeners(); // Attach delete event listeners after loading categories
//             })
//             .catch(error => console.error('Error:', error));
//     }

//     // Function to attach event listeners to delete buttons
//     function attachDeleteEventListeners() {
//         const deleteButtons = document.querySelectorAll('.delete-category-btn');
//         deleteButtons.forEach(button => {
//             button.addEventListener('click', function() {
//                 const categoryId = this.dataset.id;

//                 // Ask for confirmation before deleting
//                 if (confirm("Are you sure you want to delete this category?")) {
//                     // Send a DELETE request to delete_category.php with the category ID
//                     fetch(`delete_category.php?id=${categoryId}`, {
//                             method: 'DELETE'
//                         })
//                         .then(response => {
//                             if (response.ok) {
//                                 // Reload categories after successful deletion
//                                 loadCategories();
//                                 alert('Category deleted successfully.');
//                             } else {
//                                 // Handle error if deletion fails
//                                 alert('Failed to delete category.');
//                             }
//                         })
//                         .catch(error => console.error('Error:', error));
//                 }
//             });
//         });
//     }


//     // Load categories on page load
//     loadCategories();
// });