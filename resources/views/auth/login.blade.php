<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in · BookTako</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="login-page">

    <video class="background-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/Potato-1.mp4') }}" type="video/mp4">
    </video>

    <div class="login-panel-wrap">

        <div class="login-panel">

            <div class="card">
                <div class="card-header">
                    <div class="logo">📚</div>
                    <h1>Welcome back</h1>
                    <p>Log in to BookTako</p>
                </div>

                @if (session('status'))
                    <p class="status">{{ session('status') }}</p>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required>
                        @error('password')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="remember-row">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    <button type="submit" class="btn">Log in</button>
                </form>

                <p class="footer-link">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                        &nbsp;·&nbsp;
                    @endif
                    No account? <a href="{{ route('register') }}">Register</a>
                </p>
            </div>

        </div>

    </div>

</body>
</html>