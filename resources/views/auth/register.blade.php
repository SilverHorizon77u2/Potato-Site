<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register · BookTako</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fffbeb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 384px;
            padding: 32px;
            border: 1px solid #fef3c7;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .logo {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .card-header h1 {
            color: #451a03;
            font-size: 24px;
            font-weight: bold;
        }

        .card-header p {
            color: rgba(146, 64, 14, 0.7);
            font-size: 14px;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            color: #451a03;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #fde68a;
            border-radius: 8px;
            font-size: 14px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.4);
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 4px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #d97706;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .btn:hover {
            background: #b45309;
        }

        .footer-link {
            text-align: center;
            font-size: 14px;
            color: rgba(146, 64, 14, 0.7);
            margin-top: 24px;
        }

        .footer-link a {
            color: #b45309;
            font-weight: 500;
        }

        body.login-page {
            margin: 0;
            min-height: 100vh;
            overflow: hidden;
            background: #ffffff;
        }

        .background-video {
            position: fixed;
            top: 0;
            left: 13%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .login-panel-wrap {
            position: absolute;
            left: 0%;
            width: 50%;
            height: 100vh;
            filter: drop-shadow(20px 0 18px rgba(0, 0, 0, 0.35));
        }

        .login-panel {
            position: relative;
            width: 80%;
            height: 100%;
            background: #ffffff;
            clip-path: polygon(0 0, 100% 0, 82% 100%, 0 100%);
        }

        .login-panel .card {
            position: absolute;
            left: 6%;
            top: 50%;
            transform: translateY(-50%);
            width: 360px;
            max-width: 360px;
            padding: 0;
            margin: 0;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .login-panel .card-header .logo {
            font-size: 32px;
        }

        .login-panel .card-header h1 {
            font-size: 28px;
        }

        .login-panel .card-header p {
            font-size: 14px;
        }

        .login-panel .form-group {
            margin-bottom: 16px;
        }

        .login-panel input[type="text"],
        .login-panel input[type="email"],
        .login-panel input[type="password"] {
            height: 42px;
        }

        .login-panel .btn {
            height: 46px;
            font-size: 16px;
        }
        @media (max-width: 768px) {
            .login-panel-wrap {
                position: relative;
                width: 100%;
                height: 100vh;
                left: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                filter: none;
            }

            .login-panel {
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.95); /* Slight transparency so video shows softly behind it */
                clip-path: none !important; /* Removes the diagonal cut on mobile */
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-panel .card {
                position: relative;
                left: auto;
                top: auto;
                transform: none;
                width: 90%;
                max-width: 380px;
                background: #ffffff;
                border: 1px solid #fef3c7;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                padding: 24px;
            }

            .background-video {
                left: 0 !important;
                width: 100% !important;
            }
        }
    </style>
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
                    <p>Join BookTako</p>
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