<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css?v=2">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/Um logo.png') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Sidebar -->
        <div class="main">
            <!-- Navbar -->
            @include('layouts.navbar')
            <!-- Navbar -->

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Room List</h4>
                    </div>
                    <div class="row">
                    </div>       
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <div class="navbar bg-body-light">
                                <div class="container-fluid">
                                    <form class="d-flex justify-content-between align-items-center w-100" role="search" method="GET" action="{{ route('room.index') }}">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" name="search" 
                             placeholder="Search by Room Number or Building" aria-label="Search" 
                             value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">
                             <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                     </div>
                        <a href="{{ route('room.create') }}" class="btn btn-info">
                             <i class="fa-solid fa-plus"></i>Add Room
                        </a>
                            </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Room ID</th>
                                            <th>Room Number</th>
                                            <th>Building</th>
                                            <th>Floor</th>
                                            <th>Type</th>
                                            <th>Strand</th>
                                            <th>Grade Level</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rooms as $room)
                                            <tr>
                                                <td>{{ $room->RoomID }}</td>
                                                <td>{{ $room->Room_Number }}</td>
                                                <td>{{ $room->Building }}</td>
                                                <td>{{ $room->Floor }}</td>
                                                <td>{{ $room->Room_Type }}</td>
                                                <td>{{$room->Strand->Strand_Name}}</td>
                                                <td>{{ $room->Grade_Level }}</td>
                                                <td>{{ $room->Capacity }}</td>
                                                <td>
                                                    <span class="badge {{ $room->is_available ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $room->is_available ? 'Available' : 'In Use' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('room.edit', $room->RoomID) }}" 
                                                      class="btn btn-outline-primary btn-sm">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('room.destroy', $room->RoomID) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this room?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fa-regular fa-trash-can"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <div class="d-flex justify-content-center mt-4">
                {{ $rooms->appends(['search' => request('search')])->links() }}
            </div>

            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <!-- Footer -->
            @include('layouts.footer')
            <!-- Footer -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
