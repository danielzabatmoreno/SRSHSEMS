<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Enrollment System') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2e0e9a4e3.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background: #043b1b;
            padding: 10px 20px;
            color: #fff;
        }
        .navbar a {
            color: #fff;
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .carousel-container {
            position: relative;
            max-width: 900px;
            margin: 40px auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .carousel-slide img {
            width: 100%;
            border-radius: 10px;
        }
        .register-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 18px;
            background-color: #043b1b;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
        .register-btn:hover {
            background-color: #065f2d;
        }
    </style>
</head>
<body>
    <nav class="navbar d-flex justify-content-between align-items-center">
        <div class="navbar-brand">Enrollment System</div>
        <div class="navbar-links">
            <a href="{{ route('login') }}">Login</a>
        </div>
    </nav>

    <main class="container text-center py-5">
        @yield('content')
    </main>
</body>
</html>
