@extends('layouts.app')

@section('content')
    <h1>Add New Book</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="author_id">Author</label>
            <select name="author_id" id="author_id" class="form-control" required>
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
            @error('author_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="">Select Category</option>
                @foreach(['Fiction', 'Non-Fiction', 'Sci-Fi', 'Mystery', 'Biography'] as $cat)
                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="publication_year">Publication Year</label>
            <input type="number" name="publication_year" id="publication_year" class="form-control" value="{{ old('publication_year') }}">
            @error('publication_year')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection