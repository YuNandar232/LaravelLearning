@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="success_message"></div>
                <div class="card">
                    <div class="card-header">
                        Student List
                    </div>
                    <div class="card-body">
                        <!-- Buttons Section -->
                        <div class="d-flex justify-content-between mb-4">
                            <!-- Align Import and Export to the left, Add Major to the right -->
                            <!--<div>
                                            <button type="button" class="btn btn-primary ml-2" data-bs-toggle="modal"
                                                data-bs-target="#importModal">
                                                <i class="fa fa-file"></i> Import
                                            </button>
                                            <a href="{{ route('student.export') }}" class="btn btn-primary">
                                                <i class="fa fa-download"></i> Export
                                            </a>
                                        </div>-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#AddStudentModal">
                                <i class="fa fa-btn fa-plus"></i> Add
                            </button>
                        </div>

                        <!-- Modal for Import File -->
                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importModalLabel">Import Excel File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Import Form Section -->
                                        <form action="{{ route('student.import') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="file" name="file" class="form-control" required>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Display Major List -->
                        <div class="table-responsive">
                            <table class="table table-striped" id="studentsTable">
                                <thead>
                                    <th>Student</th>
                                    <th>Major</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="studeleteConfirmModal" tabindex="-1" aria-labelledby="studeleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studeleteConfirmModalLabel">Delete Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete 【<span id="delete_student_name"></span>】?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="stuconfirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('Student.create_modal')
    @include('Student.edit_modal')
    <script>
        $(document).ready(function() {

            fetchstudent();

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
            $('#AddStudentModal').on('show.bs.modal', function() {
                $.ajax({
                    type: 'GET',
                    url: "/students/create",
                    success: function(response) {
                        var majorsDropdown = $('#major_id');
                        majorsDropdown.empty(); // Clear the dropdown
                        majorsDropdown.append(
                            '<option value="" disabled selected>Select Major</option>');

                        $.each(response.majors, function(key, major) {
                            majorsDropdown.append('<option value="' + major.id + '">' +
                                major.name + '</option>');
                        });
                    }
                });
            });
            $(document).on('click', '.editbtn', function(e) {
                e.preventDefault();
                var student_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/student/" + student_id + "/edit",
                    success: function(response) {
                        var majorsDropdown = $('#student_major_id');
                        majorsDropdown.empty(); // Clear the dropdown
                        majorsDropdown.append(
                            '<option value="" disabled selected>Select Major</option>');

                        $.each(response.majors, function(key, major) {
                            majorsDropdown.append('<option value="' + major.id + '">' +
                                major.name + '</option>');
                        });
                        $('#student_id').val(response.student.id);
                        $('#student_name').val(response.student.name);
                        $('#student_major_id').val(response.student.major_id);
                        $('#student_phone').val(response.student.phone);
                        $('#student_email').val(response.student.email);
                        $('#student_address').val(response.student.address);
                        $('#editStudentModal').modal('show');
                    }
                });
                $('.btn-close').find('input').val('');
            });
        });
    </script>
@endsection
