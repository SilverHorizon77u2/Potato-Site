<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function showBook(Book $book)
    {
        $chapters = $book->chapters()->where('status', 'published')->orderBy('order_number', 'asc')->get();
        return view('reader.book', compact('book', 'chapters'));
    }

    public function showChapter(Book $book, Chapter $chapter)
    {
        $previousChapter = $book->chapters()
            ->where('order_number', '<', $chapter->order_number)
            ->where('status', 'published')
            ->orderBy('order_number', 'desc')
            ->first();

        $nextChapter = $book->chapters()
            ->where('order_number', '>', $chapter->order_number)
            ->where('status', 'published')
            ->orderBy('order_number', 'asc')
            ->first();

        return view('reader.chapter', compact('book', 'chapter', 'previousChapter', 'nextChapter'));
    }
}