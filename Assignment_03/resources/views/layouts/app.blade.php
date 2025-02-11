<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
     <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>
<body>
    <div class="container bg-light">
       <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <!-- Majors Nav Item -->
              <li class="nav-item {{ request()->routeIs('majors*') ? 'active-nav' : '' }}">
              <a class="nav-link" href="{{ route('majors.index') }}">Majors</a>
               </li>
              
              <!-- Students Nav Item -->
              <li class="nav-item {{ request()->routeIs('students*') ? 'active-nav' : '' }}">
                <a class="nav-link" href="{{ route('students.index') }}">Students</a>
            </li>
            </ul>
          </div>
        </nav>
    </div>

    @yield('content') <!-- Content Section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/major/delete.js') }}"></script>
    <script src="{{ asset('js/student/delete.js') }}"></script>
</body>
</html>
