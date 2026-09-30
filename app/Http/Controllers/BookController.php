<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = auth()->user()->books()->withCount('chapters')->latest()->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        $book = auth()->user()->books()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'synopsis' => $validated['synopsis'] ?? null,
            'cover_image' => $coverPath,
            'status' => 'draft',
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Book created successfully!');
    }

    public function show(Book $book)
    {
        $this->authorizeOwner($book);
        $book->load('chapters');
        return view('books.show', compact('book'));
    }

    private function authorizeOwner(Book $book)
    {
        if ($book->user_id !== auth()->id()) {
            abort(403);
        }
    }
}