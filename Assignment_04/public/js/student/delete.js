$(document).ready(function () {
    var student_id = null;
    var student_name = '';
    $(document).on('click', '.deletestudentbtn', function (e) {
        e.preventDefault();

        student_id = $(this).val();
        $.ajax({
            url: '/student/' + student_id + "/edit", // Adjust this URL to fetch the major's data
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    student_name = response.student.name;

                    // Insert the major's name into the modal
                    $('#delete_student_name').text(student_name);

                    // Show the delete confirmation modal
                    $('#studeleteConfirmModal').modal('show');
                } else {
                    alert('Error fetching major details.');
                }
            },
            error: function () {
                alert('An error occurred while fetching the major details.');
            }
        });
    });

    $('#stuconfirmDeleteBtn').on('click', function () {
        $.ajax({
            url: '/delete_student/' + student_id,
            type: 'DELETE',
            dataType: 'json',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status == 200) {
                    $('button[value="' + student_id + '"]').closest('tr').remove();

                    $('#studeleteConfirmModal').modal('hide');

                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                } else {
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                    $('#studeleteConfirmModal').modal('hide');
                }
            },
            error: function () {
                alert('An error occurred while deleting.');
                $('#studeleteConfirmModal').modal('hide');
            }
        });
    });
});
