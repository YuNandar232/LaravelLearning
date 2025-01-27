@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="success_message"></div>
                <div class="card">
                    <div class="card-header">Major List</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddMajorModal">
                            <i class="fa fa-btn fa-plus"></i> Add
                        </button>

                        <table class="table table-striped" id="majorsTable">
                            <thead>
                                <tr>
                                    <th class="w-50">Major Name</th>
                                    <th class="text-end"></th>
                                    <th class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Delete Major</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete 【<span id="delete_major_name"></span>】?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('Major.create_modal')
    @include('Major.edit_modal')
    <script>
        $(document).ready(function() {

            fetchmajor();

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
                                        <td class="text-end"><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm"> <i class="fa fa-btn fa-edit"></i>Edit</button></td>\
                                        <td class="text-end"><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm"> <i class="fa fa-btn fa-trash"></i>Delete</button></td>\
                                    \</tr>');

                        });
                    }
                });
            }

            $(document).on('click', '.editbtn', function(e) {
                e.preventDefault();
                var major_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/major/" + major_id + "/edit",
                    success: function(response) {
                        $('#major_name').val(response.major.name);
                        $('#major_id').val(major_id);
                        $('#editMajorModal').modal('show');
                    }
                });
                $('.btn-close').find('input').val('');

            });
        });
    </script>
@endsection
