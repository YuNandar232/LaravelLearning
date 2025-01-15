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
        .navbar-nav a {
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
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <!-- Students Button -->
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('majors.index') }}">Majors</a>
                    </li>

                    <!-- Majors Button -->
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('students.index') }}">Students</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    @yield('content') <!-- Content Section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
