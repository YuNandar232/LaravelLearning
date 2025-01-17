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
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
        }
        .navbar-nav .nav-item {
            margin-right: 15px;
        }
        .fa-btn {
            margin-right: 6px;
        }
        ul {
            margin-bottom: 0px;
        }
        .container {
            margin-top: 30px;
        }
        .active-nav {
            color: rgb(3, 52, 120); /* Custom text color */
            font-weight: bold; /* Optional: make the active link bold */
        }
        .active-nav:hover {
            color: #004085; /* Darker color when hovered */
        }
    </style>
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
               <li class="nav-item @if(request()->routeIs('majors.index') || request()->routeIs('majors.create') || request()->routeIs('majors.edit')) active-nav @endif">
                <a class="nav-link" href="{{ route('majors.index') }}">Majors</a>
              </li>
              
              <!-- Students Nav Item -->
              <li class="nav-item @if(request()->routeIs('students.index') || request()->routeIs('students.create') || request()->routeIs('students.edit')) active-nav @endif">
                <a class="nav-link" href="{{ route('students.index') }}">Students</a>
            </li>
            </ul>
          </div>
        </nav>
    </div>

    @yield('content') <!-- Content Section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
