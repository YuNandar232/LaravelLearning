@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Student List
                </div>
                <div class="card-body">
                    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-btn fa-plus"></i> Add Student
                        </a>
                       
                  <!-- Display Student List -->
            @if (count($students) > 0)
           
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Student Name</th>
                            <th>Major Name</th>
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
                                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary d-flex justify-content-center align-items-center">
                                                        <i class="fa fa-btn fa-edit"></i>Edit
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Delete Button (using an anchor tag for deletion) -->
                                                    <a href="{{ route('students.destroy', $student->id) }}" 
                                                       class="btn btn-danger d-flex justify-content-center align-items-center" 
                                                       onclick="event.preventDefault(); 
                                                                if(confirm('Are you sure you want to delete this student?')) {
                                                                    document.getElementById('delete-form-{{ $student->id }}').submit();
                                                                }">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </a>
                                                    
                                                    <!-- Hidden form for delete action -->
                                                    <form id="delete-form-{{ $student->id }}" 
                                                          action="{{ route('students.destroy', $student->id) }}" 
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
