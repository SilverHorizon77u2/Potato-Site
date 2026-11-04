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