<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard · Potato-Site</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar-layout.css') }}">
</head>
<body>

    <header class="top-navbar">
        <a href="{{ url('/') }}" class="brand-section">
            <span style="font-size: 1.25rem;">🥔</span>
            <span class="brand-title">Potato-Site</span>
        </a>
        <div class="user-profile-pill">
            {{ auth()->user()->name }}
        </div>
    </header>

    <div class="layout-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="profile-name">{{ auth()->user()->name }}</div>

            <a href="{{ route('books.create') }}" class="btn-primary">+ Start New Book</a>

            <nav>
                <a href="{{ route('dashboard') }}" class="sidebar-link active">
                    Dashboard
                </a>
                <a href="{{ route('books.index') }}" class="sidebar-link">
                    My Books
                </a>
                <a href="{{ route('profile.edit') }}" class="sidebar-link">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Log Out
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="main-content">
            <div class="content-wrapper">
                <h1 class="page-heading">Your Books</h1>

                @if($books->isEmpty())
                    <div class="series-card" style="justify-content: center; padding: 3rem; text-align: center; color: #6b7280;">
                        <div>
                            <p style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">No books created yet</p>
                            <p style="font-size: 0.875rem; margin-bottom: 1.5rem;">Click below to create your first book.</p>
                            <a href="{{ route('books.create') }}" class="btn-primary" style="display: inline-block; width: auto; padding: 0.6rem 1.5rem;">+ Start New Book</a>
                        </div>
                    </div>
                @else
                    <div class="series-list">
                        @foreach($books as $book)
                            <div class="series-card">
                                <div class="series-main">
                                    <div class="series-cover">
                                        📖
                                    </div>
                                    <div class="series-details">
                                        <span class="status-badge">{{ $book->status ?? 'Draft' }}</span>
                                        <h3>{{ $book->title }}</h3>
                                        <div class="meta">
                                            {{ $book->chapters_count }} {{ Str::plural('Chapter', $book->chapters_count) }}
                                            · Updated {{ $book->updated_at ? $book->updated_at->format('M d, Y') : now()->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="series-actions">
                                    <a href="{{ route('books.show', $book) }}" class="btn-action">Manage Book</a>
                                    <a href="{{ route('chapters.create', $book) }}" class="btn-action btn-action-primary">+ Write Chapter</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>
    </div>

</body>
</html>