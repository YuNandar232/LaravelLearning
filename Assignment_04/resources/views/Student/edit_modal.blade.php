<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editstudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editstudentModalLabel">Update Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="student_id" />

                <div class="mb-3">
                    <label for="student_name" class="form-label">Student</label>
                    <input type="text" class="form-control" id="student_name" required>
                    <span class="nameError"></span>
                </div>
                <div class=" mb-3">
                    <label for="major_id" class="form-label">Major</label>
                    <select class="form-control" id="student_major_id" required>
                        <option value="" disabled selected>Select Major</option>
                    </select>
                    <span class="major_idError"></span>
                </div>
                <!-- Phone Field -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="student_phone" required>
                    <span class="phoneError"></span>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="student_email" name="email" required
                        value="{{ old('email') }}">
                    <span class="emailError"></span>
                </div>

                <!-- Address Field -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="student_address" name="address" required rows="3">{{ old('address') }}</textarea>
                    <span class="addressError"></span>
                </div>

                <button type="submit" class="btn btn-primary update_student" id="submitBtn">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.update_student', function(e) {
        e.preventDefault();
        var id = $('#student_id').val();
        var data = {
            'name': $('#student_name').val(),
            'major_id': $('#student_major_id').val(),
            'phone': $('#student_phone').val(),
            'email': $('#student_email').val(),
            'address': $('#student_address').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: "/update_student/" + id,
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
                    $('#editStudentModal').find('input').val('');
                    $('#editStudentModal').modal('hide');
                    fetchstudent();
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
        $('#student_name').removeClass('is-invalid');
        $('#student_phone').removeClass('is-invalid');
        $('#student_email').removeClass('is-invalid');
        $('#student_address').removeClass('is-invalid');
        $('#student_major_id').removeClass('is-invalid');

        $('.nameError').text('');
        $('.phoneError').text('');
        $('.emailError').text('');
        $('.addressError').text('');
        $('.major_idError').text('');
    }

    $('#editStudentModal').on('hidden.bs.modal', function() {
        clearValidationError();
        $('#editStudentModal').find('input').val('');
    });

    function fetchstudent() {
        $.ajax({
            type: "GET",
            url: "/fetch_students",
            dataType: "json",
            success: function(response) {
                $('tbody').html("");
                $.each(response.students, function(key, item) {
                    $('tbody').append('<tr>\
                        <td>' + item.name + '</td>\
                        <td>' + item.major.name + '</td>\
                        <td>' + item.phone + '</td>\
                        <td>' + item.email + '</td>\
                        <td>' + item.address + '</td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm d-flex align-items-center"> <i class="fa fa-btn fa-edit"></i>Edit</button></td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-danger deletestudentbtn btn-sm d-flex align-items-center"> <i class="fa fa-btn fa-trash"></i>Delete</button></td>\
                        \</tr>');
                });
            }
        });
    }
</script>
