<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QR Code Scanner - Logishub</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 200vh;
            margin: 0;
            background: #000;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #252525;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #161616;
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100vh;
            z-index: 1;
            background: #16351fed;
        }

        .home-content {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            z-index: 5;
            color: white;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .home-content.hidden {
            opacity: 0;
        }

        .scanner-card {
            position: fixed;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 600px;
            transition: top 0.8s ease-in-out, opacity 0.8s ease-in-out;
            z-index: 10;
            opacity: 0;
        }

        .scanner-card.show {
            top: 3%;
            opacity: 1;
        }

        #qr-reader {
            width: 100%;
            height: 350px;
            border-radius: 10px;
            background: #5c5c5c;
        }

        /* Media query untuk perangkat mobile */
        @media (max-width: 767px) {
            #qr-reader {
                height: 300px;
                /* Menyesuaikan ukuran di perangkat mobile */
                width: 90%;
            }

            .scanner-card {
                width: 90%;
                /* Menyesuaikan lebar scanner card */
            }
        }

        @media (min-width: 768px) {
            .scanner-card {
                width: 50%;
            }

            #qr-reader {
                height: 400px;
            }
        }

        .card-title {
            font-size: 2rem;
        }

        .card-body {
            background: #afafafed;
            padding: 20px;
            border-radius: 15px;
        }

        .scroll-instruction {
            font-size: 1.2rem;
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>

    <div class="home-content" id="home-content">
        <img src="{{ asset('') }}assets/images/pemda.png" alt="Logishub Logo" class="home-logo" width="150"
            height="auto">
        <h1>Welcome to Logishub</h1>
        <p>Logishub provides innovative solutions to streamline logistics processes. Scroll down to start the QR Code
            scanner.</p>
    </div>

    <div class="scanner-card" id="scanner-card">
        <div class="card shadow-lg p-4">
            <div class="card-body text-center">
                <h3 class="card-title mb-4"><i class="fas fa-qrcode"></i> QR Code Scanner</h3>
                <div id="qr-reader"></div>
                <div class="mt-4">
                    <button class="btn btn-primary me-2" onclick="startScanner()" style="border-radius: 8px;">
                        <i class="fas fa-play"></i> Start Scanner
                    </button>
                    <button class="btn btn-danger" onclick="stopScanner()" style="border-radius: 8px;">
                        <i class="fas fa-stop"></i> Stop Scanner
                    </button>
                </div>
                <div class="mt-4">
                    <h5>Scanned Result:</h5>
                    <div id="qr-reader-results" class="alert alert-light border"
                        style="min-height: 40px; border-radius: 10px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menonaktifkan efek partikel pada perangkat mobile
        if (window.innerWidth > 767) {
            particlesJS("particles-js", {
                particles: {
                    number: {
                        value: 100
                    },
                    size: {
                        value: 3
                    },
                    move: {
                        speed: 2
                    },
                    color: {
                        value: "#ffffff"
                    },
                    line_linked: {
                        enable: true,
                        color: "#ffffff"
                    }
                }
            });
        }

        $(document).ready(function() {
            var lastResult = "";
            var countResults = 0;

            function onScanSuccess(decodedText) {
                if (decodedText !== lastResult) {
                    countResults++;
                    lastResult = decodedText;
                    $("#qr-reader-results").html("<strong>Scanned Data:</strong> " + decodedText);
                    try {
                        var data = JSON.parse(decodedText);
                        var name = data.name;
                        var nip = data.nip;
                        var password = data.password;

                        if (name && nip && password) {
                            $("#qr-reader-results").append("<br><strong>Name:</strong> " + name +
                                "<br><strong>NIP:</strong> " + nip);

                            $.ajax({
                                url: "/scan-qr-code",
                                method: 'POST',
                                data: {
                                    name: name,
                                    nip: nip,
                                    password: password,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    console.log("Server Response:", response);
                                    if (response.redirect_url) {
                                        window.location.href = response.redirect_url;
                                    } else {
                                        $("#qr-reader-results").append(
                                            "<br><span class='text-warning'>No redirection URL provided.</span>"
                                            );
                                    }
                                },
                                error: function(xhr) {
                                    console.error("AJAX Error:", xhr);
                                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.message :
                                        "Unknown error occurred.";
                                    $("#qr-reader-results").append(
                                        "<br><span class='text-danger'>Error: " + errorMessage +
                                        "</span>");
                                }
                            });
                        } else {
                            $("#qr-reader-results").append(
                                "<br><span class='text-danger'>Invalid data format.</span>");
                        }
                    } catch (e) {
                        console.error("JSON Parsing Error:", e);
                        $("#qr-reader-results").append(
                            "<br><span class='text-danger'>Invalid QR Code format.</span>");
                    }
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                fps: 10,
                qrbox: 250
            });
            html5QrcodeScanner.render(onScanSuccess);

            $(window).on("scroll", function() {
                if ($(window).scrollTop() > 200) {
                    $('#scanner-card').addClass('show');
                    $('#home-content').addClass('hidden');
                }

                if ($(window).scrollTop() <= 0) {
                    $('#scanner-card').removeClass('show');
                    $('#home-content').removeClass('hidden');
                }
            });
        });
    </script>
</body>

</html>
