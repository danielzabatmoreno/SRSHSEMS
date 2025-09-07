<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strand List</title>
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
                        <h4>Strand List</h4>
                    </div>
                    <div class="row">
                    </div>       
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <nav class="navbar bg-body-light">
                                <div class="container-fluid">
                                    <form class="d-flex justify-content-between align-items-center w-100" role="search" method="GET" action="{{ route('strand.index') }}">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" name="search" 
                             placeholder="Search by Strand Name" aria-label="Search" 
                             value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">
                             <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                     </div>
                        <a href="{{ route('strand.create') }}" class="btn btn-info">
                             <i class="fa-solid fa-plus"></i>Add Strand
                        </a>
                            </form>
                                </div>
                            </nav>
                            @if(isset($strands) && count($strands) == 0)
                                    <div class="alert alert-danger m-2" style="width: 170px">
                                        No results found.
                                    </div>
                                @endif
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
                                            <th>Strand ID</th>
                                            <th>Strand Name</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($strands as $strand)
                                            <tr>
                                                <td>{{ $strand->StrandID }}</td>
                                                <td>{{ $strand->Strand_Name }}</td>
                                                <td>{{ $strand->description }}</td>
                                                <td>
                                                    <a href="{{ route('strand.edit', $strand->StrandID) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('strand.destroy', $strand->StrandID) }}" 
                                                        method="POST" 
                                                        style="display:inline">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="button" class="btn btn-outline-danger btn-sm" 
                                                              onclick="showDeleteConfirmation({{ $strand->StrandID }})">
                                                              <i class="fa-regular fa-trash-can"></i> Delete
                                                      </button>
                                                      
                                                      <div class="toast position-fixed top-0 start-50 translate-middle-x" 
                                                           style="z-index: 1000;" 
                                                           id="deleteToast{{ $strand->StrandID }}" 
                                                           role="alert" 
                                                           aria-live="assertive" 
                                                           aria-atomic="true">
                                                          <div class="toast-body">
                                                              Are you sure you want to delete this Strand?
                                                              <div class="mt-2 pt-2 border-top">
                                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancel</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      
                                                      <script>
                                                          function showDeleteConfirmation(id) {
                                                              const toast = new bootstrap.Toast(document.getElementById('deleteToast' + id));
                                                              toast.show();
                                                          }
                                                      </script>
                                                      
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
                {{ $strands->appends(['search' => request('search')])->links() }}
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
