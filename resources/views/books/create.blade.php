<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create New Book · Potato-Site</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        .form-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        .form-control {
            width: 100%;
            padding: 0.625rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .btn-submit {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 0.625rem 1.25rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-cancel {
            text-decoration: none;
            color: #4b5563;
            margin-left: 1rem;
            font-size: 0.95rem;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="dashboard">

    <header class="dashboard-navbar">
        <a href="{{ url('/') }}" class="brand">🥔 Potato-Site</a>
    </header>

    <main class="form-container">
        <h1 style="margin-bottom: 0.5rem; font-size: 1.75rem;">Start a New Book</h1>
        <p style="color: #6b7280; margin-bottom: 2rem;">Fill in the details below to begin writing your story.</p>

        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Book Title -->
            <div class="form-group">
                <label for="title">Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="form-control" 
                    placeholder="Enter book title..." 
                    value="{{ old('title') }}" 
                    required 
                    autofocus
                >
                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Synopsis / Description -->
            <div class="form-group">
                <label for="synopsis">Synopsis / Summary</label>
                <textarea 
                    id="synopsis" 
                    name="synopsis" 
                    class="form-control" 
                    rows="5" 
                    placeholder="What is your book about?..."
                >{{ old('synopsis') }}</textarea>
                @error('synopsis')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cover Image Upload -->
            <div class="form-group">
                <label for="cover_image">Cover Image (Optional)</label>
                <input 
                    type="file" 
                    id="cover_image" 
                    name="cover_image" 
                    class="form-control" 
                    accept="image/*"
                >
                @error('cover_image')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; align-items: center; margin-top: 2rem;">
                <button type="submit" class="btn-submit">Create Book</button>
                <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </main>

</body>
</html>