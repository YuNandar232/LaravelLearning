<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Created</title>
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/mailLayout/mail.css') }}">
</head>

<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Hi {{ $studentName }} ,Welcome to {{ $studentMajor }} Major Class!</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <h3>Your information are as follows:</h3>
            <p><strong>Name:</strong> {{ $studentName }}</p>
            <p><strong>Major:</strong> {{ $studentMajor }}</p>
            <p><strong>Email:</strong> {{ $studentEmail }}</p>
            <p><strong>Phone:</strong> {{ $studentPhone }}</p>
            <p><strong>Address:</strong> {{ $studentAddress }}</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>This is an automated email. Please do not reply.</p>
        </div>
    </div>

</body>

</html>
