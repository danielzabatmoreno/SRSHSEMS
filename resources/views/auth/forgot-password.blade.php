<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Forgot Password | SRSHS Enrollment System</title>
    <link rel="icon" href="{{ asset('images/logos/logo.png') }}" type="image/png">
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #043b1b 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #043b1b;
            margin-bottom: 1.5rem;
        }

        input[type="email"] {
            width: 90%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
        }

        button {
            background-color: #043b1b;
            border: none;
            color: white;
            padding: 1rem 0;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 6px 12px rgba(4, 59, 27, 0.3);
        }

        button:hover {
            background-color: #0a5a1c;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(4, 59, 27, 0.45);
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.9rem;
            border-radius: 8px;
            font-size: 0.9rem;
            text-align: left;
        }

        .message.success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-left: 5px solid #2e7d32;
        }

        .message.error {
            background-color: #fbe9e7;
            color: #c62828;
            border-left: 5px solid #c62828;
        }

        a {
            display: inline-block;
            margin-top: 1rem;
            color: #043b1b;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
            color: #0a5a1c;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Forgot Password</h1>

        {{-- Show success or error messages --}}
        @if (session('status'))
            <div class="message success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="message error">
                <ul style="margin:0; padding-left:1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Enter your registered email" required
                autocomplete="email" />
            <button type="submit">Send OTP</button>
        </form>

        <a href="{{ route('login') }}">Back to Login</a>
    </div>
</body>

</html>
