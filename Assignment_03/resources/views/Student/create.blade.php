@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Student</div>
                       <div class="card-body">
                        <form action="{{ route('students.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Student</label>
                                 <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                
                                @error('name') <!-- Display the validation error for 'name' -->
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Major Dropdown -->
                            <div class="mb-3">
                                <label for="major_id" class="form-label">Major</label>
                                <select class="form-control @error('major_id') is-invalid @enderror" id="major_id" name="major_id">
                                    <option value="" disabled selected>Select Major</option>
                                     @foreach($majors as $major)
                                        <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                                    @endforeach
                                </select>
                                  @error('major_id') <!-- Display the validation error for 'major_id' -->
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                               <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                               <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                
                                @error('email') <!-- Display the validation error for 'email' -->
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address Field -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                       </div>
                </div>
            </div>
        </div>
    </div>
@endsection
