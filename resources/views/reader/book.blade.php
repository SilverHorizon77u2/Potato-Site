<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} · Potato-Site</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        .reader-container { max-width: 680px; margin: 3rem auto; padding: 0 1rem; }
        .book-meta { border-bottom: 1px solid #e5e7eb; padding-bottom: 1.5rem; margin-bottom: 2rem; }
        .author-tag { color: #6b7280; font-size: 0.9rem; margin-bottom: 1rem; }
        .chapter-list { list-style: none; padding: 0; }
        .chapter-item { padding: 0.875rem 0; border-bottom: 1px solid #f3f4f6; display: flex; justify-content: space-between; }
        .chapter-item a { color: #111827; text-decoration: none; font-weight: 500; }
        .chapter-item a:hover { color: #3b82f6; }
    </style>
</head>
<body>

    <header class="dashboard-navbar">
        <a href="{{ url('/') }}" class="brand">🥔 Potato-Site</a>
    </header>

    <main class="reader-container">
        <div class="book-meta">
            <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;">{{ $book->title }}</h1>
            <p class="author-tag">By <strong>{{ $book->user->name }}</strong></p>
            <p style="line-height: 1.6; color: #374151;">{{ $book->synopsis ?? 'No description available.' }}</p>
        </div>

        <h2>Table of Contents</h2>
        @if($chapters->isEmpty())
            <p style="color: #6b7280; margin-top: 1rem;">No chapters have been published yet.</p>
        @else
            <ul class="chapter-list">
                @foreach($chapters as $ch)
                    <li class="chapter-item">
                        <a href="{{ route('reader.chapter', [$book->slug, $ch->slug]) }}">
                            Chapter {{ $ch->order_number }}: {{ $ch->title }}
                        </a>
                        <span style="color: #9ca3af; font-size: 0.85rem;">
                            {{ $ch->published_at ? $ch->published_at->format('M d, Y') : '' }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>

</body>
</html>