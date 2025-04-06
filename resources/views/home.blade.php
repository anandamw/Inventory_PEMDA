@extends('components.template')

@section('content')
    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        }
    </style>
    <div class="content-body" style="min-height: 100%">
        <!-- row -->
        <div class="container-fluid mh-auto">
            <div class="row">
                <div class="col-xl-12">
                    <div class="overflow-hidden bg-transparent dz-crypto-scroll shadow-none">
                        <div class="js-conveyor-example">
                            <ul class="crypto-list" id="crypto-webticker">
                                @foreach ($users as $user)
                                    <li>
                                        <div class="card overflow-hidden">
                                            <div class="card-body d-flex align-items-center">
                                                <div class="me-4">
                                                    <p class="mb-2 fs-13">
                                                        <i class="fa fa-caret-up scale5 me-2 text-success"></i>
                                                        {{ $user->name }} ({{ ucfirst($user->role) }})
                                                    </p>
                                                    <div class="d-flex gap-4"> 
                                                    <h4 class="heading mb-0">{{ $user->nip }}</h4>
                                                    <span class="badge bg-primary" style="font-size: 10px;">
                                                        {{ $repair->repairTeam->rating ?? '-' }} <i class="fas fa-star"></i> / 5
                                                        <i class="fas fa-star"></i>
                                                    </span>
                                                    </div>
                                                </div>
                                                <img src="{{ optional($user)->profile ? asset($user->profile) : asset('assets/images/no-profile.jpg') }}"
                                                    alt="User Profile" width="42" height="42" viewBox="0 0 42 42"
                                                    fill="none"
                                                    style="border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="container mt-1">
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-between align-items-center flex-row-reverse">
                            <div class="col-5 col-lg-6 col-xl-3">
                                <div class="card bg-secondary shadow rounded-4 text-center p-3">
                                    <img src="{{ asset('assets/images/metaverse.png') }}" alt="Metaverse Image"
                                        class="img-fluid mx-auto" style="width: 90%;">

                                    <a href="#" class="btn btn-primary p-2 mt-2" data-bs-toggle="modal"
                                        data-bs-target="#tradeModal">Hubungi Kami</a>
                                </div>
                            </div>
                            <div class="col-7 col-lg-6 col-xl-9">
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="card card-widget shadow rounded-4">
                                                <div class="card-body text-center">
                                                    <div class="card-widget-info">
                                                        <!-- Logo di tengah -->
                                                        <a href="https://www.sumenepkab.go.id/" target="_blank"
                                                            class="d-flex justify-content-center">
                                                            <img src="{{ asset('assets/images/about.png') }}"
                                                                class="img-fluid" width="80" height="80"
                                                                alt="About">
                                                        </a>
                                                        <!-- Judul -->
                                                        <h4 class="count-num mt-4 mb-0">LogisHub</h4>
                                                        <!-- Tombol Read More -->
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-link text-primary"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                                Read more
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card card-widget shadow rounded-4">
                                                <div class="card-body">
                                                    <div class="card-widget-info rewards">
                                                        <h4 class="count-num">+{{ $totalQuantity }} <span
                                                                class="fs-6">Total Item</span></h4>
                                                        <p>Manajemen Item & Aset</p>
                                                        <div class="d-flex align-items-baseline reward-earn mt-5">
                                                            <h2 class="me-2">+{{ $totalTeams }}</h2>
                                                            <span>Team</span>
                                                        </div>
                                                        <div class="progress-box">
                                                            <div class="progress">
                                                                <div class="progress-bar bg-primary"
                                                                    style="width: {{ min(($totalQuantity / 10000) * 100, 100) }}%; height:7px; border-radius:4px;"
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
                        </div>
                    </div>

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
                                    slidesPerView: window.innerWidth >= 1200 ? 2 : 1, // 2 di desktop, 1 di mobile
                                    autoplay: window.innerWidth < 1200 ? { // Aktif hanya di mobile
                                        delay: 2400,
                                        disableOnInteraction: false,
                                    } : false
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


                    <!-- Bagian khusus user -->
                    <div class="container mt-2">
                        <div class="row d-flex flex-column flex-md-row-reverse">
                            <div class="col-xl-12 col-sm-6">
                                <div class="card" style="background: transparent; box-shadow: none; border: none;">
                                    <div class="card-body pt-0">
                                        <h1 class="mb-4 mt-0" style="color: var(--secondary)">Completed Repairs</h1>

                                        <!-- HANYA SATU ID scrollContainer -->
                                        <div class="horizontal-scroll-wrapper" id="scrollContainer">
                                            @php
                                                $completedRepairs = $userRepairs->where('status', 'completed');
                                            @endphp
                                            @forelse ($completedRepairs as $repair)
                                                <div class="card-item mb-3">
                                                    <div class="card card-content shadow-sm"
                                                        style="border-radius: 16px; overflow: hidden; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border: none; transition: transform 0.3s ease;">
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center p-4">
                                                            <div class="d-flex align-items-start">
                                                                <div class="me-3">
                                                                    <img src="{{ optional($repair->admin)->profile ? asset($repair->admin->profile) : asset('assets/images/no-profile.jpg') }}"
                                                                        alt="Admin Profile" width="60" height="60"
                                                                        style="border-radius: 50%; object-fit: cover; border: 3px solid #ddd; transition: 0.3s;">
                                                                </div>
                                                                <div>
                                                                    @if ($repair->teams && $repair->teams->count())
                                                                        <div class="mb-2">
                                                                            <small class="text-muted fw-bold"
                                                                                style="font-size: 12px;">Tim yang
                                                                                mengerjakan:</small>
                                                                            <div class="mt-1 d-flex flex-wrap gap-2">
                                                                                @foreach ($repair->teams as $member)
                                                                                    <span class="badge"
                                                                                        style="background-color: #e9ecef; color: #333; font-size: 11px;">
                                                                                        {{ $member->name }}
                                                                                    </span>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <small style="color: #555; font-size: 13px;">
                                                                        <i class="fas fa-calendar-alt me-1"
                                                                            style="color: var(--primary);"></i>
                                                                        {{ $repair->scheduled_date ? \Carbon\Carbon::parse($repair->scheduled_date)->translatedFormat('d F Y') : 'Belum Dijadwalkan' }}

                                                                    </small>
                                                                </div>
                                                            </div>

                                                            <div class="text-end">
                                                                <span class="badge bg-primary" style="font-size: 10px;">
                                                                    {{ $repair->repairTeam->rating ?? '-' }} <i
                                                                        class="fas fa-star"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted text-center mt-3">Belum ada repair yang selesai.</p>
                                            @endforelse

                                        </div>

                                        <div class="dot-indicators">
                                            <span class="dot active"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Style -->
                            <style>
                                .horizontal-scroll-wrapper {
                                    overflow-x: auto;
                                    white-space: nowrap;
                                    scrollbar-width: none;
                                    -ms-overflow-style: none;
                                    scroll-behavior: smooth;
                                    padding-bottom: 10px;
                                    -webkit-overflow-scrolling: touch;
                                    /* ini buat smooth scroll di iOS */
                                }

                                .horizontal-scroll-wrapper::-webkit-scrollbar {
                                    display: none;
                                }

                                .card-item {
                                    display: inline-block;
                                    width: 330px;
                                    /* ganti dari 500px jadi lebih kecil */
                                    max-width: 85vw;
                                    /* biar gak lebih lebar dari layar HP */
                                    margin-right: 10px;
                                }

                                .card-content {
                                    background: rgba(255, 255, 255, 0.8);
                                    backdrop-filter: blur(10px);
                                    border-radius: 12px;
                                    overflow: hidden;
                                    border: none;
                                }

                                .dot-indicators {
                                    display: flex;
                                    justify-content: center;
                                    margin-top: 10px;
                                }

                                .dot {
                                    width: 10px;
                                    height: 10px;
                                    margin: 0 5px;
                                    border-radius: 50%;
                                    background-color: #ccc;
                                    transition: background-color 0.3s;
                                }

                                .dot.active {
                                    background-color: var(--primary);
                                }
                            </style>

                            <!-- JavaScript -->
                            <script>
                                const container = document.getElementById('scrollContainer');
                                const dots = document.querySelectorAll('.dot');

                                container.addEventListener('wheel', function(e) {
                                    if (e.deltaY !== 0) {
                                        e.preventDefault();
                                        container.scrollLeft += e.deltaY;
                                    }
                                }, {
                                    passive: false
                                });

                                container.addEventListener('scroll', () => {
                                    const scrollLeft = container.scrollLeft;
                                    const totalWidth = container.scrollWidth - container.clientWidth;

                                    const activeIndex = Math.round((scrollLeft / totalWidth) * (dots.length - 1));

                                    dots.forEach((dot, index) => {
                                        dot.classList.toggle('active', index === activeIndex);
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- 
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script> --}}
@endsection
