 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booktato</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="landing">

    <div class="background-overlay"></div>
    <header class="navbar">
        <a href="{{ url('/') }}" class="brand">📚 Booktato</a>

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
            <div class="logo">📚</div>
            <h1>Welcome to <span>Booktato</span></h1>
            <p>ChiChu ChiChu.</p>
            <a href="{{ route('register') }}" class="btn">Get Started</a>
        </section>

        <section class="features">
            <div class="feature">
                <div class="icon">⚡</div>
                <h3>Fast</h3>
                <p>O.</p>
            </div>

            <div class="feature">
                <div class="icon">🧈</div>
                <h3>Buttery Smooth</h3>
                <p>O.</p>
            </div>

            <div class="feature">
                <div class="icon">🌱</div>
                <h3>Grows on You</h3>
                <p>O.</p>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        &copy; {{ date('Y') }} Booktato. Grown with care. 📚
    </footer>

    <script>
        const backgrounds = [
            "{{ asset('images/backgrounds/Potato-1.jpg') }}",
            "{{ asset('images/backgrounds/Potato-2.jpg') }}",
            "{{ asset('images/backgrounds/Potato-3.jpg') }}",
            "{{ asset('images/backgrounds/Potato-4.jpg') }}"
        ];

        let current = 0;

        document.body.style.setProperty(
            '--bg-current',
            `url("${backgrounds[current]}")`
        );

        setInterval(() => {
            const next = (current + 1) % backgrounds.length;

            document.body.style.setProperty(
                '--bg-next',
                `url("${backgrounds[next]}")`
            );

            document.body.classList.add('fade-bg');

            setTimeout(() => {
                current = next;

                document.body.style.setProperty(
                    '--bg-current',
                    `url("${backgrounds[current]}")`
                );

                document.body.classList.remove('fade-bg');
            }, 2000);

        }, 10000);
    </script>

</body>
</html>
```
