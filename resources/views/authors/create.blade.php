@extends('layouts.app')

     @section('content')
         <h1>Add New Author</h1>
         <form action="{{ route('authors.store') }}" method="POST">
             @csrf
             <div class="form-group mb-3">
                 <label for="name">Name</label>
                 <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                 @error('name')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>
             <button type="submit" class="btn btn-primary">Save</button>
             <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
         </form>
     @endsection