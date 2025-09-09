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
