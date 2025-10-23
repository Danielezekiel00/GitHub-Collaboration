<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Book::with('author');
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhereHas('author', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }
        $books = $query->paginate(10);
        return view('books.index', compact('books', 'search'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = ['Fiction', 'Non-Fiction', 'Sci-Fi', 'Mystery', 'Biography'];
        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'author_id' => 'required|exists:authors,id',
            'category' => 'nullable|string|max:100|in:Fiction,Non-Fiction,Sci-Fi,Mystery,Biography',
            'publication_year' => 'nullable|digits:4',
        ]);

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book added successfully');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = ['Fiction', 'Non-Fiction', 'Sci-Fi', 'Mystery', 'Biography'];
        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'author_id' => 'required|exists:authors,id',
            'category' => 'nullable|string|max:100|in:Fiction,Non-Fiction,Sci-Fi,Mystery,Biography',
            'publication_year' => 'nullable|digits:4',
        ]);

        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}