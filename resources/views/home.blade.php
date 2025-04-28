@extends('components.template')

@section('content')
    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        }

        .content-body {
            min-height: 100% !important;
        }
    </style>

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="container mt-0" style="min-height: 75vh; display: flex; flex-direction: column;">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="card bubles hover-card shadow-lg border-0 pb-0"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="buy-coin bubles-down">
                                        <div>
                                            <h2 class="d-block d-md-none">Selamat Datang di Permintaan Perbaikan!</h2>
                                            <h2 class="text-nowrap d-none d-md-block w-100">Selamat Datang di Permintaan
                                                Perbaikan!</h2>
                                            <p>
                                                Lakukan permintaan perbaikan dengan mudah dan cepat melalui sistem kami.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-between align-items-center flex-row-reverse">
                                <!-- Card 1 -->
                                <div class="col-6 col-md-6 col-lg-4 mb-3">
                                    <div class="card bg-secondary shadow rounded-4 text-center p-3">
                                        <img src="{{ asset('assets/images/metaverse.png') }}" alt="Metaverse Image"
                                            class="img-fluid mx-auto" style="width: 90%;">
                                        <a href="#" class="btn btn-primary p-2 mt-2" data-bs-toggle="modal"
                                            data-bs-target="#tradeModal">Hubungi Kami</a>
                                    </div>
                                </div>

                                <!-- Slider Section -->
                                <div class="col-6 col-md-6 col-lg-8">
                                    <div class="swiper mySwiper">
                                        <div class="swiper-wrapper">
                                            <!-- Swiper Slide 1 -->
                                            <div class="swiper-slide">
                                                <div class="card card-widget shadow rounded-4">
                                                    <div class="card-body text-center">
                                                        <div class="card-widget-info">
                                                            <a href="https://www.sumenepkab.go.id/" target="_blank"
                                                                class="d-flex justify-content-center">
                                                                <img src="{{ asset('assets/images/about.png') }}"
                                                                    class="img-fluid" width="80" height="80"
                                                                    alt="About">
                                                            </a>
                                                            <h4 class="count-num mt-4 mb-0 d-none d-sm-block">LogisHub</h4>
                                                            <div class="d-flex justify-content-center">
                                                                <button type="button" class="btn btn-link text-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalCenter">
                                                                    Read more
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Swiper Slide 2 -->
                                            <div class="swiper-slide">
                                                <div class="card card-widget shadow rounded-4">
                                                    <div class="card-body">
                                                        <div class="card-widget-info rewards">
                                                            <h4 class="count-num">+{{ $totalQuantity }} <span
                                                                    class="fs-6">Item</span></h4>
                                                            <p class="mb-0 d-none d-sm-block">Manajemen Item & Aset</p>
                                                            <div class="d-flex align-items-baseline reward-earn mt-3">
                                                                <h2 class="me-2">+{{ $totalTeams }}</h2>
                                                                <span>Team</span>
                                                            </div>
                                                            <div class="progress-box">
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-primary"
                                                                        style="width: {{ min(($totalQuantity / 10000) * 100, 100) }}%; height: 7px; border-radius: 4px;"
                                                                        role="progressbar"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2 -->
                                <div class="col-6 col-md-6 col-lg-4 mb-3">
                                    <div class="card bg-secondary shadow rounded-4 text-center p-3">
                                        <img src="{{ asset('assets/images/metaverse.png') }}" alt="Metaverse Image"
                                            class="img-fluid mx-auto" style="width: 90%;">
                                        <a href="#" class="btn btn-primary p-2 mt-2" data-bs-toggle="modal"
                                            data-bs-target="#tradeModal">Hubungi Kami</a>
                                    </div>
                                </div>

                                <!-- Card 3 -->
                                <div class="col-6 col-md-6 col-lg-4 mb-3">
                                    <div class="card bg-secondary shadow rounded-4 text-center p-3">
                                        <img src="{{ asset('assets/images/metaverse.png') }}" alt="Metaverse Image"
                                            class="img-fluid mx-auto" style="width: 90%;">
                                        <a href="#" class="btn btn-primary p-2 mt-2" data-bs-toggle="modal"
                                            data-bs-target="#tradeModal">Hubungi Kami</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Swiper JS -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
                        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                function initSwiper() {
                                    return new Swiper(".mySwiper", {
                                        loop: true,
                                        spaceBetween: 10,
                                        pagination: {
                                            el: ".swiper-pagination",
                                            clickable: true,
                                        },
                                        navigation: {
                                            nextEl: ".swiper-button-next",
                                            prevEl: ".swiper-button-prev",
                                        },
                                        slidesPerView: window.innerWidth >= 768 ? 2 : 1, // 2 di tablet/desktop, 1 di mobile
                                        autoplay: {
                                            delay: 2400,
                                            disableOnInteraction: false,
                                        }
                                    });
                                }

                                var swiper = initSwiper(); // Inisialisasi pertama

                                // Pastikan saat resize, Swiper di-restart sesuai ukuran layar
                                window.addEventListener("resize", function() {
                                    swiper.destroy(true, true); // Hapus instance lama
                                    swiper = initSwiper(); // Inisialisasi ulang
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endsection
