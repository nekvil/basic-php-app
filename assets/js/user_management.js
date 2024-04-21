const BASE_PATH = $('#base_path').val();

$(document).ready(function() {
    const BASE_PATH = $('#base_path').val();

    function fetchUsers() {
        $.ajax({
            url: BASE_PATH + 'backend/views/user/read.php',
            type: 'GET',
            success: function(response) {
                $('#userTableBody').html(response);
            }
        });
    }

    fetchUsers();

    $('#addUserForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: BASE_PATH + 'backend/views/user/create.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success === false) {
                    alert(data.message); 
                } else {
                    fetchUsers(); 
                }
            }
        });
    });

    $(document).on('click', '.deleteUser', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: BASE_PATH + 'backend/views/user/delete.php',
            type: 'POST',
            data: { user_id: userId },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success === false) {
                    alert(data.message); 
                } else {
                    fetchUsers();
                }
            }
        });
    });
    
});
