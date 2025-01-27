@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Major</div>
                    <div class="card-body">
                        <form action="{{ route('majors.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Major Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                  @error('name') <!-- Display the validation error for 'name' -->
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection