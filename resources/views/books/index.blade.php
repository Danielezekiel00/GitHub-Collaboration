@extends('layouts.app')

@section('content')
    <h1>Books List</h1>
    <div class="mb-3">
        <form action="{{ route('books.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search books by title, author, or category" value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
                @if ($search)
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </div>
        </form>
    </div>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add Book</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Publication Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->category ?? 'N/A' }}</td>
                    <td>{{ $book->publication_year ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $books->appends(['search' => $search])->links() }}
@endsection