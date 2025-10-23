<?php

     namespace App\Http\Controllers;

     use App\Models\Author;
     use Illuminate\Http\Request;

     class AuthorController extends Controller
     {
         public function index(Request $request)
         {
             $search = $request->query('search');
             $query = Author::with('books');
             if ($search) {
                 $query->where('name', 'like', '%' . $search . '%');
             }
             $authors = $query->paginate(10);
             return view('authors.index', compact('authors', 'search'));
         }

         public function create()
         {
             return view('authors.create');
         }

         public function store(Request $request)
         {
             $validated = $request->validate([
                 'name' => 'required|string|max:150|unique:authors',
             ]);

             Author::create($validated);
             return redirect()->route('authors.index')->with('success', 'Author added successfully');
         }

         public function edit(Author $author)
         {
             return view('authors.edit', compact('author'));
         }

         public function update(Request $request, Author $author)
         {
             $validated = $request->validate([
                 'name' => 'required|string|max:150|unique:authors,name,' . $author->id,
             ]);

             $author->update($validated);
             return redirect()->route('authors.index')->with('success', 'Author updated successfully');
         }

         public function destroy(Author $author)
         {
             $author->delete();
             return redirect()->route('authors.index')->with('success', 'Author deleted successfully');
         }
     }