<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Password · Potato-Site</title>
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
            text-decoration: none;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-header">
            <div class="logo">🥔</div>
            <h1>Confirm Password</h1>
            <p>Please confirm your password to continue</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    autofocus
                >

                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">
                Confirm
            </button>
        </form>

        <p class="footer-link">
            <a href="{{ url('/') }}">Back to Home</a>
        </p>
    </div>

</body>
</html>