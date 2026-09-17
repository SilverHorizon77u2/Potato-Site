<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Verify Email · Potato-Site</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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

        <p class="footer-link">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    Log Out
                </button>
            </form>
        </p>
    </div>

</body>
</html>
