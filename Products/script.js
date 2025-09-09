$(document).ready(function() {
    // Fetch categories
    $.ajax({
        url: 'get_categories.php',
        type: 'GET',
        success: function(response) {
            $('#category').html(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});

function addProduct() {
    var formData = new FormData();
    formData.append('category', $('#category').val());
    formData.append('productName', $('#productName').val());
    formData.append('productPrice', $('#productPrice').val());
    formData.append('availableStatus', $('#availableStatus').val());
    formData.append('productDescription', $('#productDescription').val());
    formData.append('productPicture', $('#productPicture')[0].files[0]);

    // Validate inputs
    var productName = $('#productName').val();
    var productPrice = $('#productPrice').val();
    var productPicture = $('#productPicture').val();
    if (!productName || !productPrice || !productPicture) {
        alert('Please fill in all required fields.');
        return;
    }

    $.ajax({
        url: 'add_product.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert(response); // Display success or error message
            $('#productForm')[0].reset(); // Clear form fields after successful submission
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

// Search Bar code
// script.js

