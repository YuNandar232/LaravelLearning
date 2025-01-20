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
        
        <!-- Display Error Message for delete major-->
        @if (session('error'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Display Error Message for import validation -->
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
                        Major List
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
                                <a href="{{ route('majors.export') }}" class="btn btn-primary">
                                    <i class="fa fa-download"></i> Export
                                </a>
                            </div>
                            <a href="{{ route('majors.create') }}" class="btn btn-primary">
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
                                        <form action="{{ route('majors.import') }}" method="POST"
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
                        @if (count($majors) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <th style="width: 70%;">Major Name</th>
                                    <th style="width: 15%;">&nbsp;</th>
                                    <th style="width: 15%;">&nbsp;</th>
                                </thead>
                                <tbody>
                                    @foreach ($majors as $major)
                                        <tr>
                                            <td>{{ $major->name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('majors.edit', $major->id) }}"
                                                    class="btn btn-primary d-flex justify-content-center align-items-center">
                                                    <i class="fa fa-btn fa-edit"></i>Edit
                                                </a>
                                            </td>
                                            <td>
                                                <!-- Delete Button (using an anchor tag for deletion) -->
                                                 <a href="{{ route('majors.destroy', $major->id) }}"
                                                 class="btn btn-danger d-flex justify-content-center align-items-center btn-delete-major"
                                                 data-form-id="delete-form-{{ $major->id }}">
                                                 <i class="fa fa-btn fa-trash"></i>Delete
                                                 </a>

                                                <!-- Hidden form for delete action -->
                                                <form id="delete-form-{{ $major->id }}"
                                                    action="{{ route('majors.destroy', $major->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
