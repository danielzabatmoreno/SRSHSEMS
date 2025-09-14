<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        /* Sidebar container */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100%;
            background: #343a40; /* dark */
            color: #fff;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        /* Logo */
        .sidebar-logo img {
            display: block;
            margin: 0 auto 20px auto;
            width: 150px;
        }

        /* Nav items */
        .sidebar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
            flex-grow: 1;
        }

        .sidebar-link {
            display: block;
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: #0d6efd;
            color: #fff;
            border-radius: 6px;
        }

        /* Bottom user section */
        .sidebar-bottom {
            padding: 15px;
            background: #212529;
            text-align: center;
            font-size: 14px;
        }

        /* Main content */
        .main-content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logos/logos.png') }}" alt="SR">
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('student.dashboard') }}" 
                   class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                   <i class="fa-solid fa-list pe-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                   <i class="bi bi-calendar-check pe-2"></i> My Schedule
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-book pe-2"></i> My Subjects
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-user-tie pe-2"></i> My Teachers
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-layer-group pe-2"></i> My Section
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            Logged in as: <br>
            <strong>{{ auth()->user()->name }}</strong>
        </div>
    </aside>

    <!-- Main content -->
    <div class="main-content">
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>This is your Student Dashboard content area.</p>
    </div>

</body>
</html>
