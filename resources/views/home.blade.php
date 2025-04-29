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
        <div
            style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('assets/images/bg1.gif') }}');
        background-size: cover;
        background-position: center;
        z-index: 0;
        opacity: 0.3; /* Opsional, supaya konten di atas lebih jelas */
    ">
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="container mt-0" style="min-height: 75vh; display: flex; flex-direction: column;">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="card  hover-card shadow-lg border-0 pb-3 pt-3"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="">
                                        <div>
                                            <h2 class="d-block d-md-none text-primary">Selamat Datang di Permintaan
                                                Perbaikan!</h2>
                                            <h2 class="text-nowrap d-none d-md-block w-100 text-primary">Selamat Datang di
                                                Permintaan
                                                Perbaikan!</h2>
                                            <p>
                                                Lakukan permintaan perbaikan dengan mudah dan cepat melalui sistem kami.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-between align-items-center flex-row-reverse ">
                                <!-- Card 1 untuk mode kecil (HP dan tablet) -->
                                <div class="col-6 col-md-6 col-lg-4 mb-3 d-block d-lg-none">
                                    <div class="card hover-card bg-white shadow-lg rounded-4 text-center p-2"
                                        style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden;border-radius: 20px;">
                                        <a href="#" class="btn btn-primary p-1 mt-0" data-bs-toggle="modal"
                                            data-bs-target="#tradeModal">
                                            <img src="{{ asset('assets/images/metaverse.png') }}" alt="Metaverse Image"
                                                class="img-fluid mx-auto" style="width: 90%;">
                                            Hubungi Kami
                                        </a>
                                    </div>
                                </div>

                                <!-- Card 1 untuk mode besar (desktop) -->
                                <div class="col-6 col-md-6 col-lg-3 mb-1 d-none d-lg-block">
                                    <div class="card hover-card bg-white shadow-lg rounded-4 text-center p-2">
                                        <a href="#" class="btn btn-primary p-1 mt-0" data-bs-toggle="modal"
                                            data-bs-target="#tradeModal">
                                            <img src="{{ asset('assets/images/metaverse.png') }}" alt="Metaverse Image"
                                                class="img-fluid mx-auto" style="width: 30%;">
                                            Hubungi Kami
                                        </a>
                                    </div>
                                    <div class="card hover-card bg-white shadow-lg rounded-4 text-center p-2">
                                        <a href="#" class="btn btn-primary p-1 mt-0" data-bs-toggle="modal"
                                            data-bs-target="#teamModal">
                                            <img src="{{ asset('assets/images/metaverse1.png') }}" alt="Metaverse Image"
                                                class="img-fluid mx-auto" style="width: 15%;">
                                            Team Info
                                        </a>
                                    </div>
                                    <div class="card hover-card bg-white shadow-lg rounded-4 text-center p-2">
                                        <a href="#" class="btn btn-primary p-1 mt-0" data-bs-toggle="modal"
                                            data-bs-target="#historyModal">
                                            <img src="{{ asset('assets/images/metaverse2.png') }}" alt="Metaverse Image"
                                                class="img-fluid mx-auto" style="width: 15%;">
                                            History
                                        </a>
                                    </div>
                                </div>


                                <!-- Slider Section -->
                                <div class="col-6 col-md-6 col-lg-9">
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
                                                            <h4 class="count-num mt-2 mb-0 d-none d-sm-block">LogisHub</h4>
                                                            <div class="d-flex justify-content-center mt-0">
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
                                <div class="col-6 col-md-6 col-lg-4 mb-3 d-block d-lg-none">
                                    <div class="card hover-card bg-white shadow-lg rounded-4 text-center p-2"
                                        style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                        <a href="#" class="btn btn-primary p-1 mt-0" data-bs-toggle="modal"
                                            data-bs-target="#teamModal">
                                            <img src="{{ asset('assets/images/metaverse1.png') }}" alt="Metaverse Image"
                                                class="img-fluid mx-auto" style="width: 60%;"><br>
                                            Team Info
                                        </a>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg"> <!-- modal-lg supaya lebih lebar -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="teamModalLabel">Team Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    @foreach ($users as $user)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card overflow-hidden">
                                                                <div class="card-body d-flex align-items-center">
                                                                    <div class="me-3">
                                                                        <p class="mb-1 fs-14">
                                                                            <strong>{{ $user->name }}</strong>
                                                                            ({{ ucfirst($user->role) }})
                                                                        </p>
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <span class="text-muted"
                                                                                style="font-size: 12px;">NIP:
                                                                                {{ $user->nip }}</span>
                                                                            @if ($user->role != 'admin')
                                                                                <span class="badge bg-primary"
                                                                                    style="font-size: 10px;">
                                                                                    {{ number_format(floatval($ratarating[$user->id] ?? 0), 1) }}
                                                                                    <i class="fas fa-star"></i> / 5
                                                                                </span>
                                                                            @else
                                                                                <span class="badge bg-secondary"
                                                                                    style="font-size: 10px;">Admin</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <img src="{{ optional($user)->profile ? asset($user->profile) : asset('assets/images/no-profile.jpg') }}"
                                                                        alt="User Profile" width="50" height="50"
                                                                        style="border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Card 3 -->
                                <div class="col-6 col-md-6 col-lg-4 mb-3d-block d-lg-none">
                                    <div class="card hover-card bg-white shadow-lg rounded-4 text-center p-2"
                                        style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                        <a href="#" class="btn btn-primary p-1 mt-0" data-bs-toggle="modal"
                                            data-bs-target="#historyModal">
                                            <img src="{{ asset('assets/images/metaverse2.png') }}" alt="Metaverse Image"
                                                class="img-fluid mx-auto" style="width: 60%;"><br>
                                            History
                                        </a>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="historyModal" tabindex="-1"
                                    aria-labelledby="historyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
                                            <div class="modal-header"
                                                style="background: rgba(245, 245, 245, 0.8); backdrop-filter: blur(5px);">
                                                <h5 class="modal-title" id="historyModalLabel"
                                                    style="font-weight: bold;">Completed Repairs History</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <!-- Make modal-body scrollable -->
                                            <div class="modal-body p-4"
                                                style="background: rgba(255,255,255,0.9); backdrop-filter: blur(6px); overflow-y: auto; height: calc(100vh - 120px);">
                                                <div class="row">
                                                    @php
                                                        $completedRepairs = $userRepairs->where('status', 'completed');
                                                    @endphp

                                                    @forelse ($completedRepairs as $repair)
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card shadow-sm border-0"
                                                                style="border-radius: 16px; transition: transform 0.3s;">
                                                                <div class="card-body d-flex flex-column gap-2">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="text-start">
                                                                            <h6 class="mb-1" style="font-weight: 600;">
                                                                                @if ($repair->teams && $repair->teams->count())
                                                                                    {{ $repair->teams->pluck('name')->implode(', ') }}
                                                                                @else
                                                                                    Tim Belum Tersedia
                                                                                @endif
                                                                            </h6>
                                                                            <small class="text-muted">
                                                                                <i class="fas fa-calendar-alt me-1"
                                                                                    style="color: var(--primary);"></i>
                                                                                {{ $repair->scheduled_date ? \Carbon\Carbon::parse($repair->scheduled_date)->translatedFormat('d F Y') : 'Belum Dijadwalkan' }}
                                                                            </small>
                                                                        </div>

                                                                        <div class="text-end">
                                                                            <span class="badge bg-primary"
                                                                                style="font-size: 11px;">
                                                                                {{ $repair->repairTeam->rating ?? '-' }} <i
                                                                                    class="fas fa-star"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    @if (!empty($repair->repairTeam) && !empty($repair->repairTeam->comment))
                                                                        <div class="mt-2">
                                                                            <small class="text-muted"
                                                                                style="font-size: 12px;">Komentar:</small>
                                                                            <div class="bg-light p-2 rounded"
                                                                                style="font-size: 13px; color: #555;">
                                                                                {{ $repair->repairTeam->comment }}
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <p class="text-muted text-center mt-4">Belum ada repair yang
                                                                selesai.</p>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Optional Custom CSS -->
                                <style>
                                    #historyModal .card:hover {
                                        transform: translateY(-5px);
                                        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                                    }
                                </style>


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
    </div>
@endsection
