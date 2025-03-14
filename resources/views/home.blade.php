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
                                                    <h4 class="heading mb-0">{{ $user->nip }}</h4>
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
                    <div class="row d-flex flex-column flex-md-row-reverse">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-8">
                            <div class="card bubles hover-card shadow-lg border-0 pb-0"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="buy-coin bubles-down">
                                        <div>
                                            <h2 class="mb-2" style="font-size: 30px;">Quick & Easy <br>Repair Request!
                                            </h2>
                                            <p>
                                                Ajukan repair dengan cepat dan mudah! Tanpa ribet, respons cepat, dan solusi
                                                tepat untuk
                                                setiap masalah Anda.
                                            </p>
                                        </div>
                                        <div class="coin-img d-none d-md-block">
                                            <img src="{{ asset('') }}assets/images/coin.png" class="img-fluid"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card card-wiget">
                                            <div class="card-body">
                                                <div class="card-wiget-info pl-4">
                                                    <h4 class="count-num mt-4 mb-2" style="font-size: 28px;">LogisHub</h4>
                                                    <p>Request Cepat, Stok Tepat – Manajemen Tanpa Batas!</p>
                                                    <div class="d-flex align-items-center">
                                                        <a href="https://www.sumenepkab.go.id/" target="_blank">
                                                            <img width="30" height="30" viewBox="0 0 30 30"
                                                                src="{{ asset('') }}assets/images/about.png"
                                                                class="d-block mx-auto me-1 img-fluid " alt="" />
                                                        </a>
                                                        <button type="button" class="btn btn-link text-primary"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Read
                                                            more</button>
                                                    </div>
                                                </div>
                                                <div id="NewCustomers"></div>
                                            </div>
                                            <div class="back-icon">
                                                <img width="84" height="127" style="opacity: 0.08;"
                                                    src="{{ asset('assets/images/about.png') }}"
                                                    class="d-block mx-auto me-1 img-fluid" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card card-wiget">
                                            <div class="card-body">
                                                <div class="card-wiget-info rewards">
                                                    <h4 class="count-num">+{{ $totalQuantity }} <span
                                                            style="font-size: 13px;">Total Item</span></h4>
                                                    <p>Manajemen Item & Aset</p>
                                                    <div class="d-flex align-items-baseline reward-earn">
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
                                            <div class="back-icon">
                                                <svg width="115" height="123" viewBox="0 0 115 123" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.05">
                                                        <path
                                                            d="M15.3627 66.1299L0.487194 95.8762C-0.228022 97.3054 -0.151221 99.0034 0.687599 100.362C1.52882 101.719 3.00965 102.546 4.60689 102.546H26.9838L40.4097 120.447C41.2821 121.614 42.6514 122.29 44.0926 122.29C46.0066 122.29 47.5151 121.148 48.2159 119.744L62.2334 91.7073C43.2814 89.8952 26.5722 80.2854 15.3627 66.1299Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M137.06 95.8762L122.184 66.1299C110.975 80.2854 94.2658 89.8952 75.3137 91.7073L89.3324 119.744C90.0321 121.148 91.5405 122.29 93.4545 122.29C94.8958 122.29 96.2662 121.614 97.1386 120.447L110.563 102.546H132.94C134.537 102.546 136.018 101.719 136.86 100.362C137.698 99.0034 137.775 97.3054 137.06 95.8762Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M76.4862 10.3573L68.7736 -1.96338L61.0634 10.3573C60.431 11.3677 59.4314 12.0937 58.2758 12.383L44.1766 15.9098L53.5105 27.0509C54.2761 27.9641 54.6577 29.1389 54.5749 30.3282L53.5705 44.8269L67.0504 39.3932C67.6912 39.1352 69.0016 38.7908 70.4956 39.3932L83.9768 44.8269L82.9735 30.3282C82.8919 29.1389 83.2735 27.9641 84.0392 27.0509L93.373 15.9098L79.2738 12.383C78.1182 12.0937 77.1186 11.3677 76.4862 10.3573Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M127.676 23.9022C127.676 -8.57659 101.252 -35 68.7736 -35C36.2949 -35 9.87146 -8.57659 9.87146 23.9022C9.87146 56.3797 36.2949 82.8043 68.7736 82.8043C101.252 82.8043 127.676 56.3809 127.676 23.9022ZM105.166 16.1848L92.2966 31.5451L93.679 51.5352C93.7882 53.1192 93.0754 54.6481 91.7914 55.5817C90.5061 56.5141 88.8321 56.7205 87.3596 56.1277L68.7736 48.6359L50.1876 56.1277C49.6896 56.3281 47.7059 56.9977 45.7559 55.5817C44.4719 54.6481 43.759 53.1192 43.8682 51.5352L45.2531 31.5451L32.384 16.186C31.364 14.968 31.0424 13.3119 31.5332 11.8023C32.024 10.2926 33.2576 9.14062 34.7984 8.75541L54.2365 3.8929L64.8675 -13.0935C65.71 -14.4387 67.186 -15.2559 68.7736 -15.2559C70.3613 -15.2559 71.8373 -14.4387 72.6797 -13.0935L83.3132 3.8929L102.751 8.75541C104.292 9.14062 105.526 10.2926 106.016 11.8023C106.507 13.3119 106.186 14.968 105.166 16.1848Z"
                                                            fill="#9568FF" />
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian khusus user -->
                <div class="container mt-2">
                    <div class="row d-flex flex-column flex-md-row-reverse">
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card bg-secondary email-susb hover-card"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); border-radius: 20px;">
                                <div class="card-body text-center">
                                    <div style="width: 100%; max-width: 500px; overflow: hidden;">
                                        <img src="{{ asset('assets/images/metaverse.png') }}" alt=""
                                            style="width: 65%; height: auto; object-fit: cover;">
                                    </div>
                                    <div class="toatal-email mt-0">
                                        <h5>Butuh Perbaikan Kami Siap Melayani!</h5>
                                    </div>
                                    <a href="#" class="btn btn-primary email-btn p-2" data-bs-toggle="modal"
                                        data-bs-target="#tradeModal">Hubungi Kami</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-sm-6">
                            <div class="card" style="background: transparent; box-shadow: none; border: none;">
                                <div class="card-body pt-0">
                                    <h1 class="mb-4 mt-0" style="color: var(--secondary)">Completed Repairs</h1>

                                    <div class="horizontal-scroll-wrapper" id="scrollContainer">
                                        @php
                                            $completedRepairs = $userRepairs->where('status', 'completed');
                                        @endphp

                                        @forelse ($completedRepairs as $repair)
                                            <div class="card-item">
                                                <div class="card card-content"
                                                    style="min-height: 190px; border-radius: 16px; overflow: hidden; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border: none; transition: transform 0.2s;">
                                                    <div class="card-body d-flex align-items-center p-3">
                                                        <!-- Profile Image -->
                                                        <div class="me-3">
                                                            <img src="{{ optional($repair->admin)->profile ? asset($repair->admin->profile) : asset('assets/images/no-profile.jpg') }}"
                                                                alt="Admin Profile" width="55" height="55"
                                                                style="border-radius: 50%; object-fit: cover; border: 3px solid #ddd; transition: 0.3s;">
                                                        </div>

                                                        <!-- Repair Information -->
                                                        <div>
                                                            <h6 class="mb-1"
                                                                style="font-weight: 500; color: #333; font-size: 10px;">
                                                                {{ $repair->admin->name ?? 'Admin Tidak Diketahui' }}</h6>
                                                            <small style="color: #666;font-size: 12px;">
                                                                <i class="fas fa-calendar-alt me-1"
                                                                    style="color: var(--primary); "></i>
                                                                {{ $repair->scheduled_date ? \Carbon\Carbon::parse($repair->scheduled_date)->translatedFormat('d F Y') : 'Belum Dijadwalkan' }}
                                                            </small>
                                                            <br>
                                                            <!-- Status Badge -->
                                                            <span class="badge mt-2"
                                                                style="background-color: var(--primary); color: white; margin-left:0px;">Completed</span>
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

                        <style>
                            .horizontal-scroll-wrapper {
                                overflow-x: auto;
                                white-space: nowrap;
                                scrollbar-width: none;
                                -ms-overflow-style: none;
                                scroll-behavior: smooth;
                                padding-bottom: 10px;
                            }

                            .horizontal-scroll-wrapper::-webkit-scrollbar {
                                display: none;
                            }

                            .card-item {
                                display: inline-block;
                                width: 250px;
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

                        <script>
                            const container = document.getElementById('scrollContainer');
                            const dots = document.querySelectorAll('.dot');

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
    </script>
@endsection
