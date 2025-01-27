@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   Major List
                </div>
                <div class="card-body">
                    <a href="{{ route('majors.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-btn fa-plus"></i> Add Major
                        </a>
                       
                  <!-- Display Major List -->
            @if (count($majors) > 0)
           
                <div class="card-body">
                 <!-- Show Error Message if Any -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

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
                                                    <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-primary d-flex justify-content-center align-items-center">
                                                        <i class="fa fa-btn fa-edit"></i>Edit
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Delete Button (using an anchor tag for deletion) -->
                                                    <a href="{{ route('majors.destroy', $major->id) }}" 
                                                       class="btn btn-danger d-flex justify-content-center align-items-center" 
                                                       onclick="event.preventDefault(); 
                                                                if(confirm('Are you sure you want to delete this major?')) {
                                                                    document.getElementById('delete-form-{{ $major->id }}').submit();
                                                                }">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </a>
                                                    
                                                    <!-- Hidden form for delete action -->
                                                    <form id="delete-form-{{ $major->id }}" 
                                                          action="{{ route('majors.destroy', $major->id) }}" 
                                                          method="POST" 
                                                          style="display: none;">
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
