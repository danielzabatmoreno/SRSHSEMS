<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Full Logo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Full Logo Style */
        .logo-full {
            height: 70px;        /* adjust size ng logo */
            width: auto;         /* para proportion */
            object-fit: contain; /* hindi distorted */
            display: block;      /* stable alignment */
        }

        /* Optional: hover effect */
        .logo-full:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand px-3 border-bottom bg-light">
        <button class="btn" id="sidebar-toggle" type="button">
            <span class=""></span>
        </button>
        <div class="navbar-collapse navbar">
            <ul class="navbar-nav">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                    <img src="{{ asset('images/logos/logos.png') }}" 
                         class="logo-full" 
                         alt="Logo">
                </a>
            </ul>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
