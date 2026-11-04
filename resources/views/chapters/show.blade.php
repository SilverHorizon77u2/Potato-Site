<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $chapter->title }} · {{ $book->title }} · Potato-Site</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar-layout.css') }}">
    <style>
        .chapter-container {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 2.5rem;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .chapter-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .chapter-meta {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        .chapter-heading {
            font-size: 2rem;
            font-weight: 800;
            color: #111827;
        }
        .chapter-body {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #374151;
            white-space: pre-wrap; /* Preserves paragraph formatting/line breaks */
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 600;
            color: #2563eb;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }
        .back-link:hover {
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

    <div class="layout-container" style="display: block; padding: 2rem;">
        <main style="max-width: 900px; margin: 0 auto;">
            
            <a href="{{ route('books.show', $book) }}" class="back-link">
                &larr; Back to {{ $book->title }}
            </a>

            <div class="chapter-container">
                <div class="chapter-header">
                    <div class="chapter-meta">
                        Book: <strong>{{ $book->title }}</strong> · Status: <span class="status-badge" style="display: inline-block; margin-bottom: 0;">{{ $chapter->status ?? 'published' }}</span>
                    </div>
                    <h1 class="chapter-heading">{{ $chapter->title }}</h1>
                </div>

                <div class="chapter-body">
                    {{-- Assumes your chapter content column is named 'content' or 'body' --}}
                    {{ $chapter->content ?? $chapter->body ?? 'No content written for this chapter yet.' }}
                </div>
            </div>

        </main>
    </div>

</body>
</html>