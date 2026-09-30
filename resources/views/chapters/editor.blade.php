<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($chapter) ? 'Edit Chapter' : 'New Chapter' }} · {{ $book->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    
    <!-- Quill WYSIWYG Editor Styles and Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <style>
        body { 
            background-color: #fff; 
            color: #1a1a1a; 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; 
        }
        .editor-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
        }
        .editor-container {
            max-width: 680px;
            margin: 2.5rem auto;
            padding: 0 1rem;
        }
        .editor-title-input {
            width: 100%;
            font-size: 2.25rem;
            font-weight: 700;
            border: none;
            outline: none;
            margin-bottom: 1rem;
            color: #111;
            padding: 0.5rem 0;
        }
        .editor-title-input::placeholder { color: #9ca3af; }
        
        /* Substack-style Quill Editor Overrides */
        .ql-toolbar.ql-snow {
            border: 1px solid #e5e7eb !important;
            border-radius: 8px 8px 0 0;
            background: #f9fafb;
            position: sticky;
            top: 4.2rem;
            z-index: 5;
        }
        .ql-container.ql-snow {
            border: 1px solid #e5e7eb !important;
            border-top: none !important;
            border-radius: 0 0 8px 8px;
            min-height: 400px;
            font-size: 1.125rem;
            line-height: 1.8;
        }
        .ql-editor {
            min-height: 400px;
            padding: 1.25rem;
        }
        .ql-editor.ql-blank::before {
            color: #9ca3af;
            font-style: normal;
        }

        .btn-group { display: flex; gap: 0.5rem; }
        .btn-secondary {
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #ff6b35;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <form id="chapter-form" method="POST" action="{{ isset($chapter) ? route('chapters.update', [$book, $chapter]) : route('chapters.store', $book) }}">
        @csrf
        @if(isset($chapter))
            @method('PUT')
        @endif

        <header class="editor-navbar">
            <div>
                <a href="{{ route('books.show', $book) }}" style="text-decoration: none; color: #4b5563; font-weight: 500;">← Back to {{ $book->title }}</a>
            </div>
            <div class="btn-group">
                <button type="submit" name="action" value="draft" class="btn-secondary">Save Draft</button>
                <button type="submit" name="action" value="publish" class="btn-primary">Publish Chapter</button>
            </div>
        </header>

        <main class="editor-container">
            <input 
                type="text" 
                name="title" 
                class="editor-title-input" 
                placeholder="Chapter Title" 
                value="{{ old('title', $chapter->title ?? '') }}" 
                required 
                autofocus
            >

            <!-- Quill Editor Surface -->
            <div id="quill-editor">{!! old('content', $chapter->content ?? '') !!}</div>

            <!-- Hidden Input Submitted to Laravel -->
            <input type="hidden" name="content" id="hidden-content">
        </main>
    </form>

    <script>
        // Initialize Quill
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Tell your story...',
            modules: {
                toolbar: [
                    [{ 'header': [2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'clean']
                ]
            }
        });

        // Sync Quill HTML content to hidden input prior to form submission
        document.getElementById('chapter-form').addEventListener('submit', function () {
            document.getElementById('hidden-content').value = quill.getSemanticHTML();
        });
    </script>

</body>
</html>