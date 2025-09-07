<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logos/logos.png') }}" type="image/png">
    <title>Landing Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Sans', Arial, sans-serif;
        }

        main {
            min-height: 100vh;
            padding-top: 80px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal h2 { font-size: 24px; margin-bottom: 10px; }
        .modal p { font-size: 16px; margin-bottom: 20px; }

        .modal button {
            background-color: #043b1b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal button:hover { background-color: #0a5a1c; }

        /* Navbar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #043b1b;
            padding: 10px 40px;
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-logo img { height: 65px; margin-right: 10px; }
        .navbar-logo .navbar-text { font-size: 24px; font-weight: bold; color: #ffcd01; }

        .navbar-links {
            display: flex;
            gap: 30px;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            position: relative;
        }

        .navbar-links a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #ffcd01;
            transition: width 0.3s ease;
        }

        .navbar-links a:hover::after { width: 100%; }

        /* Carousel */
        .carousel-container {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            margin: 1rem;
        }

        .carousel-slide {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-image {
            width: 100%;
            flex-shrink: 0;
            min-height: 85vh;
        }

        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px;
        }

        .carousel-button.left { left: 10px; }
        .carousel-button.right { right: 10px; }
        .carousel-button:hover { background-color: rgba(0, 0, 0, 0.7); }

        /* Registration Button */
        .register-btn {
            display: inline-block;
            background-color: #043b1b;
            color: #fff;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .register-btn:hover { background-color: #0a5a1c; }

        /* Footer */
        .footer {
            background-color: #043b1b;
            color: #fff;
            font-size: 12px;
            margin-top: 10px;
            position: relative;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            padding: 3rem;
        }

        .footer-logo-section { display: flex; align-items: center; gap: 15px; max-width: 45%; }
        .footer-logo-img { width: 120px; }
        .footer-text h3 { color: #ffcd01; font-size: 16px; margin: 0; }

        .footer-links-section { display: flex; gap: 50px; }
        .footer-contact h4 { color: #ffcd01; font-size: 15px; margin-bottom: 5px; }

        .copyright-text-container {
            padding: 2em;
            text-align: center;
            background-color: #131313;
        }

        .withImg { display: inline-flex; align-items: center; gap: 5px; }
        .withImg a { color: #ffcd01; text-decoration: none; }
        .withImg a:hover { text-decoration: underline; }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="navbar-logo">
            <img src="{{ asset('images/logos/logo.png') }}" alt="Logo">
            <span class="navbar-text">SRSHS Enrollment System</span>
        </a>

        <div class="navbar-links">
            @if (Auth::check())
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
            @else
                <a href="{{ route('login') }}">Log In</a>
                <a href="{{ route('student_register.form') }}"
           class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition">
            Enroll  
        </a>
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="{{ asset('images/carousel/test1.png') }}" alt="Image 1" class="carousel-image">
            </div>
            <button class="carousel-button left" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-button right" onclick="nextSlide()">&#10095;</button>
        </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo-section">
                <a href="/"><img src="{{ asset('images/logos/logo.png') }}" alt="Srshs Logo" class="footer-logo-img"></a>
                <div class="footer-text">
                    <a href="/"><h3>SANTA-ROSA SENIOR HIGH SCHOOL</h3></a>
                    <p>Santa Rosa City</p>
                    <p>T. Curato St., Brgy. 11, Cabadbaran City, Agusan del Norte, Philippines 8605</p>
                    <p>Phone: (085) 818-5538</p>
                    <p>Email: chancellorsoffice@csucc.edu.ph</p>
                </div>
            </div>

            <div class="footer-links-section">
                <div class="footer-contact">
                    <h4>ADMISSION</h4>
                    <p>Email: oasfa@csucc.edu.ph</p>
                    <p>Phone: 0917-7046962</p>
                </div>
                <div class="footer-contact">
                    <h4>REGISTRAR</h4>
                    <p>Email: registrar@csucc.edu.ph</p>
                    <p>Phone: (085) 818-7459</p>
                    <p>Mobile: 0928-4990100</p>
                </div>
                <div class="footer-contact">
                    <h4>GUIDANCE & COUNSELING CENTER</h4>
                    <p>Email: gcc@csucc.edu.ph</p>
                    <p>Phone: 09463451960</p>
                </div>
            </div>
        </div>

        <div class="copyright-text-container">
            <p>Copyright &copy; 2025</p>
            <span class="withImg">
                <img src="{{ asset('images/logos/logo.png') }}" alt="University Logo" style="max-width: 2em;">
                <a href="/">Santa Rosa Senior High School</a>
                <p>All Rights Reserved.</p>
            </span>
        </div>
    </footer>

    <!-- Modals -->
    @if (session('success'))
        <div id="successModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h2>Success</h2>
                <p>{{ session('success') }}</p>
                <button onclick="closeModal('successModal')">Close</button>
            </div>
        </div>
    @endif

    @if (session('failed'))
        <div id="failedModal" class="modal">
            <div class="modal-content">
                <h2>Error</h2>
                @if (is_array(session('failed')))
                    <ul>
                        @foreach (session('failed') as $field => $errors)
                            @foreach ($errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                @endif
                <button onclick="closeModal('failedModal')">Close</button>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successModal = document.getElementById('successModal');
            const failedModal = document.getElementById('failedModal');
            if (successModal) successModal.style.display = 'flex';
            if (failedModal) failedModal.style.display = 'flex';
        });

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.style.display = 'none';
        }
    </script>
    <script src="{{ asset('scripts/landingPage/index.js') }}"></script>
</body>
</html>
