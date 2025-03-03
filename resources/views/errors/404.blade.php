<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .error-container {
            background-color: #f8d7da;
            padding: 20px;
            border: 1px solid #f5c6cb;
            color: #721c24;
            display: inline-block;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>404 - Page Not Found</h1>
        <p>The page you are looking for could not be found.</p>
        <a href="{{ url('/') }}">Go to Home Page</a>
    </div>
</body>

</html>
