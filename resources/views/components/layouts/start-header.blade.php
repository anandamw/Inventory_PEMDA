<!--**********************************
            Header start
        ***********************************-->

<style>
    .blink {
        animation: blink-animation 1s steps(5, start) infinite;
    }

    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }

    .notification-badge {
        position: absolute;
        top: 2px;
        right: 3px;
        width: 18px;
        height: 18px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        line-height: 1;
    }
</style>
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        {{ $headerText }}
                    </div>
                </div>
                <div class="navbar-nav header-right">

                    <div class="dz-side-menu">
                        @if (auth()->user()->role == 'admin')
                            <div class="sidebar-social-link">
                                <ul>
                                    <li class="nav-item dropdown notification_dropdown">
                                        <a class="nav-link position-relative" href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown">
                                            <svg width="24" height="23" viewBox="0 0 24 23" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.7071 8.56414C18.7071 9.74035 19.039 10.4336 19.7695 11.2325C20.3231 11.8211 20.5 12.5766 20.5 13.3963C20.5 14.215 20.2128 14.9923 19.6373 15.6233C18.884 16.3798 17.8215 16.8627 16.7372 16.9466C15.1659 17.0721 13.5937 17.1777 12.0005 17.1777C10.4063 17.1777 8.83505 17.1145 7.26375 16.9466C6.17846 16.8627 5.11602 16.3798 4.36367 15.6233C3.78822 14.9923 3.5 14.215 3.5 13.3963C3.5 12.5766 3.6779 11.8211 4.23049 11.2325C4.98384 10.4336 5.29392 9.74035 5.29392 8.56414V8.16515C5.29392 6.58996 5.71333 5.55995 6.577 4.55164C7.86106 3.08114 9.91935 2.19922 11.9558 2.19922H12.0452C14.1254 2.19922 16.2502 3.12359 17.5125 4.65728C18.3314 5.64484 18.7071 6.63146 18.7071 8.16515V8.56414ZM9.07367 19.1136C9.07367 18.642 9.53582 18.426 9.96318 18.3336C10.4631 18.2345 13.5093 18.2345 14.0092 18.3336C14.4366 18.426 14.8987 18.642 14.8987 19.1136C14.8738 19.5626 14.5926 19.9606 14.204 20.2134C13.7001 20.5813 13.1088 20.8143 12.4906 20.8982C12.1487 20.9397 11.8128 20.9407 11.4828 20.8982C10.8636 20.8143 10.2723 20.5813 9.76938 20.2125C9.37978 19.9606 9.09852 19.5626 9.07367 19.1136Z"
                                                    fill="#130F26" />
                                            </svg>

                                            @if ($lowStockCount > 0 || $pendingAssetCount > 0)
                                                <span class="badge bg-danger rounded-circle blink notification-badge">
                                                    {{ $lowStockCount + $pendingAssetCount }}
                                                </span>
                                            @endif

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end custom-tab-1"
                                            data-bs-auto-close="outside" id="dropdownMenu">
                                            <ul class="nav nav-tabs justify-content-center w-100">
                                                <!-- Menengahkan dan buat full width -->
                                                <li class="nav-item w-50 text-center">
                                                    <!-- Membuat tab rata dan sejajar -->
                                                    <a class="nav-link active" style="background: none;"
                                                        data-bs-toggle="tab" href="#items">Items</a>
                                                </li>
                                                <li class="nav-item w-50 text-center">
                                                    <a class="nav-link" style="background: none;" data-bs-toggle="tab"
                                                        href="#assets">Aset</a>
                                                </li>
                                            </ul>


                                            <div class="tab-content p-3" style="height:380px; overflow-y:auto;">
                                                <div id="items" class="tab-pane show active"> <!-- Removed fade -->
                                                    <ul class="timeline">
                                                        @forelse ($lowStockItems as $item)
                                                            <li>
                                                                <div class="timeline-panel d-flex align-items-center">
                                                                    <div class="media me-3">
                                                                        <a href="{{ url('/inventory') }}">
                                                                            <img src="{{ $item->img_item ? asset('uploads/items/' . $item->img_item) : asset('assets/images/no-image.png') }}"
                                                                                alt="Item Image" width="50"
                                                                                style="border-radius: 20%">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h6 class="mb-1">{{ $item->item_name }}</h6>
                                                                        <small class="d-block">{{ $item->code_item }} ||
                                                                            Stok: {{ $item->quantity }}</small>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @empty
                                                            <li>
                                                                <div class="timeline-panel">
                                                                    <div class="media-body">
                                                                        <h6 class="mb-1">Tidak ada item dengan stok
                                                                            rendah</h6>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforelse
                                                    </ul>
                                                </div>

                                                <div id="assets" class="tab-pane"> <!-- Removed fade -->
                                                    <ul class="timeline">
                                                        @forelse ($pendingAssets as $asset)
                                                            <li>
                                                                <div class="timeline-panel d-flex align-items-center">
                                                                    <!-- Tambahkan d-flex untuk flexbox -->
                                                                    <div class="media me-3">
                                                                        <a href="{{ url('/aset') }}">
                                                                            <img src="{{ $asset->image ? asset('uploads/aset/' . $asset->image) : asset('assets/images/no-image.png') }}"
                                                                                alt="Item Image" width="50"
                                                                                style="border-radius: 20%">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body flex-grow-1">
                                                                        <!-- flex-grow-1 agar teks menyesuaikan lebar -->
                                                                        <h6 class="mb-1">{{ $asset->name }} || <span
                                                                                class="text-danger">{{ $asset->status }}</span>
                                                                        </h6>
                                                                        <small
                                                                            class="d-block">{{ $asset->description }}</small>
                                                                    </div>
                                                                </div>

                                                            </li>
                                                        @empty
                                                            <li>
                                                                <div class="timeline-panel">
                                                                    <div class="media-body">
                                                                        <h6 class="mb-1">Tidak ada aset yang pending
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var tabs = document.querySelectorAll(".nav-link");
                                                tabs.forEach(tab => {
                                                    tab.addEventListener("click", function(event) {
                                                        event.stopPropagation(); // Mencegah dropdown tertutup saat tab diklik
                                                        setTimeout(() => {
                                                            let activeTab = document.querySelector(".tab-pane.active");
                                                            activeTab.style.opacity = "1";
                                                        }, 100);
                                                    });
                                                });

                                                // Mencegah dropdown tertutup saat kontennya diklik
                                                document.getElementById("dropdownMenu").addEventListener("click", function(event) {
                                                    event.stopPropagation();
                                                });
                                            });
                                        </script>

                                    </li>
                                    <li class="nav-item dropdown notification_dropdown">
                                        <a class="nav-link position-relative" href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4 4H20C21.1 4 22 4.9 22 6V16C22 17.1 21.1 18 20 18H7L3 22V6C3 4.9 3.9 4 5 4Z"
                                                    fill="#130F26" />
                                            </svg>

                                            @if ($overdueRepairsCount > 0)
                                                <span class="badge bg-danger rounded-circle blink notification-badge">
                                                    {{ $overdueRepairsCount }}
                                                </span>
                                            @endif

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end custom-tab-1"
                                            data-bs-auto-close="outside" id="dropdownMenu">
                                            <ul class="nav nav-tabs justify-content-center w-100">
                                                <li class="nav-item w-50 text-center">
                                                    <a class="nav-link active" style="background: none;"
                                                        data-bs-toggle="tab" href="#items">Pesan</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content p-3" style="height:380px; overflow-y:auto;">
                                                <div id="items" class="tab-pane show active">
                                                    @if ($overdueRepairs->isNotEmpty())
                                                        <ul class="timeline">
                                                            @foreach ($overdueRepairs as $item)
                                                                <li>
                                                                    <div
                                                                        class="timeline-panel d-flex align-items-center">
                                                                        <div class="media me-3">
                                                                            <a href="{{ url('/inventory') }}">
                                                                                <img src="{{ asset('assets/images/warning.jpg') }}"
                                                                                    alt="Item Image" width="50"
                                                                                    style="border-radius: 20%;">
                                                                            </a>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1 text-primary">
                                                                                {{ $item->reporter_name }} |
                                                                                {{ $item->scheduled_date }}
                                                                            </h6>
                                                                            <small class="d-block text-black fw-bold">  
                                                                                {{ $item->repair }} | Team :
                                                                                <strong
                                                                                    class="text-danger">{{ $item->team_names }}</strong>
                                                                            </small>
                                                                            <p class="fw-bold"> Tidak melaksanakan tugasnya</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <div class="timeline-panel text-center">
                                                            <h6 class="mb-1">Tidak ada Pesan</h6>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            // Pastikan dropdown tidak tertutup saat tab atau isi dropdown diklik
                                            document.querySelectorAll(".nav-link").forEach(tab => {
                                                tab.addEventListener("click", function(event) {
                                                    event.stopPropagation(); // Mencegah dropdown tertutup saat tab diklik
                                                    setTimeout(() => {
                                                        let activeTab = document.querySelector(".tab-pane.active");
                                                        if (activeTab) {
                                                            activeTab.style.opacity = "1";
                                                        }
                                                    }, 100);
                                                });
                                            });

                                            // Cegah dropdown tertutup saat klik di dalam dropdown
                                            let dropdownMenu = document.getElementById("dropdownMenu");
                                            if (dropdownMenu) {
                                                dropdownMenu.addEventListener("click", function(event) {
                                                    event.stopPropagation();
                                                });
                                            }
                                        });
                                    </script>

                                </ul>
                            </div>
                        @endif
                        @if (auth()->check() && auth()->user()->role == 'opd')
                            <ul>
                                <li class="nav-item dropdown notification_dropdown position-relative">
                                    <a class="nav-link position-relative" href="#" role="button"
                                        data-bs-toggle="modal" data-bs-target="#tradeModal">
                                        <svg width="24" height="23" viewBox="0 0 24 23" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.6 10.8C8.3 13.9 10.7 16.3 13.8 18L16 15.8C16.3 15.5 16.8 15.4 17.2 15.6C18.4 16 19.7 16.2 21 16.2C21.6 16.2 22 16.6 22 17.2V21C22 21.6 21.6 22 21 22C10.5 22 2 13.5 2 3C2 2.4 2.4 2 3 2H6.8C7.4 2 7.8 2.4 7.8 3C7.8 4.3 8 5.6 8.4 6.8C8.6 7.2 8.5 7.7 8.2 8L6.6 10.8Z"
                                                fill="#130F26" />
                                        </svg>
                                        @if ($scheduledRepairsCount > 0)
                                            <span class="badge bg-danger rounded-circle blink notification-badge">
                                                {{ $scheduledRepairsCount }}
                                            </span>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        @endif

                        <ul></ul>
                        <ul>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button"
                                    data-bs-toggle="dropdown">
                                    <img width="50" height="50"
                                        src="{{ Auth::user()->profile ? asset(Auth::user()->profile) : asset('uploads/profile/no-profile.jpg') }}"
                                        alt="User Profile">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a href="/profile" class="dropdown-item ai-icon ">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                    fill="var(--primary)" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    <a href="/logout" class="dropdown-item ai-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="var(--primary)"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12">
                                            </line>
                                        </svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tradeModal" tabindex="-1" aria-labelledby="tradeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <nav class="buy-sell">
                    <div class="nav nav-tabs" id="nav-tab2" role="tablist">
                        <button class="nav-link active" id="nav-buy-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-buy" type="button" role="tab" aria-controls="nav-buy"
                            aria-selected="true">Perbaikan</button>
                        <button class="nav-link d-flex align-items-center justify-content-center gap-1"
                            id="nav-sell-tab" data-bs-toggle="tab" data-bs-target="#nav-sell" type="button"
                            role="tab" aria-controls="nav-sell" aria-selected="false" style="height: 100%;">
                            Pemberitahuan
                            @if ($scheduledRepairsCount > 0)
                                <span class="badge bg-danger rounded-circle blink"
                                    style="
                                font-size: 8px;
                                width: 14px; /* agak dinaikin biar muat angka */
                                height: 14px;
                                aspect-ratio: 1 / 1; /* ini kunci agar bentuknya lingkaran sempurna */
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                transform: translateY(-5px);
                                padding: 0;
                                line-height: 1;">
                                    {{ $scheduledRepairsCount }}
                                </span>
                            @endif
                        </button>

                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-buy" role="tabpanel"
                        aria-labelledby="nav-buy-tab">
                        <div class="row">
                            <!-- Kiri: Detail Profil -->
                            <div class="col-md-4">
                                <div class="card card-bx profile-card author-profile mb-1">
                                    <div class="card-body text-center">
                                        <div class="author-profile">
                                            <div class="author-media mt-3">
                                                <img src="{{ auth()->user()->profile ? asset(auth()->user()->profile) : asset('assets/images/no-profile.jpg') }}"
                                                    alt="Profile Picture" class="img-fluid rounded-circle">
                                                <div class="author-info mt-2">
                                                    <h6 class="title">{{ auth()->user()->name }}</h6>
                                                    <span>{{ auth()->user()->nip }}</span>
                                                    <span>{{ auth()->user()->instansi->nama_instansi ?? 'Tidak ada instansi' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kanan: Form Input -->
                            <div class="col-md-8">
                                <form action="{{ route('repair.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Perihal :</label>
                                        <div class="input-group">
                                            <textarea class="form-control" name="repair" placeholder="Masukkan Masalah Perbaikan..." style="height: 200px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-75">Kirim</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-sell" role="tabpanel" aria-labelledby="nav-sell-tab">
                        @php
                            // Filter hanya repair yang belum completed
                            $pendingRepairs = $userRepairs->sortByDesc('scheduled_date');
                        @endphp

                        <ul class="list-unstyled">
                            @foreach ($pendingRepairs as $repair)
                                <li>
                                    <div class="timeline-panel d-flex align-baseline justify-content-start flex-column p-3"
                                        style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); text-align: left;">
                                        <div class="d-flex align-items-center">
                                            <div class="media me-3">
                                                <a href="#">
                                                    <img src="{{ optional($repair->admin)->profile ? asset($repair->admin->profile) : asset('assets/images/no-profile.jpg') }}"
                                                        alt="Item Image" width="50" height="50"
                                                        style="border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1" style="font-weight: 600; color: #333;">
                                                    {{ $repair->admin->name ?? 'Admin Tidak Diketahui' }}
                                                </h6>
                                                <small class="d-block">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $repair->scheduled_date ? \Carbon\Carbon::parse($repair->scheduled_date)->translatedFormat('d F Y') : 'Belum Dijadwalkan' }}
                                                    - <span
                                                        style="color: {{ $repair->status == 'completed' ? 'green' : ($repair->status == 'scheduled' ? 'orange' : '#6c757d') }};">{{ $repair->status }}</span>
                                                </small>
                                            </div>
                                        </div>
                                        <style>
                                            .star-rating {
                                                direction: rtl;
                                                display: inline-flex;
                                            }

                                            .star-rating input {
                                                display: none;
                                            }

                                            .star-rating label {
                                                font-size: 2rem;
                                                color: gray;
                                                cursor: pointer;
                                                transition: color 0.3s ease-in-out;
                                            }

                                            .star-rating input:checked~label,
                                            .star-rating label:hover,
                                            .star-rating label:hover~label {
                                                color: gold;
                                            }
                                        </style>

                                        <div class="ms-4">
                                            <form id="ratingForm-{{ $repair->id_repair }}" method="POST"
                                                class="rating-form">
                                                <input type="hidden" name="id_item"
                                                    value="{{ $repair->id_repair }}">
                                                @php
                                                    $isReadOnly =
                                                        isset($repair->repairTeam) && $repair->repairTeam->rating;
                                                @endphp
                                                @if ($repair->repairTeam && $repair->repairTeam->status == 'completed')
                                                    <!-- Rating Bintang -->
                                                    <div class="star-rating d-flex justify-content-end ms-5"
                                                        data-rating="{{ optional($repair->repairTeam)->rating ?? 0 }}">
                                                        @for ($i = 6; $i >= 1; $i--)
                                                            <input type="radio" name="rating"
                                                                id="star{{ $i }}-{{ $repair->id_repair }}"
                                                                value="{{ $i }}"
                                                                {{ optional($repair->repairTeam)->rating == $i ? 'checked' : '' }}
                                                                {{ $isReadOnly ? 'disabled' : '' }}>
                                                            <label
                                                                for="star{{ $i }}-{{ $repair->id_repair }}">&#9733;</label>
                                                        @endfor
                                                    </div>
                                                @endif
                                                <!-- Komentar -->
                                                <div class="d-flex align-items-center justify-content-start "
                                                    style="margin-left: 50px">
                                                    @if (!$isReadOnly && optional($repair->repairTeam)->status == 'completed')
                                                        <textarea class="form-control" name="comment" id="comment-{{ $repair->id_repair }}" rows="3"
                                                            placeholder="Tulis komentar Anda..." {{ $isReadOnly ? 'readonly' : '' }}>{{ optional($repair->repairTeam)->comment }}</textarea>
                                                    @else
                                                        @if ($repair->repairTeam && $repair->repairTeam->status == 'completed')
                                                            Komentar: <p class="fw-bold mb-0 me-2">
                                                                {{ optional($repair->repairTeam)->comment }}</p>
                                                        @endif
                                                    @endif
                                                </div>

                                                @if (!$isReadOnly && optional($repair->repairTeam)->status == 'completed')
                                                    <button type="submit"
                                                        class="btn btn-primary mt-3 ms-5">Kirim</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
                            Header end ti-comment-alt
                        ***********************************-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $(".rating-form").submit(function(event) {
            event.preventDefault(); // Mencegah refresh halaman

            var form = $(this);
            var formData = form.serialize();
            var repairId = form.find("input[name='id_item']").val();

            $.ajax({
                url: "{{ route('update.rating.comment') }}",
                type: "POST",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    if (response.message) {
                        $("#responseMessage-" + repairId).html(
                            '<div class="alert alert-success">' + response.message +
                            '</div>');

                        // Update tampilan rating & komentar tanpa refresh
                        $("#displayRating-" + repairId).text(response.rating ? response
                            .rating : "-");
                        $("#displayComment-" + repairId).text(response.comment ? response
                            .comment : "-");

                        // Cek radio button untuk update bintang
                        $("input[name='rating'][value='" + response.rating + "']").prop(
                            "checked", true);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".star-rating").forEach(function(ratingDiv) {
            let rating = ratingDiv.getAttribute("data-rating");
            let labels = ratingDiv.querySelectorAll("label");

            labels.forEach((label, index) => {
                let value = labels.length - index;
                if (value <= rating) {
                    label.style.color = "gold";
                }
            });
        });
    });
</script>
