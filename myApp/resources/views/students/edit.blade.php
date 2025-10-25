@extends('layouts.app')

@section('content')
    <h1>Edit Student</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="studentNumber">Student Number</label>
            <input type="text" name="studentNumber" id="studentNumber" class="form-control" value="{{ old('studentNumber', $student->studentNumber) }}" required>
            @error('studentNumber')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" class="form-control" value="{{ old('lname', $student->lname) }}" required>
            @error('lname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname', $student->fname) }}" required>
            @error('fname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="mi">Middle Initial</label>
            <input type="text" name="mi" id="mi" class="form-control" value="{{ old('mi', $student->mi) }}">
            @error('mi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email) }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="contactNumber">Contact Number</label>
            <input type="text" name="contactNumber" id="contactNumber" class="form-control" value="{{ old('contactNumber', $student->contactNumber) }}">
            @error('contactNumber')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection