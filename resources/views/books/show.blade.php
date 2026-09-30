<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} · Potato-Site</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar-layout.css') }}">
    <style>
        .book-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .book-title {
            font-size: 2rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 0.25rem;
        }
        .book-desc {
            font-size: 1rem;
            color: #6b7280;
        }
        .chapter-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }
        .chapter-title {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
        }
        .chapter-actions {
            display: flex;
            gap: 1rem;
        }
        .link-action {
            font-size: 0.875rem;
            font-weight: 600;
            color: #2563eb;
            text-decoration: none;
        }
        .link-action:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <header class="top-navbar">
        <a href="{{ url('/') }}" class="brand-section">
            <span style="font-size: 1.25rem;">🥔</span>
            <span class="brand-title">Potato-Site</span>
        </a>
        <div class="user-profile-pill">{{ auth()->user()->name }}</div>
    </header>

    <div class="layout-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="profile-name">{{ auth()->user()->name }}</div>

            <a href="{{ route('books.create') }}" class="btn-primary">+ Start New Book</a>

            <nav>
                <a href="{{ route('dashboard') }}" class="sidebar-link">Dashboard</a>
                <a href="{{ route('books.index') }}" class="sidebar-link active">My Books</a>
                <a href="{{ route('profile.edit') }}" class="sidebar-link">Profile</a>
                
                <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-wrapper">
                
                <div class="book-header">
                    <div>
                        <h1 class="book-title">{{ $book->title }}</h1>
                        <p class="book-desc">{{ $book->description ?? 'No description provided.' }}</p>
                    </div>
                    <a href="{{ route('chapters.create', $book) }}" class="btn-primary" style="width: auto; padding: 0.6rem 1.25rem;">+ Write Chapter</a>
                </div>

                <h2 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">Chapters</h2>

                @if($book->chapters->isEmpty())
                    <div class="chapter-card" style="justify-content: center; color: #6b7280; padding: 2rem;">
                        No chapters written yet.
                    </div>
                @else
                    @foreach($book->chapters as $index => $chapter)
                        <div class="chapter-card">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <span class="chapter-title">Chapter {{ $index + 1 }}: {{ $chapter->title }}</span>
                                <span class="status-badge" style="margin-bottom: 0;">{{ $chapter->status ?? 'published' }}</span>
                            </div>
                            <div class="chapter-actions">
                                <a href="{{ route('chapters.show', [$book, $chapter]) }}" class="link-action">View</a>
                                <a href="{{ route('chapters.edit', [$book, $chapter]) }}" class="link-action">Edit</a>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </main>
    </div>

</body>
</html>