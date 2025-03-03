<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QR Code Scanner - Logishub</title>

    <!-- Stylesheets -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Scripts -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 200vh;
            margin: 0;
            background: #000;
        }

        input,
        button {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 10px;
            border: none;
            background-color: #f0f0f0;
        }

        .logo-container {
            width: 180px;
            height: 180px;
            background: #ECF0F3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 4px 4px 6px #babecc, inset -4px -4px 6px #ffffff;
            margin: 0 auto 20px auto;
        }

        .logo-container img {
            width: 110px;
            height: auto;
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100vh;
            z-index: 1;
            background: #ffffffe3;
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
            background: rgba(255, 255, 255, 0.61);
            z-index: 5;
            color: #008B8B;
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
            background: #ffffff;
        }

        #user-form {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            background: #ffffff;
        }

        .hidden {
            display: none;
        }

        /* Media queries */
        @media (max-width: 767px) {
            #qr-reader {
                height: 300px;
                width: 90%;
            }

            .scanner-card {
                width: 90%;
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
            background: #008B8B;
            width: 95%;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 10px 10px 20px #babecc, -10px -10px 20px #ffffff;
            text-align: center;
            margin-left: 10px;
        }

        .title-container {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        .title-container p {
            margin-left: 10%;
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: #ECF0F3;
            box-shadow: inset 4px 4px 6px #babecc, inset -4px -4px 6px #ffffff;
            font-size: 14px;
            outline: none;
        }

        @keyframes bounce {
            0% {
                transform: translate(-50%, 0);
            }

            100% {
                transform: translate(-50%, -20px);
            }
        }

        .wave-top,
        .wave-bottom {
            position: absolute;
            width: 100%;
            height: 75px;
            z-index: 2;
        }

        .wave-top {
            top: 0;
        }

        .wave-bottom {
            bottom: 0;
            position: fixed;
        }
    </style>
</head>

<body>
    <!-- Top Wave -->
    <svg class="wave wave-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#008B8B" fill-opacity="1"
            d="M0,192L30,186.7C60,181,120,171,180,170.7C240,171,300,181,360,202.7C420,224,480,256,540,250.7C600,245,660,203,720,170.7C780,139,840,117,900,122.7C960,128,1020,160,1080,170.7C1140,181,1200,171,1260,149.3C1320,128,1380,96,1410,80L1440,64V0H1410C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0H0Z">
        </path>
    </svg>

    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Bottom Wave -->
    <svg class="wave wave-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#008B8B" fill-opacity="1"
            d="M0,160L30,176C60,192,120,224,180,224C240,224,300,192,360,170.7C420,149,480,139,540,138.7C600,139,660,149,720,181.3C780,213,840,267,900,266.7C960,267,1020,213,1080,176C1140,139,1200,117,1260,128C1320,139,1380,181,1410,202.7L1440,224V320H0Z">
        </path>
    </svg>

    <!-- Main Content -->
    <div class="home-content text-center" id="home-content">
        <div class="logo-container">
            <img src="{{ asset('') }}assets/images/pemda.png" alt="Logishub Logo" class="concave-logo">
        </div>
        <div class="title-container">
            <h2>Registrasi berhasil! Email telah dikirim.</h2>
        </div>
        <div class="title-container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <p>
                        <a href="/">Kembali ke Halaman Utama</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Particle.js Setup -->
    <script>
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
                        value: "#59dede"
                    },
                    line_linked: {
                        enable: true,
                        color: "#008B8B"
                    }
                }
            });
        }
    </script>
</body>

</html>
