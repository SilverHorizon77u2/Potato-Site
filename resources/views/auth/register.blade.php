<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register · Booktato</title>
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
                    <h1>Create account</h1>
                    <p>Join Booktato</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
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

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn">Register</button>
                </form>

                <p class="footer-link">
                    Already registered?
                    <a href="{{ route('login') }}">Log in</a>
                </p>
            </div>

        </div>

    </div>

</body>
</html>