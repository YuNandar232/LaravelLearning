<div class="modal fade" id="editMajorModal" tabindex="-1" aria-labelledby="editmajorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editmajorModalLabel">Update Major</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="major_id" />
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Major Name</label>
                    <input type="text" id="major_name" required class="form-control">
                    <span class="nameError"></span>
                </div>
                <button type="submit" class="btn btn-primary update_major" id="submitBtn">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.update_major', function(e) {
        e.preventDefault();
        var id = $('#major_id').val();
        var data = {
            'name': $('#major_name').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "/update_major/" + id,
            data: data,
            dataType: "json",
            success: function(response) {
                clearValidationError();
                if (response.status == 400) {
                    $.each(response.errors, function(key, err_value) {
                        $('.' + key).addClass('is-invalid');
                        $('.' + key + 'Error').text(err_value).addClass('text-danger');
                    });
                } else {
                    clearValidationError();
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editMajorModal').find('input').val('');
                    $('#editMajorModal').modal('hide');
                    fetchmajor();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, err_value) {
                        $('.' + key).addClass('is-invalid');
                        $('.' + key + 'Error').text(err_value).addClass('text-danger');
                    });
                } else {
                    alert('An error occurred: ' + xhr.responseText);
                }
            }
        });
    });

    function clearValidationError() {
        // Clear previous errors
        $('#major_name').removeClass('is-invalid');
        $('.nameError').text('');
    }
    $('#editMajorModal').on('hidden.bs.modal', function() {
        clearValidationError();
        $('#editMajorModal').find('input').val('');
    });

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
