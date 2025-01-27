<div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Create New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Student</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <span id="nameError"></span>
                </div>
                <!-- Major Dropdown -->
                <div class="mb-3">
                    <label for="major_id" class="form-label">Major</label>
                    <select class="form-control" id="major_id" name="major_id">
                        <option value="" disabled selected>Select Major</option>
                    </select>
                    <span id="major_idError"></span>
                </div>
                <!-- Phone Field -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required
                        value="{{ old('phone') }}">
                    <span id="phoneError"></span>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        value="{{ old('email') }}">
                    <span id="emailError"></span>
                </div>

                <!-- Address Field -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" required rows="3">{{ old('address') }}</textarea>
                    <span id="addressError"></span>
                </div>

                <button type="submit" class="btn btn-primary add_student" id="submitBtn">Create</button>

            </div>
        </div>
    </div>
</div>

<script>
    // For create student
    $(document).on('click', '.add_student', function(e) {
        e.preventDefault();

        var data = {
            'name': $('#name').val(),
            'major_id': $('#major_id').val(),
            'phone': $('#phone').val(),
            'email': $('#email').val(),
            'address': $('#address').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/student",
            data: data,
            dataType: "json",
            success: function(response) {
                clearValidationError();
                if (response.status == 400) {
                    $.each(response.errors, function(key, err_value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + 'Error').text(err_value).addClass('text-danger');
                    });
                } else {
                    clearValidationError();
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#AddStudentModal').find('input, select, textarea').val('');
                    $('#AddStudentModal').modal('hide');
                    fetchstudent();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
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

    function clearValidationError() {
        // Clear previous errors
        $('#name').removeClass('is-invalid');
        $('#phone').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');
        $('#address').removeClass('is-invalid');
        $('#major_id').removeClass('is-invalid');

        $('#nameError').text('');
        $('#phoneError').text('');
        $('#emailError').text('');
        $('#addressError').text('');
        $('#major_idError').text('');
    }

    $('#AddStudentModal').on('hidden.bs.modal', function() {
        clearValidationError();
        $('#AddStudentModal').find('input').val('');
    });

    // Load the students list via AJAX
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
