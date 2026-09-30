<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings · Potato-Site</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar-layout.css') }}">
    <style>
        .profile-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1.5rem 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        }
        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.25rem;
        }
        .card-desc {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 1.25rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.35rem;
        }
        .form-input {
            width: 100%;
            max-width: 400px;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            border-color: #2563eb;
        }
        .btn-save {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-save:hover {
            background-color: #1d4ed8;
        }
        .btn-danger {
            background-color: #ef4444;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-danger:hover {
            background-color: #dc2626;
        }
        .status-msg {
            color: #16a34a;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 0.75rem;
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
                <a href="{{ route('books.index') }}" class="sidebar-link">My Books</a>
                <a href="{{ route('profile.edit') }}" class="sidebar-link active">Profile</a>
                
                <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </nav>
        </aside>

        <!-- Profile Content -->
        <main class="main-content">
            <div class="content-wrapper">
                <h1 class="page-heading">Profile Settings</h1>

                <!-- Profile Info Form -->
                <div class="profile-card">
                    <h2 class="card-title">Profile Information</h2>
                    <p class="card-desc">Update your account's profile information and email address.</p>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        </div>

                        <div style="display: flex; align-items: center; margin-top: 1.25rem;">
                            <button type="submit" class="btn-save">Save</button>
                            @if (session('status') === 'profile-updated')
                                <span class="status-msg">Saved.</span>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password Form -->
                <div class="profile-card">
                    <h2 class="card-title">Update Password</h2>
                    <p class="card-desc">Ensure your account is using a long, random password to stay secure.</p>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input id="current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" name="password" type="password" class="form-input" autocomplete="new-password" />
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
                        </div>

                        <div style="display: flex; align-items: center; margin-top: 1.25rem;">
                            <button type="submit" class="btn-save">Save</button>
                            @if (session('status') === 'password-updated')
                                <span class="status-msg">Saved.</span>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Delete Account Form -->
                <div class="profile-card" style="border-color: #fca5a5;">
                    <h2 class="card-title" style="color: #991b1b;">Delete Account</h2>
                    <p class="card-desc">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

                    <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account?');">
                        @csrf
                        @method('delete')

                        <button type="submit" class="btn-danger">Delete Account</button>
                    </form>
                </div>

            </div>
        </main>
    </div>

</body>
</html>