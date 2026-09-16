<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Potato-Site</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="landing">

    <header class="navbar">
        <a href="{{ url('/') }}" class="brand">🥔 Potato-Site</a>

        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-small">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main>
        <section class="hero">
            <div class="logo">🥔</div>
            <h1>Welcome to <span>Potato-Site</span></h1>
            <p>Your brand-new Laravel application — humble on the outside, powerful on the inside.</p>
            <a href="{{ route('register') }}" class="btn">Get Started</a>
        </section>

        <section class="features">
            <div class="feature">
                <div class="icon">⚡</div>
                <h3>Fast</h3>
                <p>Built on Laravel for a snappy experience.</p>
            </div>
            <div class="feature">
                <div class="icon">🧈</div>
                <h3>Buttery Smooth</h3>
                <p>Clean, hand-written CSS. No frameworks.</p>
            </div>
            <div class="feature">
                <div class="icon">🌱</div>
                <h3>Grows on You</h3>
                <p>A solid foundation for whatever you build next.</p>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        &copy; {{ date('Y') }} Potato-Site. Grown with care. 🥔
    </footer>

</body>
</html>