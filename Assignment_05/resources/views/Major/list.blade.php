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
        <!-- Display Error Message -->
        @if (session('error'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        {{ session('error') }}
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
                        <a href="{{ route('major.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-btn fa-plus"></i> Create
                        </a>

                        <!-- Display Major List -->
                        @if (count($majors) > 0)
                            <div class="card-body">
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
                                                    <a href="{{ route('major.edit', $major->id) }}"
                                                        class="btn btn-primary d-flex justify-content-center align-items-center">
                                                        <i class="fa fa-btn fa-edit"></i>Edit
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Delete Button (using an anchor tag for deletion) -->
                                                    <a href="#"
                                                        class="btn btn-danger d-flex justify-content-center align-items-center btn-delete-major"
                                                        data-form-id="delete-form-{{ $major->id }}"
                                                        data-major-name="{{ $major->name }}"
                                                        data-action="{{ route('major.destroy', $major->id) }}">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </a>
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
    <!-- Modal for delete confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Major</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete 【<span id="delete_major_name"></span>】?
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
