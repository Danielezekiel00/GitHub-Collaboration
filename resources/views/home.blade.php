@extends('layouts.app')

@section('content')
    <h1>Library Overview</h1>
    @if($authors->isEmpty())
        <p>No authors or books found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Book Title</th>
                    <th>Category</th>
                    <th>Publication Year</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                    @foreach($author->books as $book)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category ?? 'N/A' }}</td>
                            <td>{{ $book->publication_year ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
@endsection