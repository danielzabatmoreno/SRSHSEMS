<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Santa Rosa Senior High | Login</title>
  <link rel="icon" href="{{ asset('images/logos/logo.png') }}" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --primary: #043b1b;        /* Dark Green */
      --primary-dark: #0a5a1c;   /* Hover Green */
      --accent: #ffcd01;         /* Golden Yellow */
      --light: #f9f9f9;
      --dark: #2c3e50;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Noto Sans', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ffffff 0%, #043b1b 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      display: flex;
      flex-direction: row;
      max-width: 900px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      width: 100%;
    }

    /* Left Logo Panel */
    .left-panel {
      background-color: #FFF;
      padding: 40px;
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .left-panel img {
      width: 280px;
      height: auto;
    }

    /* Right Panel Form */
    .right-panel {
      flex: 1;
      padding: 40px;
      position: relative;
    }

    .right-panel h2 {
      margin-bottom: 30px;
      color: var(--primary);
      font-size: 28px;
      text-align: center;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--dark);
    }

    input {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      transition: 0.3s;
    }

    input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(4, 59, 27, 0.25);
    }

    /* Button */
    .btn {
      background-color: var(--primary);
      color: #fff;
      padding: 12px;
      border: none;
      width: 100%;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(4, 59, 27, 0.25);
      transition: all 0.3s ease;
      margin-top: 15px;
    }

    .btn:hover {
      background-color: var(--primary-dark);
      transform: scale(1.02);
      box-shadow: 0 6px 14px rgba(10, 90, 28, 0.35);
    }

    .btn:active {
      transform: scale(0.98);
    }

    /* Links */
    .links {
      display: flex;
      justify-content: space-between;
      margin-top: 16px;
      font-size: 0.9rem;
    }

    .links a {
      color: var(--primary);
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
    }

    .links a:hover {
      text-decoration: underline;
      color: var(--primary-dark);
    }

.message {
  padding: 12px 16px;
  border-radius: 6px;
  margin-bottom: 16px;
  font-size: 14px;
}

.message.success {
  background-color: #16a34a; /* green-600 */
  color: #fff;
}

.message.error {
  background-color: #dc2626; /* red-600 */
  color: #fff;
}

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      .left-panel, .right-panel {
        flex: unset;
        width: 100%;
      }
      .left-panel {
        padding: 20px;
      }
      .right-panel {
        padding: 30px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="left-panel">
      <img src="{{ asset('images/logos/logoS.png') }}" alt="School Logo" />
    </div>

    <div class="right-panel">
      <h2>Sign In</h2>

      {{-- Success or error messages --}}
      @if (session('status'))
        <div class="message success">{{ session('status') }}</div>
      @endif
      @if ($errors->any())
        <div class="message error">
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">Login</button>

        <!-- Forgot Password -->
        <div class="links">
          <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
