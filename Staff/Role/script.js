$(document).ready(function(){
    $('#addRoleForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add_role.php',
            data: $(this).serialize(),
            success: function(response){
                $('#addRoleModal').modal('hide');
                // Optionally, you can reload the roles list or update the UI here
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                alert('Error occurred while adding role. Please try again.');
            }
        });
    });
});
