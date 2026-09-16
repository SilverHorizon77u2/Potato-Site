<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard · Potato-Site</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="dashboard">

    <header class="dashboard-navbar">
        <a href="{{ url('/') }}" class="brand">🥔 Potato-Site</a>

        <div class="user-menu">
            <span>{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Log Out</button>
            </form>
        </div>
    </header>

    <div class="dashboard-layout">

        <aside class="sidebar">
            <nav>
                <a href="{{ url('/dashboard') }}" class="active">Dashboard</a>
            </nav>
        </aside>

        <main class="dashboard-main">

            <div class="dashboard-header">
                <div>
                    <h1>Dashboard</h1>
                    <p>Welcome back, {{ Auth::user()->name }}.</p>
                </div>
            </div>

            <section class="dashboard-content">
                <div class="empty-state">
                    <div class="empty-icon">🥔</div>
                    <h2>Nothing here yet</h2>
                    <p>Your dashboard is ready for something awesome.</p>
                </div>
            </section>

        </main>

    </div>

</body>
</html>
