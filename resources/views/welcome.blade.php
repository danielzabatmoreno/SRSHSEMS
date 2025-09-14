<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['public/styles/landingPage.css'])
  <link rel="icon" href="{{ asset('images/logos/logos.png') }}" type="image/png">
  <title>Landing Page</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <a href="/" class="navbar-logo">
      <img src="{{ asset('images/logos/logo.png') }}" alt="Logo">
      <span class="navbar-text">SRSHS Enrollment System</span>
    </a>

    <button class="navbar-toggle" onclick="toggleMenu()">☰</button>

    <div class="navbar-links" id="navbarMenu">
      @if (Auth::check())
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
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

  <!-- Main -->
  <main>
    <div class="carousel-container">
      <div class="carousel-slide">
        <img src="{{ asset('images/carousel/test1.png') }}" alt="Image 1" class="carousel-image">
      </div>
      <button class="carousel-button left" onclick="prevSlide()">&#10094;</button>
      <button class="carousel-button right" onclick="nextSlide()">&#10095;</button>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-logo-section">
        <a href="/"><img src="{{ asset('images/logos/logos.png') }}" alt="Srshs Logo" class="footer-logo-img"></a>
        <div class="footer-text">
          <a href="/">
            <h3>SANTA-ROSA SENIOR HIGH SCHOOL</h3>
          </a>
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

  <script>
    function toggleMenu() {
      document.getElementById('navbarMenu').classList.toggle('active');
    }
  </script>
  <script src="{{ asset('scripts/landingPage/index.js') }}"></script>
</body>
</html>
