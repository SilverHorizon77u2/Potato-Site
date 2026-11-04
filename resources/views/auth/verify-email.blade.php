<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email · Potato-Site</title>
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

        .card > p {
            color: #78350f;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
            text-align: center;
        }

        .status {
            background: #f0fdf4;
            color: #166534;
            font-size: 14px;
            padding: 10px 12px;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            margin-bottom: 16px;
            text-align: center;
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

        .logout-form {
            display: inline;
        }

        .logout-form button {
            background: none;
            border: none;
            color: #b45309;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            padding: 0;
            text-decoration: none;
        }

        .logout-form button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-header">
            <div class="logo">🥔</div>
            <h1>Verify Your Email</h1>
            <p>Please verify your email address to continue</p>
        </div>

        <p>
            {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="status">
                {{ __('A new verification link has been sent to your email address.') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="btn">
                Resend Verification Email
            </button>
        </form>

        <div class="footer-link">
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit">
                    Log Out
                </button>
            </form>
        </div>
    </div>

</body>
</html>