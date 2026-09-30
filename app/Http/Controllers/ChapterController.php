<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    public function create(Book $book)
    {
        return view('chapters.editor', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'action' => 'required|in:draft,publish',
        ]);

        $nextOrder = $book->chapters()->max('order_number') + 1;
        $isPublishing = $validated['action'] === 'publish';

        $chapter = $book->chapters()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'content' => $validated['content'],
            'order_number' => $nextOrder,
            'status' => $isPublishing ? 'published' : 'draft',
            'published_at' => $isPublishing ? now() : null,
        ]);

        return redirect()->route('books.show', $book)
            ->with('success', $isPublishing ? 'Chapter published!' : 'Draft saved.');
    }

    public function edit(Book $book, Chapter $chapter)
    {
        return view('chapters.editor', compact('book', 'chapter'));
    }

    public function update(Request $request, Book $book, Chapter $chapter)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'action' => 'required|in:draft,publish',
        ]);

        $isPublishing = $validated['action'] === 'publish';

        $chapter->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $isPublishing ? 'published' : 'draft',
            'published_at' => $isPublishing && !$chapter->published_at ? now() : $chapter->published_at,
        ]);

        return redirect()->route('books.show', $book)
            ->with('success', 'Chapter updated.');
    }
}
