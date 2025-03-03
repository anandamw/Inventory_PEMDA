<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            background-color: #0056b3;
            /* Warna khas dari Logishub Kominfo */
            color: #ffffff;
            text-align: center;
            padding: 40px 20px;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
        }

        .content {
            padding: 30px 20px;
            text-align: center;
            color: #555;
        }

        .content h2 {
            color: #333;
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
        }

        .cta {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        .cta:hover {
            background-color: #218838;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 40px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>{{ $subject }}</h1>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2>Halo, Penerima!</h2>
            <p>{{ $msg }}</p>
            <p>QR Code Anda telah terlampir dalam email ini. Untuk mengunduhnya, klik tombol di bawah:</p>

        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; 2025 Logishub Kominfo. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>

</body>

</html>
