<div class="modal fade" id="AddMajorModal" tabindex="-1" aria-labelledby="majorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="majorModalLabel">Create New Major</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Major Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <span id="nameError"></span>
                </div>
                <button type="submit" class="btn btn-primary add_major" id="submitBtn">Create</button>
            </div>
        </div>
    </div>
</div>

<script>
    // For create major
    $(document).on('click', '.add_major', function(e) {
        e.preventDefault();
        clearValidationError();
        var data = {
            'name': $('#name').val(),
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/major",
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.status == 400) {
                    $.each(response.errors, function(key, err_value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + 'Error').text(err_value).addClass('text-danger');
                    });
                } else {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#AddMajorModal').find('input').val('');
                    clearValidationError();
                    $('#AddMajorModal').modal('hide');
                    fetchmajor();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Handle validation errors here
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, err_value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + 'Error').text(err_value).addClass('text-danger');
                    });
                } else {
                    alert('An error occurred: ' + xhr.responseText);
                }
            }
        });
    });
    // Clear validation errors
    function clearValidationError() {
        $('#name').removeClass('is-invalid');
        $('#nameError').text('');
    }

    $('#AddMajorModal').on('hidden.bs.modal', function() {
        clearValidationError();
        $('#AddMajorModal').find('input').val('');
    });


    // Load the majors list via AJAX
    function fetchmajor() {
        $.ajax({
            type: "GET",
            url: "/fetch_majors",
            dataType: "json",
            success: function(response) {
                $('tbody').html("");
                $.each(response.majors, function(key, item) {
                    $('tbody').append('<tr>\
                            <td>' + item.name + '</td>\
                            <td class="text-end"><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm"><i class="fa fa-btn fa-edit"></i>Edit</button></td>\
                            <td class="text-end"><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm"><i class="fa fa-btn fa-trash"></i>Delete</button></td>\
                        \</tr>');
                });
            }
        });
    }
</script>
