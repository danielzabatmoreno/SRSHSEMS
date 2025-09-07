<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRSHS Dashboard</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logos/logos.png') }}" type="image/png">

    <style>
        body {
            background-color: #f8f9fa;
            color: #2c3e50;
        }

        .card {
            border-radius: 12px;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-container {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .card-img-container img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        /* Charts same height */
        .chart-container {
            height: 320px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        canvas {
            max-height: 280px !important;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main">
            @include('layouts.navbar')

            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-4">
                        <h3 class="fw-bold">Academic Head Dashboard</h3>
                    </div>

                    <!-- Summary Totals -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm border-0 text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-users fa-2x text-primary mb-2"></i>
                                    <h6 class="fw-bold">Total Students</h6>
                                    <span class="h4 text-dark">{{ $totalStudents }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm border-0 text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-chalkboard-teacher fa-2x text-success mb-2"></i>
                                    <h6 class="fw-bold">Total Teachers</h6>
                                    <span class="h4 text-dark">{{ $totalTeachers }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm border-0 text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-user-check fa-2x text-info mb-2"></i>
                                    <h6 class="fw-bold">Total Students Enrolled</h6>
                                    <span class="h4 text-dark">{{ $totalEnrolled }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm border-0 text-center">
                                <div class="card-body">
                                    <i class="fa-solid fa-layer-group fa-2x text-danger mb-2"></i>
                                    <h6 class="fw-bold">Total Sections</h6>
                                    <span class="h4 text-dark">{{ $totalSection }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cards for Strands -->
                    <div class="row justify-content-around">
                        <!-- STEM -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-img-container">
                                    <img src="{{ asset('images/logos/stem.jpg') }}" alt="STEM">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Total STEM Students</h5>
                                    <p class="card-text">
                                        <span class="h3 text-primary">{{ $stemCount }}</span><br>
                                        <small class="text-muted">Currently Enrolled</small>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- ABM -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-img-container">
                                    <img src="{{ asset('images/logos/abm.jpg') }}" alt="ABM">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Total ABM Students</h5>
                                    <p class="card-text">
                                        <span class="h3 text-success">{{ $abmCount }}</span><br>
                                        <small class="text-muted">Currently Enrolled</small>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- HUMSS -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-img-container">
                                    <img src="{{ asset('images/logos/humss.jpg') }}" alt="HUMSS">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Total HUMSS Students</h5>
                                    <p class="card-text">
                                        <span class="h3 text-danger">{{ $humssCount }}</span><br>
                                        <small class="text-muted">Currently Enrolled</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="row mt-4">
                        <!-- Strand Chart -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-primary text-white fw-bold">Enrollment per Strand</div>
                                <div class="card-body chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Enrollment Status -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-warning text-dark fw-bold">Enrollment Status</div>
                                <div class="card-body chart-container">
                                    <canvas id="statusChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Gender Chart -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-info text-white fw-bold">Gender Distribution</div>
                                <div class="card-body chart-container">
                                    <canvas id="genderChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title fw-bold">Senior High School Enrollment System</h5>
                            <h6 class="card-subtitle text-muted">
                                This enrollment system in the Senior High School department (SRSHS).
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Group Members</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Task</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Daniel</td>
                                        <td>Moreno</td>
                                        <td>Full Stack Developer</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.footer')
        </div>
    </div>

    <!-- Bootstrap & Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const stemCount = {{ $stemCount }};
        const abmCount = {{ $abmCount }};
        const humssCount = {{ $humssCount }};
        const totalBoys = {{ $totalBoys }};
        const totalGirls = {{ $totalGirls }};
        const pendingCount = {{ $pendingCount }};
        const approvedCount = {{ $approvedCount }};
        const rejectedCount = {{ $rejectedCount }};

        // Bar Chart (Strands)
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['STEM', 'ABM', 'HUMSS'],
                datasets: [{
                    label: 'Students',
                    data: [stemCount, abmCount, humssCount],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Doughnut Chart (Enrollment Status)
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    data: [pendingCount, approvedCount, rejectedCount],
                    backgroundColor: ['#f1c40f', '#2ecc71', '#e74c3c']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Pie Chart (Gender Distribution)
        new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: ['Boys', 'Girls'],
                datasets: [{
                    data: [totalBoys, totalGirls],
                    backgroundColor: ['#3498db', '#e74c3c']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
</body>
</html>
