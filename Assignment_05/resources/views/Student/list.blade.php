@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Student List
                    </div>
                    <div class="card-body">
                        <a href="{{ route('student.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-btn fa-plus"></i> Create
                        </a>
                        <!-- Display Student List -->
                        @if (count($students) > 0)
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Student</th>
                                            <th>Major</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th style="width: 6%;">&nbsp;</th>
                                            <th style="width: 8%;">&nbsp;</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->major->name }}</td>
                                                    <td>{{ $student->phone }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->address }}</td>
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('student.edit', $student->id) }}"
                                                            class="btn btn-primary d-flex justify-content-center align-items-center">
                                                            <i class="fa fa-btn fa-edit"></i>Edit
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-danger d-flex justify-content-center align-items-center btn-delete-student"
                                                            data-form-id="delete-form-{{ $student->id }}"
                                                            data-student-name="{{ $student->name }}"
                                                            data-action="{{ route('student.destroy', $student->id) }}">
                                                            <i class="fa fa-btn fa-trash"></i>Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for delete confirmation -->
    <div class="modal fade" id="studentdeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete 【<span id="delete_student_name"></span>】?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="delete-form" method="POST" action="" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
