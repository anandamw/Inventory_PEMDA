@extends('components.template')

@section('content')

    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        }
    </style>



    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card bubles hover-card shadow-lg border-0 pb-0"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="buy-coin bubles-down">
                                        <div>
                                            <h2>Grab Items Easy & Fast! </h2>
                                            <p>
                                                Permudah ambil barang dengan sistem yang cepat dan transparan. Klik untuk
                                                memulai!
                                            </p>
                                            <a href="/item" class="btn btn-primary">Ambil Barang</a>
                                        </div>
                                        <div class="coin-img d-none d-md-block">
                                            <img src="{{ asset('') }}assets/images/coin.png" class="img-fluid"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-12 col-sm-12 wow fadeInRight" data-wow-delay="0.3s">
                            <div class="card digital-cash shadow-lg border-0 pb-0 hover-card"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0 heading">About</h4>
                                    <div class="dropdown custom-dropdown mb-0 tbl-orders-style">
                                    </div>
                                </div>
                                <div class="card-body py-0">
                                    <div class="d-flex align-items-center">
                                        <!-- Gambar di kiri -->
                                        <div class="me-3">
                                            <a href="https://www.sumenepkab.go.id/" target="_blank">
                                                <img src="{{ asset('') }}assets/images/about.png"
                                                    class="d-block mx-auto img-fluid" alt=""
                                                    style="max-width: 70%; height: auto;" />
                                            </a>
                                        </div>
                                        <!-- Deskripsi di kanan -->
                                        <div>
                                            <h4 class="fs-20 font-w700 text-black mb-0">LogisHub</h4>
                                            <span class="my-2 fs-16 font-w600 d-block">Take Items, Everything Becomes
                                                Easier!</span>
                                            <p class="text-start">Website pengambilan barang: Solusi cepat, transparan, dan
                                                efisien untuk mengelola dan mempermudah proses pengambilan barang milik
                                                instansi, dengan fitur pelacakan dan pengajuan yang mudah diakses.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-2 border-0">
                                    <button type="button" class="btn btn-link text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">Read more</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4">
                    <div class="col-xl-12 col-lg-6">
                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'team')
                            <div class="card bg-primary text-white shadow-lg position-relative overflow-hidden hover-card"
                                style="border: 1px solid rgba(255, 255, 255, 0.3); box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); border-radius: 20px;">

                                <div class="card-header border-0 pb-0">
                                    <div>
                                        <h2 class="heading mb-0 text-white">Data Item</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive" style="max-height: 210px; overflow-y: auto;">
                                        <table class="table table-sell verticle-middle mb-0">
                                            <thead
                                                style="position: sticky; top: 0; background-color: rgba(255, 255, 255, 0.9);  z-index: 2;">
                                                <tr class="text-dark">
                                                    <th scope="col">Code</th>
                                                    <th class="text-center" scope="col">Item</th>
                                                    <th class="text-end" scope="col">Stok</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($dataItem as $item)
                                                    <tr class="text-white">
                                                        <td>{{ $item->code_item }}</td>
                                                        <td class="text-center">{{ $item->item_name }}</td>
                                                        <td class="text-end">{{ $item->quantity }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (auth()->user()->role == 'admin')

                            <div class="card border-0 shadow-lg pb-0 hover-card"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); border-radius: 20px;">
                                <div class="card-header border-0 pb-0">
                                    <h5 class="card-title heading">Messages</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div id="DZ_W_Todo3" class="widget-media dz-scroll height200 my-4 px-4">
                                        @php
                                            $pendingRepairs = $repairs->filter(function ($repair) {
                                                return $repair->status != 'completed';
                                            });
                                        @endphp

                                        @if ($pendingRepairs->isEmpty())
                                            <!-- Tampilkan gambar no-messages ketika tidak ada repair yang belum selesai -->
                                            <div class="text-center my-4">
                                                <img src="{{ asset('assets/images/no-messages.png') }}" alt="No Messages"
                                                    style="width: 130px;">
                                            </div>
                                        @else
                                            <ul class="timeline">
                                                @foreach ($pendingRepairs as $repair)
                                                    <li>
                                                        <div class="timeline-panel">
                                                            <div
                                                                class="d-flex align-items-center justify-content-center me-2">
                                                                <img class=" rounded-3" alt="image" width="50"
                                                                    src="{{ $repair->user->profile ? asset($repair->user->profile) : asset('assets/images/no-profile.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <h5 class="mb-1">{{ $repair->user->name }}
                                                                </h5>
                                                                <!-- Baris baru untuk jadwal (jika ada) -->
                                                                @if ($repair->scheduled_date)
                                                                    <small class="d-block text-success">
                                                                        On
                                                                        {{ \Carbon\Carbon::parse($repair->scheduled_date)->format('d-m-Y') }}
                                                                        by <span
                                                                            class="text-danger">{{ $repair->admin->name ?? 'Unknown Admin' }}</span>
                                                                    </small>
                                                                @endif

                                                                <p class="mb-1">{{ $repair->repair }}</p>
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <button class="btn btn-primary btn-xs shadow"
                                                                        onclick="openScheduleModal({{ $repair->id_repair }})">
                                                                        Reply
                                                                    </button>

                                                                    <a href="{{ route('repair.delete', $repair->id_repair) }}"
                                                                        class="btn btn-danger btn-xs">
                                                                        Delete
                                                                    </a>

                                                                    @php
                                                                        $repairData = [
                                                                            'user' => [
                                                                                'name' => $repair->user->name,
                                                                                'instansi' =>
                                                                                    $repair->user->instansi
                                                                                        ->nama_instansi ??
                                                                                    'Tidak ada instansi',
                                                                                'nip' => $repair->user->nip,
                                                                            ],
                                                                            'repair' => $repair->repair,
                                                                            'scheduled_date' => \Carbon\Carbon::parse(
                                                                                $repair->scheduled_date,
                                                                            )->translatedFormat('d F Y'),
                                                                            'teams' => $repair->teams
                                                                                ->pluck('name')
                                                                                ->toArray(), // ambil nama tim aja
                                                                        ];
                                                                    @endphp

                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-info btn-xs btn-warning"
                                                                        onclick="openTeamModal({{ $repair->id_repair }})"
                                                                        data-repair='@json($repairData)'>
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>


                                                                </div>
                                                            </div>



                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <!-- Garis pembatas di akhir -->
                                            <div class="border-top pt-3 text-center text-muted mt-3"></div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            <!-- Modal Perbaikan -->
                            <div class="modal fade" id="repairActionModal" tabindex="-1"
                                aria-labelledby="repairActionModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> <!-- Tambah kelas modal-lg biar besar -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="repairActionModalLabel">Atur Jadwal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="repair_id" name="repair_id">

                                            <!-- Form untuk atur perbaikan (misal isi tanggal dan catatan) -->
                                            <form id="scheduleRepairForm" action="" method="POST">
                                                @csrf
                                                <input type="hidden" id="form_repair_id" name="repair_id">
                                                <div class="mb-3">
                                                    <label for="scheduled_date">Atur Tanggal Perbaikan</label>
                                                    <input type="date" name="scheduled_date" class="form-control"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="team_id">Pilih Tim</label><small class="text-muted">
                                                        (Centang tim yang mau diberangkatkan.)</small>

                                                    <!-- Input filter cari tim -->
                                                    <input type="text" id="teamSearch" class="form-control mb-2"
                                                        placeholder="Cari nama tim...">

                                                    <div class="border p-2" style="max-height: 200px; overflow-y: auto;"
                                                        id="teamList">
                                                        @foreach ($teams as $team)
                                                            <div class="form-check team-item">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="team_ids[]" value="{{ $team->id }}"
                                                                    id="team_{{ $team->id }}">
                                                                <label class="form-check-label"
                                                                    for="team_{{ $team->id }}">
                                                                    {{ $team->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-end">
                                            <button type="button" class="btn btn-warning me-2"
                                                onclick="submitForm()">Atur Jadwal</button>
                                            {{-- <button type="button" class="btn btn-primary me-2"
                                                onclick="completeRepair()">Perbaikan Selesai</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (auth()->user()->role == 'opd')
                            <!-- Bagian khusus user -->
                            <div class="col-xl-12 col-sm-6">
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
                        @else
                            <div class="card border-0 shadow-lg pb-0 hover-card"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); border-radius: 20px;">
                                <div class="card-header border-0 pb-0">
                                    <h5 class="card-title heading">Messages</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div id="DZ_W_Todo3" class="widget-media dz-scroll height200 my-4 px-4">

                                        @if ($teamRepairs->isEmpty())
                                            <div class="text-center my-4">
                                                <img src="{{ asset('assets/images/no-messages.png') }}" alt="No Messages"
                                                    style="width: 130px;">
                                            </div>
                                        @else
                                            <ul class="timeline">
                                                @foreach ($teamRepairs as $repair)
                                                    <li>
                                                        <div class="timeline-panel p-3 border rounded shadow-sm">
                                                            <div class="d-flex align-items-start mb-2">
                                                                <div class="media me-2">
                                                                    🛠️
                                                                </div>
                                                                <div class="media-body">
                                                                    <h7 class="mb-1 fw-bold">
                                                                        Perbaikan Dijadwalkan pada Anda
                                                                    </h7>
                                                                    <small class="text-success d-block">
                                                                        <span><i class="fas fa-calendar-alt"></i>
                                                                            {{ \Carbon\Carbon::parse($repair->scheduled_date)->translatedFormat('d F Y') }}</span>
                                                                        | <span><strong>
                                                                                {{ $repair->user->instansi->nama_instansi ?? '-' }}</strong></span>
                                                                    </small>
                                                                    <small class="text-muted d-block">
                                                                        <strong>Diminta oleh:
                                                                        </strong>{{ $repair->user->name ?? '-' }} (NIP:
                                                                        {{ $repair->user->nip ?? '-' }})
                                                                    </small>
                                                                    <small class="text-muted d-block mb-2">
                                                                        <strong>Permintaan:
                                                                        </strong>{{ $repair->repair ?? 'Tidak ada deskripsi' }}
                                                                    </small>
                                                                    <div class="d-flex align-items-center gap-2 mt-2">
                                                                        <form
                                                                            action="{{ route('repairs.complete', $repair->id_repair) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm">Selesai</button>
                                                                        </form>

                                                                        @php
                                                                            $repairData = [
                                                                                'user' => [
                                                                                    'name' => $repair->user->name,
                                                                                    'instansi' =>
                                                                                        $repair->user->instansi
                                                                                            ->nama_instansi ??
                                                                                        'Tidak ada instansi',
                                                                                    'nip' => $repair->user->nip,
                                                                                ],
                                                                                'repair' => $repair->repair,
                                                                                'scheduled_date' => \Carbon\Carbon::parse(
                                                                                    $repair->scheduled_date,
                                                                                )->translatedFormat('d F Y'),
                                                                                'teams' => $repair->teams
                                                                                    ->pluck('name')
                                                                                    ->toArray(),
                                                                            ];
                                                                        @endphp

                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-warning btn-xs"
                                                                            onclick="openTeamModal({{ $repair->id_repair }})"
                                                                            data-repair='@json($repairData)'>
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>

                </div>
            </div>




            <!-- Modal Global di luar Loop -->
            <div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content rounded-3 border border-primary">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white"><i class="fas fa-info-circle"></i> Detail Tim dan Jadwal
                                Perbaikan
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <h6 class="text-primary"><i class="fas fa-user"></i> Data Pelapor</h6>
                                <div class="p-3 border rounded bg-light opacity-50 text-white">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Nama:</strong> <span id="modalPelaporNama" class="text-white"></span>
                                        </li>
                                        <li><strong>Instansi:</strong> <span id="modalPelaporInstansi"
                                                class="text-white"></span></li>
                                        <li><strong>NIP:</strong> <span id="modalPelaporNip" class="text-white"></span>
                                        </li>
                                        <li><strong>Problem:</strong> <span id="modalPelaporRepair"
                                                class="text-white"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-primary"><i class="fas fa-calendar-alt"></i> Jadwal Perbaikan</h6>
                                <div class="p-3 border rounded bg-light opacity-50 text-white">
                                    <p class="mb-0">
                                        <strong>Tanggal:</strong> <span id="modalTanggalPerbaikan"
                                            class="text-white"></span>
                                    </p>
                                </div>
                            </div>

                            <div>
                                <h6 class="text-primary"><i class="fas fa-users"></i> Tim yang Diberangkatkan</h6>
                                <div class="p-3 border rounded bg-light opacity-50 text-white">
                                    <ul id="modalTimList" class="list-unstyled mb-0"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('teamSearch').addEventListener('keyup', function() {
                    let filter = this.value.toLowerCase();
                    let teamItems = document.querySelectorAll('#teamList .team-item');

                    teamItems.forEach(function(item) {
                        let label = item.querySelector('label').textContent.toLowerCase();
                        if (label.includes(filter)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            </script>

            <script>
                // Buka modal dan simpan repair_id
                function openScheduleModal(repairId) {
                    document.getElementById('form_repair_id').value = repairId;

                    let form = document.getElementById('scheduleRepairForm');
                    form.action = `/repair/schedule/${repairId}`;

                    var repairModal = new bootstrap.Modal(document.getElementById('repairActionModal'));
                    repairModal.show();
                }


                // Menampilkan form atur perbaikan
                function showScheduleForm() {
                    document.getElementById('scheduleRepairForm').style.display = 'block';
                }

                function submitForm() {
                    document.getElementById('scheduleRepairForm').submit();
                }

                // Perbaikan selesai
                function completeRepair() {
                    const repairId = document.getElementById('form_repair_id').value; // Ambil dari modal
                    if (confirm('Tandai perbaikan ini sebagai selesai?')) {
                        window.location.href = `/repair/complete/${repairId}`;
                    }
                }
            </script>

            <!-- Script untuk handle klik dan isi modal -->
            <script>
                function openTeamModal(repairId) {
                    const button = document.querySelector(`[onclick="openTeamModal(${repairId})"]`);
                    const repairData = JSON.parse(button.getAttribute('data-repair'));

                    // Isi data ke dalam modal
                    document.getElementById('modalPelaporNama').innerText = repairData.user.name;
                    document.getElementById('modalPelaporInstansi').innerText = repairData.user.instansi;
                    document.getElementById('modalPelaporNip').innerText = repairData.user.nip;
                    document.getElementById('modalTanggalPerbaikan').innerText = repairData.scheduled_date;
                    document.getElementById('modalPelaporRepair').innerText = repairData.repair;

                    const teamList = document.getElementById('modalTimList');
                    teamList.innerHTML = '';

                    if (repairData.teams.length > 0) {
                        repairData.teams.forEach(team => {
                            const li = document.createElement('li');
                            li.innerText = team;
                            teamList.appendChild(li);
                        });
                    } else {
                        teamList.innerHTML = '<li class="text-muted">Belum ada tim yang diberangkatkan.</li>';
                    }

                    // Tampilkan modalnya
                    const modal = new bootstrap.Modal(document.getElementById('teamModal'));
                    modal.show();
                }
            </script>


            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'team')
                <div class="col-lg-12">
                    <div class="card border-0 shadow-lg pb-0 hover-card"
                        style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); border-radius: 20px;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead class="text-white bg-primary text-center">
                                        <tr>
                                            <th class="align-middle">No</th>
                                            <th class="align-middle">Name</th>
                                            <th class="align-middle pe-7">Acara</th>
                                            <th class="align-middle" style="min-width: 12.5rem;">No Telepon</th>

                                            <th class="align-middle">Status</th>
                                            <th class="align-middle">Date Time</th>


                                            <th class="align-middle">Action</th>

                                        </tr>
                                    </thead>

                                    <tbody id="orders" class="text-center">
                                        @foreach ($orders as $get)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $get->name }}</td>
                                                {{-- <td>
                                                    <img src="{{ $get->img_item ? asset($get->img_item) : asset('assets/images/no-image.png') }}"
                                                        alt="Item Image" width="50">
                                                </td> --}}
                                                <td>{{ $get->events }}</td>
                                                <td>{{ $get->phone }}</td>


                                                @if ($get->status == 'success')
                                                    <td><i class="fa fa-circle text-success me-1"></i> Successful</td>
                                                @elseif($get->status == 'canceled')
                                                    <td><i class="fa fa-circle text-danger me-1"></i> Canceled</td>
                                                @elseif($get->status == 'pending')
                                                    <td><i class="fa fa-circle text-warning me-1"></i> Pending</td>
                                                @endif



                                                <td>{{ $get->created_at }}</td>


                                                <td class="text-end ps-0">
                                                    <div class="dropdown dropup d-flex justify-content-center">
                                                        <a href="javascript:void(0);"
                                                            class="btn-link btn sharp tp-btn btn-primary pill"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 9c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-9 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm18 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"
                                                                    fill="#A098AE" />
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $get->id_orders }}">
                                                                Edit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach

                                        <tr class="no-data" style="display: none;">
                                            <td colspan="7" class="text-center py-3">Tidak ada data di keranjang</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </div>



    @foreach ($orders as $item)
        <div class="modal fade" id="exampleModal{{ $item->id_orders }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengambilan #{{ $item->id_orders }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <!-- Image Section (left) -->
                                <div class="col-md-4">
                                    <img src="{{ $item->profile ? asset($item->profile) : asset('assets/images/no-profile.jpg') }}"
                                        alt="Image" class="img-fluid">
                                </div>

                                <!-- Description Section (right) -->
                                <div class="col-md-8">
                                    <h5>Nama: <span id="nama">{{ $item->name }}</span></h5>
                                    <p>NIP: <span id="nip">{{ $item->nip }}</span></p>

                                    <!-- Detail Barang (table) -->
                                    <h6>Detail Barang:</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItem->where('orders_id', $item->id_orders) as $data)
                                                <tr>
                                                    <td>{{ $data->item_name }}</td>
                                                    <td class="py-2 text-center">
                                                        @if ($data->status !== 'success')
                                                            <div class="input-group quantity-control">
                                                                <button
                                                                    class="btn btn-outline-primary btn-sm decrement">-</button>
                                                                <input type="number" name="quantity[]"
                                                                    class="form-control text-center quantity-input"
                                                                    value="{{ $data->quantity }}"
                                                                    data-q-id="{{ $data->id_order_items }}"
                                                                    min="0">
                                                                <button
                                                                    class="btn btn-outline-primary btn-sm increment">+</button>
                                                            </div>
                                                        @else
                                                            {{ $data->quantity }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex align-items-center">
                                                            @if ($data->status == 'success')
                                                                <i class="fa fa-circle text-success me-1"></i> Successful
                                                            @elseif($data->status == 'canceled')
                                                                <i class="fa fa-circle text-danger me-1"></i> Canceled
                                                            @elseif($data->status == 'pending')
                                                                <i class="fa fa-circle text-warning me-1"></i> Pending
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($orderItem->where('orders_id', $item->id_orders)->where('status', '!=', 'success')->count() > 0)
                                        <h6>Barang Yang Ditambahkan:</h6>
                                        <table class="table table-bordered" id="tableadd">
                                            <thead>
                                                <tr>

                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="emptyRow">
                                                    <td colspan="3" class="text-center">Tidak ada item ditambahkan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif

                                    <p>Acara: <span id="datetime">{{ $item->events }}</span></p>
                                </div>

                                @if ($orderItem->where('orders_id', $item->id_orders)->where('status', '!=', 'success')->count() > 0)
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <div class="search-box">
                                                    <input type="text" id="tableSearch" class="form-control"
                                                        placeholder="Search...">
                                                </div>
                                            </div>
                                            <div class="card-body" style="padding: 0 20px">
                                                <div class="table-responsive"
                                                    style="max-height: 330px; overflow-y: auto;">
                                                    <table id="mytable" class="table table-responsive-md text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Photo</th>
                                                                <th>Item</th>
                                                                <th>Stok</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($items as $getItem)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        <img src="{{ $getItem->img_item ? asset('uploads/items/' . $getItem->img_item) : asset('assets/images/no-image.png') }}"
                                                                            alt="Item Image" width="50">
                                                                    </td>
                                                                    <td>{{ $getItem->item_name }}</td>
                                                                    <td>{{ $getItem->quantity }}</td>
                                                                    <td>
                                                                        <div class="shopping-cart">
                                                                            <a class="btn btn-primary"
                                                                                href="javascript:void(0);"
                                                                                data-order-id="{{ $item->id_orders }}"
                                                                                data-inventory-id="{{ $getItem->id_inventories }}"
                                                                                onclick="updateItems({{ $item->id_orders }}, this)">
                                                                                <i class="fa fa-shopping-basket me-2"></i>
                                                                                Save
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="pagination" class="mt-3 d-flex justify-content-center"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>

                        @php
                            // Mengecek apakah ada item yang belum success
                            $hasPendingItems =
                                $orderItem
                                    ->where('orders_id', $item->id_orders)
                                    ->where('status', '!=', 'success')
                                    ->count() > 0;
                        @endphp

                        @if ($hasPendingItems)
                            <button type="button" class="btn btn-warning light" id="saveChangesBtn"
                                onclick="saveChangesData({{ $item->id_orders }})">
                                Simpan Perubahan
                            </button>

                            <button type="button" class="btn btn-primary light"
                                onclick="updateItemsStatus({{ $item->id_orders }}, 'success')">
                                Acara Selesai
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach




    {{-- acara selesai --}}
    <script>
        async function updateItemsStatus(orderId, status = null) {
            let updatedItems = [];
            let newItems = [];

            document.querySelectorAll(".quantity-input").forEach(input => {
                let itemId = input.getAttribute("data-q-id");
                let newQuantity = parseInt(input.value) || 0;

                updatedItems.push({
                    id_order_items: itemId,
                    quantity: newQuantity
                });
            });

            document.querySelectorAll("#tableadd tbody tr").forEach(row => {
                if (row.id !== "emptyRow") {
                    let inventoryId = row.dataset.inventoryId;
                    let itemName = row.cells[1].textContent.trim();
                    let quantityInput = row.querySelector(".quantity-input");
                    let quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;

                    newItems.push({
                        inventories_id: inventoryId,
                        item_name: itemName,
                        quantity: quantity,
                        orders_id: orderId,
                        status: status
                    });
                }
            });

            if (updatedItems.length === 0 && newItems.length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Tidak ada perubahan",
                    text: "Tidak ada perubahan yang disimpan."
                });
                return;
            }

            try {
                let response = await fetch("/update-order-items-status", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content")
                    },
                    body: JSON.stringify({
                        orderId: orderId,
                        updatedItems: updatedItems,
                        newItems: newItems,
                        status: status
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                let data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Perubahan berhasil disimpan!"
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    console.error("Error dari server:", data.error);
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi kesalahan",
                        text: data.error
                    });
                }
            } catch (error) {
                console.error("Fetch error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Gagal menyimpan perubahan."
                });
            }
        }
    </script>



    {{-- simpan perubahan --}}
    <script>
        async function saveChangesData(orderId) {
            let updatedItems = [];
            let newItems = [];

            document.querySelectorAll(".quantity-input").forEach(input => {
                let itemId = input.getAttribute("data-q-id");
                let newQuantity = parseInt(input.value) || 0;

                updatedItems.push({
                    id_order_items: itemId,
                    quantity: newQuantity
                });
            });

            document.querySelectorAll("#tableadd tbody tr").forEach(row => {
                if (row.id !== "emptyRow") {
                    let inventoryId = row.dataset.inventoryId;
                    let itemName = row.cells[1].textContent.trim();
                    let quantityInput = row.querySelector(".quantity-input");
                    let quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;

                    newItems.push({
                        inventories_id: inventoryId,
                        item_name: itemName,
                        quantity: quantity,
                        orders_id: orderId
                    });
                }
            });

            if (updatedItems.length === 0 && newItems.length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Tidak ada perubahan",
                    text: "Tidak ada perubahan yang disimpan."
                });
                return;
            }

            try {
                let response = await fetch("/update-order-items", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content")
                    },
                    body: JSON.stringify({
                        orderId: orderId,
                        updatedItems: updatedItems,
                        newItems: newItems
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                let data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Perubahan berhasil disimpan!"
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    console.error("Error dari server:", data.error);
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi kesalahan",
                        text: data.error
                    });
                }
            } catch (error) {
                console.error("Fetch error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Gagal menyimpan perubahan."
                });
            }
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.addEventListener("click", function(event) {
                if (event.target.classList.contains("increment")) {
                    let input = event.target.closest(".quantity-control").querySelector(".quantity-input");
                    input.value = parseInt(input.value) + 1;
                }

                if (event.target.classList.contains("decrement")) {
                    let input = event.target.closest(".quantity-control").querySelector(".quantity-input");
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                    }
                }
            });
        });

        function updateItems(orderId, button) {
            let row = button.closest("tr");
            let inventoryId = button.getAttribute("data-inventory-id");
            let itemName = row.cells[2].textContent.trim();
            let tableBody = document.querySelector("#tableadd tbody");

            // Cek apakah item sudah ada di tabel
            let existingRow = [...tableBody.rows].find(r => r.dataset.inventoryId === inventoryId);

            if (existingRow) {
                // Jika item sudah ada, tambahkan quantity
                let quantityInput = existingRow.querySelector(".quantity-input");
                quantityInput.value = parseInt(quantityInput.value) + 1;
            } else {
                // Jika item belum ada, tambahkan baris baru
                let newRow = document.createElement("tr");
                newRow.dataset.inventoryId = inventoryId;
                newRow.innerHTML = `
                <td class="d-none">${inventoryId}</td>
                
                <td>${itemName}</td>
                <td class="py-2 text-center">
                    <div class="input-group quantity-control">
                        <button class="btn btn-outline-primary btn-sm decrement" onclick="changeQuantity(this, -1)">-</button>
                        <input type="number" name="quantity[]" class="form-control text-center quantity-input" min="1" value="1">
                        <button class="btn btn-outline-primary btn-sm increment" onclick="changeQuantity(this, 1)">+</button>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem(this)">Delete</button>
                </td>
            `;
                tableBody.appendChild(newRow);
            }

            // Hapus "Tidak ada item ditambahkan" jika ada
            let emptyRow = document.getElementById("emptyRow");
            if (emptyRow) emptyRow.remove();
        }

        function changeQuantity(button, amount) {
            let input = button.closest(".quantity-control").querySelector(".quantity-input");
            let newValue = parseInt(input.value) + amount;
            if (newValue > 0) {
                input.value = newValue;
            }
        }

        function deleteItem(button) {
            let row = button.closest("tr");
            row.remove();

            // Jika tabel kosong setelah penghapusan, tampilkan pesan default
            let tableBody = document.querySelector("#tableadd tbody");
            if (tableBody.rows.length === 0) {
                let emptyRow = document.createElement("tr");
                emptyRow.id = "emptyRow";
                emptyRow.innerHTML = `<td colspan="5" class="text-center">Tidak ada item ditambahkan</td>`;
                tableBody.appendChild(emptyRow);
            }
        }
    </script>
@endsection
