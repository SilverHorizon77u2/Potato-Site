<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $chapter->title }} - {{ $book->title }} · Potato-Site</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #fbf9f5;
            color: #242424;
            font-family: Georgia, Cambria, "Times New Roman", Times, serif;
            line-height: 1.8;
            min-height: 100vh;
        }
        .reader-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .reader-header a {
            text-decoration: none;
            color: #4b5563;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .reader-header a:hover {
            color: #111827;
        }
        .reader-container {
            max-width: 740px;
            margin: 2.5rem auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            padding: 3rem 2.5rem;
        }
        .book-subtitle {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin-bottom: 0.5rem;
        }
        .chapter-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2rem;
            line-height: 1.25;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .chapter-content {
            font-size: 1.15rem;
            color: #374151;
        }
        .chapter-content p {
            margin-bottom: 1.5rem;
        }
        .chapter-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 3.5rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .nav-btn {
            padding: 0.625rem 1.25rem;
            background: #f3f4f6;
            color: #374151 !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .nav-btn:hover {
            background: #e5e7eb;
        }
    </style>
</head>
<body>

    <header class="reader-header">
        <div style="display: flex; gap: 1.5rem; align-items: center;">
            <a href="{{ route('books.show', $book) }}">← Back to Book Management</a>
            <a href="{{ route('dashboard') }}">← Dashboard</a>
        </div>
        <a href="{{ url('/') }}" style="font-weight: 700; color: #111827;">🥔 Potato-Site</a>
    </header>

    <main class="reader-container">
        <div class="book-subtitle">{{ $book->title }} — Chapter {{ $chapter->order_number }}</div>
        <h1 class="chapter-title">{{ $chapter->title }}</h1>

        <article class="chapter-content">
            {!! $chapter->content !!}
        </article>

        <nav class="chapter-navigation">
            @if($previousChapter)
                <a href="{{ route('reader.chapter', [$book->slug, $previousChapter->slug]) }}" class="nav-btn">
                    ← Chapter {{ $previousChapter->order_number }}: {{ $previousChapter->title }}
                </a>
            @else
                <div></div>
            @endif

            @if($nextChapter)
                <a href="{{ route('reader.chapter', [$book->slug, $nextChapter->slug]) }}" class="nav-btn">
                    Chapter {{ $nextChapter->order_number }}: {{ $nextChapter->title }} →
                </a>
            @endif
        </nav>
    </main>

</body>
</html>