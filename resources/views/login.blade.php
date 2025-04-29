<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('') }}assets/images/favicon.png" />
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
            box-shadow: inset 4px 4px 6px #babecc,
                inset -4px -4px 6px #ffffff;
            margin: 0 auto 20px auto;
        }

        .logo-container img {
            width: 110px;
            height: auto;
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
            background: #008B8B;
            width: 95%;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 10px 10px 20px #babecc, -10px -10px 20px #ffffff;
            text-align: center;
            margin-left: 10px
        }

        .scroll-instruction {
            font-size: 1.2rem;
            color: #008B8B;
            cursor: pointer;
            text-decoration: underline;
        }

        .scroll-up-indicator {
            position: fixed;
            bottom: 5%;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 1.5s infinite alternate ease-in-out;
            z-index: 100;
        }

        .scroll-icon {
            width: 60px;
            filter: hue-rotate(0deg);
            transition: filter 0.5s ease-in-out;
            filter: invert(43%) sepia(52%) saturate(306%) hue-rotate(137deg) brightness(91%) contrast(86%);
        }

        .title-container {
            display: flex;
            justify-content: center;
            /* Pusatkan secara horizontal */
            align-items: center;
            /* Jika ingin juga di tengah vertikal */
            text-align: center;
            /* Agar teks juga terpusat */
            width: 100%;
            /* Pastikan parent mencakup seluruh lebar */
        }

        .title-container p {
            margin-left: 10%;
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: #ECF0F3;
            box-shadow: inset 4px 4px 6px #babecc,
                inset -4px -4px 6px #ffffff;
            font-size: 14px;
            outline: none;
            text-align: center;
            /* Memastikan teks dalam elemen ikut rata tengah */
        }


        @keyframes bounce {
            0% {
                transform: translate(-50%, 0);
            }

            100% {
                transform: translate(-50%, -20px);
            }
        }


        .wave-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 75px;
            z-index: 2;
        }

        .wave-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 75px;
            z-index: 2;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.5/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
    {{-- <div id="loader"></div> --}}
    @include('sweetalert::alert')
    <!-- Ombak Atas -->
    <svg class="wave wave-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#008B8B" fill-opacity="1"
            d="M0,192L30,186.7C60,181,120,171,180,170.7C240,171,300,181,360,202.7C420,224,480,256,540,250.7C600,245,660,203,720,170.7C780,139,840,117,900,122.7C960,128,1020,160,1080,170.7C1140,181,1200,171,1260,149.3C1320,128,1380,96,1410,80L1440,64V0H1410C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0H0Z">
        </path>
    </svg>

    <div id="particles-js"></div>

    <!-- Ombak Bawah -->
    <svg class="wave wave-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#008B8B" fill-opacity="1"
            d="M0,160L30,176C60,192,120,224,180,224C240,224,300,192,360,170.7C420,149,480,139,540,138.7C600,139,660,149,720,181.3C780,213,840,267,900,266.7C960,267,1020,213,1080,176C1140,139,1200,117,1260,128C1320,139,1380,181,1410,202.7L1440,224V320H0Z">
        </path>
    </svg>


    <div class="home-content text-center" id="home-content">
        <div class="logo-container">
            <img src="{{ asset('') }}assets/images/pemda.png" alt="Logishub Logo" class="concave-logo">
        </div>
        <div class="title-container">
            <h2>Welcome to Logishub</h2>
        </div>
        <div class="title-container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <p>LogisHub - Platform web pemerintah untuk pengambilan barang yang cepat, mudah, dan terdata,
                        mengurangi birokrasi serta meningkatkan efisiensi.</p>
                </div>
            </div>
        </div>
        <div class="scroll-up-indicator">
            <img id="scroll-icon" src="{{ asset('') }}assets/images/Scroll.png" alt="Scroll Up" class="scroll-icon">
        </div>
    </div>


    <div class="scanner-card" id="scanner-card">
        <div class="card shadow-lg p-3 " style="border-radius: 20px;">
            <div class="card-body text-center" style="margin-left: 2.5%">
                <h3 class="card-title mb-4" style="color: white"><i class="fas fa-qrcode"></i> QR Code Scanner</h3>
                <div id="qr-reader" style="width: 100%"></div>
                <form action="/register/action" method="POST" id="register-form">
                    @csrf <!-- Form Input, awalnya tersembunyi -->
                    <div id="user-form" class="hidden">
                        <input type="email" id="email" name="email" placeholder="Alamat Email">
                        <input type="text" id="nama" name="name" placeholder="Nama">
                        <input type="text" id="nip" name="nip" placeholder="NIP">

                        <!-- Pencarian Instansi dengan Searchbox -->
                        <input type="text" id="nama_instansi" name="nama_instansi" placeholder="Cari Instansi"
                            list="instansi-list">
                        <datalist id="instansi-list">
                            @foreach ($categories as $item)
                                <option value="{{ $item->nama_instansi }}">
                            @endforeach

                        </datalist>

                        <button type="submit" id="submit-form" class="btn animated-btn"
                            style=" width: 50%; color: #e2e2e2;  font-weight: bold; background: linear-gradient(90deg, #008B8B, #59dede, #008B8B); background-size: 200% 100%; animation: gradient-animation 3s infinite;">Submit</button>
                        <div id="back-to-qr" class="btn-back btn animated-btn"
                            style=" width: 50%; color: #e2e2e2;  font-weight: bold; background: linear-gradient(90deg, #8b1500, #de5959, #8b1500); background-size: 200% 100%; animation: gradient-animation 3s infinite;">
                            Back to
                            QR</div>


                    </div>
                </form> <!-- Tambahkan tempat untuk menampilkan pesan -->
                <div id="message" style="color: white; text-align: center; margin-top: 10px;"></div>

                <!-- Tombol untuk mengganti tampilan -->
                <div class="mt-5">
                    <button id="get-qr" class="btn btn-light border-4 col-6 mt-0"
                        style="color: #e2e2e2;  font-weight: bold; background: linear-gradient(90deg, #008B8B, #59dede, #008B8B); background-size: 200% 100%; animation: gradient-animation 3s infinite;">Get
                        QR</button>

                    <style>
                        @keyframes gradient-animation {
                            0% {
                                background-position: 0% 50%;
                            }

                            50% {
                                background-position: 100% 50%;
                            }

                            100% {
                                background-position: 0% 50%;
                            }
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery UI (untuk Autocomplete) -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.5/dist/sweetalert2.all.min.js"></script>

    <script>
        $(function() {
            $("#nama_instansi").autocomplete({
                source: "{{ url('/autocomplete-instansi') }}"
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#get-qr").click(function() {
                $("#qr-reader").hide(); // Sembunyikan scanner
                $("#get-qr").hide(); // Sembunyikan tombol "Get QR"
                $("#user-form").removeClass("hidden"); // Tampilkan form
            });

            $("#back-to-qr").click(function() {
                $("#qr-reader").show(); // Tampilkan scanner kembali
                $("#get-qr").show(); // Tampilkan kembali tombol "Get QR"
                $("#user-form").addClass("hidden"); // Sembunyikan form
            });
        });
    </script>

    <script>
        let hue = 008 B8B;
        setInterval(() => {
            hue = (hue + 30) % 360;
            document.getElementById('scroll-icon').style.filter = `hue-rotate(${hue}deg)`;
        }, 1000);
    </script>
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
                        value: "#59dede"
                    },
                    line_linked: {
                        enable: true,
                        color: "#008B8B"
                    }
                }
            });
        }

        $(document).ready(function() {
            var lastResult = "";

            function onScanSuccess(decodedText) {

                if (decodedText !== lastResult) {
                    lastResult = decodedText;
                    $("#qr-reader-results").html("<strong>Scanned Data:</strong> " + decodedText);

                    let token;
                    try {

                        let data = JSON.parse(decodedText);
                        token = data.token;

                    } catch (e) {

                        token = decodedText;
                    }

                    if (token) {

                        $("#qr-reader-results").append("<br><strong>Token:</strong> " + token);

                        $.ajax({
                            url: "/scan-qr-code",
                            method: "POST",
                            data: {
                                token: token,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function(response) {
                                console.log(response);
                                if (response.status === "success" && response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {

                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Informasi',
                                        text: 'Anda belum Terdaftar.'
                                    });
                                }
                            },
                            error: function(xhr) {

                                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message :
                                    "Unknown error occurred.";

                                // Menampilkan pesan error dengan SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Login',
                                    text: errorMessage, // Pesan error dari response
                                });

                                // Jika tidak menggunakan SweetAlert, tampilkan pesan di div
                                $("#message").text(errorMessage).css("color", "red").show();
                            }
                        });
                    } else {

                        $("#qr-reader-results").append(
                            "<br><span class='text-danger'>Invalid token format.</span>"
                        );
                    }
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                fps: 15,
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
