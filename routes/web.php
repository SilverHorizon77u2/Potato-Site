<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ReaderController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Updated Dashboard route to pass user's books to the view
Route::get('/dashboard', function () {
    $books = auth()->user()->books()->withCount('chapters')->latest()->take(5)->get();
    return view('dashboard', compact('books'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Reader Routes (accessible by everyone, no login required)
Route::get('/read/{book:slug}', [ReaderController::class, 'showBook'])->name('reader.book');
Route::get('/read/{book:slug}/{chapter:slug}', [ReaderController::class, 'showChapter'])->name('reader.chapter');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Books Management (This defines books.index, books.create, etc.)
    Route::resource('books', BookController::class);

    // Chapter Management (Nested under Books)
    // Chapter Management (Nested under Books)
    Route::prefix('books/{book}')->name('chapters.')->group(function () {
        Route::get('chapters/create', [ChapterController::class, 'create'])->name('create');
        Route::post('chapters', [ChapterController::class, 'store'])->name('store');
        Route::get('chapters/{chapter}', [ChapterController::class, 'show'])->name('show'); // <-- ADD THIS LINE
        Route::get('chapters/{chapter}/edit', [ChapterController::class, 'edit'])->name('edit');
        Route::put('chapters/{chapter}', [ChapterController::class, 'update'])->name('update');
        Route::delete('chapters/{chapter}', [ChapterController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';