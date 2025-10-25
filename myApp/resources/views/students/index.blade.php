@extends('layouts.app')

@section('content')
    <h1>Students List</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->studentNumber }}</td>
                    <td>{{ $student->lname }}, {{ $student->fname }} {{ $student->mi }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->contactNumber }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection