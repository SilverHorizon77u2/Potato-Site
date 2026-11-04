<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard · Potato-Site</title>
    <style>
        /* --- sidebar-layout.css styles --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #faf8f5;
            color: #1f2937;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            min-height: 100vh;
        }

        /* Top Navbar */
        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.85rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #111827;
        }

        .user-profile-pill {
            background-color: #f3f4f6;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
        }

        /* Main Layout Grid */
        .layout-container {
            display: flex;
            min-height: calc(100vh - 57px);
        }

        /* Left Sidebar */
        .sidebar {
            width: 230px;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 2rem 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: #3b82f6;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .profile-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            width: 100%;
            background-color: #3b82f6;
            color: #ffffff;
            text-align: center;
            padding: 0.65rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            margin-bottom: 1.5rem;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        /* Sidebar Nav Links */
        .sidebar nav {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.85rem;
            color: #4b5563;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 6px;
        }

        .sidebar-link:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        .sidebar-link.active {
            color: #2563eb;
            background-color: #eff6ff;
        }

        .logout-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: #ef4444;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.65rem 0.85rem;
            cursor: pointer;
            border-radius: 6px;
        }

        .logout-btn:hover {
            background-color: #fef2f2;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            padding: 2.5rem 3rem;
        }

        .content-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .page-heading {
            font-size: 1.5rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 1.5rem;
        }

        /* --- Local dashboard custom styles --- */
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        
        .profile-card { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 1.5rem 2rem; margin-bottom: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.03); }
        .card-title { font-size: 1.15rem; font-weight: 700; color: #111827; margin-bottom: 0.25rem; }
        .card-desc { font-size: 0.875rem; color: #6b7280; margin-bottom: 1.25rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.35rem; }
        .form-input { width: 100%; max-width: 400px; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; outline: none; }
        .btn-save { background-color: #2563eb; color: #ffffff; border: none; padding: 0.5rem 1.25rem; border-radius: 6px; font-weight: 600; cursor: pointer; }
        .btn-danger { background-color: #ef4444; color: #ffffff; border: none; padding: 0.5rem 1.25rem; border-radius: 6px; font-weight: 600; cursor: pointer; }
        .status-msg { color: #16a34a; font-size: 0.85rem; font-weight: 600; margin-left: 0.75rem; }
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
        <!-- Sidebar Navigation (Trigger Tabs) -->
        <aside class="sidebar">
            <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="profile-name">{{ auth()->user()->name }}</div>

            <a href="{{ route('books.create') }}" class="btn-primary">+ Start New Book</a>

            <nav>
                <button onclick="switchTab('dashboard')" id="btn-dashboard" class="sidebar-link {{ !isset($activeBook) ? 'active' : '' }}" style="width: 100%; background: none; border: none; text-align: left; cursor: pointer;">
                    Dashboard
                </button>
                <button onclick="switchTab('books')" id="btn-books" class="sidebar-link" style="width: 100%; background: none; border: none; text-align: left; cursor: pointer;">
                    My Books
                </button>
                <button onclick="switchTab('profile')" id="btn-profile" class="sidebar-link" style="width: 100%; background: none; border: none; text-align: left; cursor: pointer;">
                    Profile
                </button>

                <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem; width: 100%;">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="main-content">
            <div class="content-wrapper">

                <!-- TAB 1: DASHBOARD -->
                <div id="tab-dashboard" class="tab-content {{ !isset($activeBook) ? 'active' : '' }}">
                    <h1 class="page-heading">Dashboard Overview</h1>
                    <p style="color: #6b7280; margin-bottom: 1.5rem;">Welcome back! Here are your most recent books.</p>
                    
                    @include('partials.books-list', ['books' => $books->take(5)])
                </div>

                <!-- TAB 2: MY BOOKS (Full list view) -->
                <div id="tab-books" class="tab-content">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h1 class="page-heading" style="margin-bottom: 0;">All My Books</h1>
                        <a href="{{ route('books.create') }}" class="btn-primary" style="width: auto; padding: 0.5rem 1rem; margin-bottom: 0;">+ Create New Book</a>
                    </div>

                    @include('partials.books-list', ['books' => $books])
                </div>

                <!-- TAB 4: MANAGE SINGLE BOOK -->
                <div id="tab-manage-book" class="tab-content {{ isset($activeBook) ? 'active' : '' }}">
                    @if(isset($activeBook))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.querySelectorAll('.sidebar nav button, .sidebar nav a').forEach(el => el.classList.remove('active'));
                                document.getElementById('btn-books').classList.add('active');
                            });
                        </script>

                        <div class="book-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                            <div>
                                <h1 class="book-title" style="font-size: 2rem; font-weight: 800; color: #111827; margin-bottom: 0.25rem;">{{ $activeBook->title }}</h1>
                                <p class="book-desc" style="font-size: 1rem; color: #6b7280;">{{ $activeBook->description ?? 'No description provided.' }}</p>
                            </div>
                            <a href="{{ route('chapters.create', $activeBook) }}" class="btn-primary" style="width: auto; padding: 0.6rem 1.25rem;">+ Write Chapter</a>
                        </div>

                        <h2 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">Chapters</h2>

                        @if($activeBook->chapters->isEmpty())
                            <div class="chapter-card" style="justify-content: center; color: #6b7280; padding: 2rem; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px;">
                                No chapters written yet.
                            </div>
                        @else
                            @foreach($activeBook->chapters as $index => $chapter)
                                <div class="chapter-card" style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem 1.25rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <span class="chapter-title" style="font-size: 1rem; font-weight: 700; color: #111827;">Chapter {{ $index + 1 }}: {{ $chapter->title }}</span>
                                        <span class="status-badge" style="margin-bottom: 0;">{{ $chapter->status ?? 'published' }}</span>
                                    </div>
                                    <div class="chapter-actions" style="display: flex; gap: 1rem;">
                                        <a href="{{ route('chapters.show', [$activeBook, $chapter]) }}" class="link-action" style="font-size: 0.875rem; font-weight: 600; color: #2563eb; text-decoration: none;">View</a>
                                        <a href="{{ route('chapters.edit', [$activeBook, $chapter]) }}" class="link-action" style="font-size: 0.875rem; font-weight: 600; color: #2563eb; text-decoration: none;">Edit</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div>

                <!-- TAB 3: PROFILE SETTINGS -->
                <div id="tab-profile" class="tab-content">
                    <h1 class="page-heading">Profile Settings</h1>

                    <!-- Profile Info Form -->
                    <div class="profile-card">
                        <h2 class="card-title">Profile Information</h2>
                        <p class="card-desc">Update your account's profile information and email address.</p>
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf @method('patch')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" class="form-input" value="{{ old('name', auth()->user()->name) }}" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-input" value="{{ old('email', auth()->user()->email) }}" required />
                            </div>
                            <button type="submit" class="btn-save">Save</button>
                            @if (session('status') === 'profile-updated')
                                <span class="status-msg">Saved.</span>
                            @endif
                        </form>
                    </div>

                    <!-- Update Password Form -->
                    <div class="profile-card">
                        <h2 class="card-title">Update Password</h2>
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf @method('put')
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input id="current_password" name="current_password" type="password" class="form-input" />
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input id="password" name="password" type="password" class="form-input" />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" />
                            </div>
                            <button type="submit" class="btn-save">Save</button>
                            @if (session('status') === 'password-updated')
                                <span class="status-msg">Saved.</span>
                            @endif
                        </form>
                    </div>

                    <!-- Delete Account Form -->
                    <div class="profile-card" style="border-color: #fca5a5;">
                        <h2 class="card-title" style="color: #991b1b;">Delete Account</h2>
                        <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('delete')
                            <button type="submit" class="btn-danger">Delete Account</button>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Instant Tab Switching Script -->
    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.sidebar nav button, .sidebar nav a').forEach(el => el.classList.remove('active'));

            document.getElementById('tab-' + tabName).classList.add('active');
            const btn = document.getElementById('btn-' + tabName);
            if (btn) btn.classList.add('active');
        }
    </script>
</body>
</html>