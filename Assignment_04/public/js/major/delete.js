$(document).ready(function () {
    var major_id = null;
    var major_name = '';

    $(document).on('click', '.deletebtn', function (e) {
        e.preventDefault();

        major_id = $(this).val();
        $.ajax({
            url: '/major/' + major_id + "/edit", // Adjust this URL to fetch the major's data
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    major_name = response.major.name; // Store the major's name

                    // Insert the major's name into the modal
                    $('#delete_major_name').text(major_name);

                    // Show the delete confirmation modal
                    $('#deleteConfirmModal').modal('show');
                } else {
                    alert('Error fetching major details.');
                }
            },
            error: function () {
                alert('An error occurred while fetching the major details.');
            }
        });
    });

    $('#confirmDeleteBtn').on('click', function () {

        $.ajax({
            url: '/delete_major/' + major_id,
            type: 'DELETE',
            dataType: 'json',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status == 200) {
                    $('button[value="' + major_id + '"]').closest('tr').remove();

                    $('#deleteConfirmModal').modal('hide');

                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                } else {
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                    $('#deleteConfirmModal').modal('hide');
                }
            },
            error: function () {
                alert('An error occurred while deleting.');
                $('#deleteConfirmModal').modal('hide');
            }
        });
    });
});
