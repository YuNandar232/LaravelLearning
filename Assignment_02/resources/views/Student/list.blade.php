@extends('layouts.app')

@section('content')
    <!-- Display Success Message -->
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

        @if ($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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
                        <!-- Buttons Section -->
                        <div class="d-flex justify-content-between mb-4">
                            <!-- Align Import and Export to the left, Add Major to the right -->
                            <div>
                                <button type="button" class="btn btn-primary ml-2" data-bs-toggle="modal"
                                    data-bs-target="#importModal">
                                    <i class="fa fa-file"></i> Import
                                </button>
                                <a href="{{ route('students.export') }}" class="btn btn-primary">
                                    <i class="fa fa-download"></i> Export
                                </a>
                            </div>
                            <a href="{{ route('students.create') }}" class="btn btn-primary">
                                <i class="fa fa-btn fa-plus"></i> Add
                            </a>
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
                                        <form action="{{ route('students.import') }}" method="POST"
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
                        @if (count($students) > 0)
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
                                                    <a href="{{ route('students.edit', $student->id) }}"
                                                        class="btn btn-primary d-flex justify-content-center align-items-center">
                                                        <i class="fa fa-btn fa-edit"></i>Edit
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Delete Button (using an anchor tag for deletion) -->
                                                     <a href="{{ route('students.destroy', $student->id) }}"
                                                      class="btn btn-danger d-flex justify-content-center align-items-center btn-delete-student"
                                                      data-form-id="delete-form-{{ $student->id }}">
                                                      <i class="fa fa-btn fa-trash"></i>Delete
                                                     </a>

                                                    <!-- Hidden form for delete action -->
                                                    <form id="delete-form-{{ $student->id }}"
                                                        action="{{ route('students.destroy', $student->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
