@extends('layouts.app')

     @section('content')
         <h1>Edit Author</h1>
         <form action="{{ route('authors.update', $author) }}" method="POST">
             @csrf
             @method('PUT')
             <div class="form-group mb-3">
                 <label for="name">Name</label>
                 <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}" required>
                 @error('name')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>
             <button type="submit" class="btn btn-primary">Update</button>
             <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
         </form>
     @endsection