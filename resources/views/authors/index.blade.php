@extends('layouts.app')

   @section('content')
       <h1>Authors List</h1>
       <div class="mb-3">
           <form action="{{ route('authors.index') }}" method="GET">
               <div class="input-group">
                   <input type="text" name="search" class="form-control" placeholder="Search authors by name" value="{{ $search ?? '' }}">
                   <button type="submit" class="btn btn-primary">Search</button>
                   @if ($search)
                       <a href="{{ route('authors.index') }}" class="btn btn-secondary">Clear</a>
                   @endif
               </div>
           </form>
       </div>
       <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Add Author</a>
       <table class="table table-bordered">
           <thead>
               <tr>
                   <th>Name</th>
                   <th>Books</th>
                   <th>Actions</th>
               </tr>
           </thead>
           <tbody>
               @forelse($authors as $author)
                   <tr>
                       <td>{{ $author->name }}</td>
                       <td>
                           @forelse($author->books as $book)
                               {{ $book->title }} ({{ $book->publication_year ?? 'N/A' }})<br>
                           @empty
                               No books
                           @endforelse
                       </td>
                       <td>
                           <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning">Edit</a>
                           <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline;">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this author?')">Delete</button>
                           </form>
                       </td>
                   </tr>
               @empty
                   <tr>
                       <td colspan="3">No authors found.</td>
                   </tr>
               @endforelse
           </tbody>
       </table>
       {{ $authors->appends(['search' => $search])->links() }}
   @endsection