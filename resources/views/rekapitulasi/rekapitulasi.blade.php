@extends('components.template')
@section('content')
    <style>
        /* Background Modal */
        .modal-content {
            background: url('{{ asset('') }}assets/images/background.png') no-repeat center center;
            background-size: 100% 100%;
            /* Memaksa gambar menyesuaikan ukuran modal */
            background-color: white;
            color: black;
            border-radius: 20px;
        }

        /* Style untuk profil */
        .profile-container {
            width: 30%;
            text-align: center;
            padding: 20px;
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid rgb(37, 37, 37);
        }

        .invoice-container {
            width: 70%;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .modal-body {
                flex-direction: column;
            }

            .profile-container,
            .invoice-container {
                width: 100%;
                text-align: center;
            }
        }
    </style>



    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center  p-3 shadow-sm">
                            <div class="search-box w-50">
                                <input type="text" id="tableSearch" class="form-control rounded-pill px-3"
                                    placeholder="Search...">
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <button class="btn btn-success px-4 py-2 rounded-pill shadow-sm" onclick="exportToExcel()">
                                    <i class="bi bi-file-earmark-excel"></i> Export to Excel
                                </button>
                                <select id="filterSelect" class="form-select rounded-pill ps-4 shadow-sm" style="width: 170px;">
                                    <option value="month" selected>This Month</option>
                                    <option value="week">Last 7 Days</option>
                                    <option value="day">Today</option>
                                </select>
                                   <!-- Input untuk memilih bulan (disembunyikan awalnya) -->
                                   <input type="month" id="monthPicker" class="form-control rounded-pill shadow-sm" style="display: none; width: 180px;">
                            </div>
                        </div>


                        <div class="card-body" style="padding: 0 20px">
                            <div class="table-responsive" style="overflow-y: auto;">
                                <table id="rekaptable" class="table table-responsive-md text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">Event</th>
                                            <th class="text-center">Profile</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Print</th>
                                            <th class="text-center">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>{{ $item->events }}</td>
                                                <td>
                                                    <img src="{{ $item->profile ? asset($item->profile) : asset('assets/images/no-profile.jpg') }}"
                                                        width="50" alt="Profil">
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td class="text-center d-flex justify-content-center align-items-center">
                                                    <a href="javascript:void(0)"
                                                        onclick="downloadData({{ $item->id_orders }})"
                                                        class="d-flex justify-content-center align-items-center"
                                                        style="width: 53px; height: 53px;">
                                                        <svg width="32" height="32" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 9V2H18V9H6ZM8 4V7H16V4H8Z" fill="#A098AE" />
                                                            <path
                                                                d="M4 8H20C21.1 8 22 8.9 22 10V18H18V22H6V18H2V10C2 8.9 2.9 8 4 8ZM16 20V16H8V20H16ZM20 10H4V16H6V14H18V16H20V10ZM18 12H6V10H18V12Z"
                                                                fill="#A098AE" />
                                                        </svg>
                                                    </a>

                                                </td>

                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <!-- Button trigger modal -->
                                                        <a href="javascript:void(0)"
                                                            class="icon-box bg-primary d-flex justify-content-center align-items-center"
                                                            style="width: 28px; height: 28px; border-radius: 50%;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $item->id_orders }}">
                                                            <i class="fas fa-eye text-white"></i>
                                                        </a>

                                                        <svg width="20" height="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z"
                                                                fill="white" />
                                                        </svg>
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
            </div>
        </div>
    </div>

    <div id="hidden-container" style="position: absolute; left: -9999px; top: -9999px;"></div>

    @foreach ($orders as $item)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $item->id_orders }}" tabindex="-1" aria-labelledby="invoiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body mt-4">
                        <div class="container">
                            <div class="text-center d-flex align-content-between justify-content-between">
                                <div>
                                    <img src="{{ asset('') }}assets/images/logo/logo-color.png" width="90"
                                        alt="Profil">
                                </div>
                                <div>
                                    <h3 class="fw-bold">LOGISHUB INVENTORY</h3>
                                    <p class="mb-1">JL. Doktor Cipto Mangunkusumo No.1, Gudang, Kolor
                                    </p>
                                    <p class="mb-1">Kabupaten Sumenep, Jawa Timur 69417</p>
                                </div>
                                <div>
                                    <img src="{{ asset('') }}assets/images/about.png" width="90" alt="Profil">
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex flex-column flex-md-row">
                                <!-- Profil di Kiri -->
                                <div class="profile-container col-md-4 text-center p-3">
                                    <img src="{{ $item->profile ? asset($item->profile) : asset('assets/images/no-profile.jpg') }}"
                                        alt="Profil" class="img-fluid rounded-circle"
                                        style="width: 100px; height: 100px;">
                                    <h5 class="mt-2">{{ $item->name }}</h5>
                                    <p class="text-white-50">User</p>
                                </div>

                                <!-- Invoice -->
                                <div class="invoice-container col-md-8 p-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <h5 class="mt-0 text-end">Event : {{ $item->events }}</h5>
                                            <thead class="table-dark">
                                                <tr class="text-center">
                                                    <th>No.</th>
                                                    <th>Barang</th>
                                                    <th>Kuantitas</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderItem->where('orders_id', $item->id_orders) as $data)
                                                    <tr class="text-center">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->item_name }}</td>
                                                        <td>{{ $data->quantity }}</td>
                                                        <td>{{ $data->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="fw-bold mb-2">Detail Pengambilan</h5>
                            <p class="mb-1"><strong>NAMA:</strong> {{ $item->user->name }}</p>
                            <p class="mb-1"><strong>NIP:</strong> {{ $item->user->nip }}</p>
                            <p class="mb-5"><strong>TANGGAL:</strong> {{ $item->created_at->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Elemen loading overlay -->
    <div id="loading-overlay"
        style="
position: fixed; 
top: 0; 
left: 0; 
width: 100%; 
height: 100%; 
background: rgba(0, 0, 0, 0.5); 
display: flex; 
justify-content: center; 
align-items: center; 
z-index: 9999; 
display: none;">
        <div
            style="
    background: white; 
    padding: 20px; 
    border-radius: 10px; 
    display: flex; 
    flex-direction: column; 
    align-items: center;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p style="margin-top: 10px;">Mengekspor ...</p>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        async function downloadData(orderId) {
            const {
                jsPDF
            } = window.jspdf;

            let loadingOverlay = document.getElementById("loading-overlay");

            try {
                // Tampilkan loading
                loadingOverlay.style.display = "flex";

                let modal = document.querySelector(`#exampleModal${orderId}`);
                let modalContent = modal.querySelector(".modal-body");

                if (!modalContent) {
                    alert("Data tidak ditemukan!");
                    loadingOverlay.style.display = "none";
                    return;
                }

                let hiddenContainer = document.querySelector("#hidden-container");
                hiddenContainer.innerHTML = modalContent.innerHTML;

                await new Promise(resolve => setTimeout(resolve, 500));

                let background = new Image();
                background.src = "{{ asset('assets/images/background.png') }}";

                background.onload = function() {
                    html2canvas(hiddenContainer, {
                        scale: 1.5, // Mengurangi skala agar lebih proporsional
                        useCORS: true,
                        imageTimeout: 5000
                    }).then(canvas => {
                        let pdf = new jsPDF("p", "mm", "a4");

                        let pageWidth = 210; // Lebar A4 dalam mm
                        let pageHeight = 297; // Tinggi A4 dalam mm

                        let imgWidth = 180; // Kurangi lebar agar tidak terlalu besar di PDF
                        let imgHeight = (canvas.height * imgWidth) / canvas.width;

                        if (imgHeight > pageHeight - 30) {
                            imgHeight = pageHeight - 30; // Maksimalkan tinggi dalam satu halaman
                        }

                        let marginTop = 26; // Tambahkan margin atas
                        let marginLeft = (pageWidth - imgWidth) / 2; // Pusatkan modal di tengah PDF

                        pdf.addImage(background, "PNG", 0, 0, 210, 297);
                        pdf.addImage(canvas.toDataURL("image/png"), "PNG", marginLeft, marginTop, imgWidth,
                            imgHeight);

                        pdf.save(`Invoice_${orderId}.pdf`);
                    }).finally(() => {
                        loadingOverlay.style.display = "none";
                    });
                };
            } catch (error) {
                console.error("Error generating PDF:", error);
                alert("Terjadi kesalahan saat membuat PDF.");
                loadingOverlay.style.display = "none";
            }
        }
    </script>

    <script>
        function exportToExcel() {
            let filterValue = document.getElementById("filterSelect").value;
            let loadingOverlay = document.getElementById("loading-overlay");

            // Tampilkan animasi loading
            loadingOverlay.style.display = "flex";

            fetch(`/fetch-orders/${filterValue}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        alert("Tidak ada data yang sesuai dengan filter yang dipilih.");
                        loadingOverlay.style.display = "none"; // Sembunyikan loading
                        return;
                    }

                    let wb = XLSX.utils.book_new();
                    let wsData = [];

                    // Header
                    wsData.push(["Nama User", "Event", "No. HP", "Item", "Jumlah", "Status", "Tanggal Order"]);

                    // Data
                    data.forEach(order => {
                        wsData.push([
                            order.user_name,
                            order.events,
                            order.phone,
                            order.item_name,
                            order.quantity,
                            order.status.charAt(0).toUpperCase() + order.status.slice(1),
                            new Date(order.created_at).toISOString().split('T')[0]
                        ]);
                    });

                    // Buat worksheet dan tambahkan ke workbook
                    let ws = XLSX.utils.aoa_to_sheet(wsData);
                    XLSX.utils.book_append_sheet(wb, ws, "Rekapitulasi Order");

                    // Simpan file
                    XLSX.writeFile(wb, "rekapitulasi_order.xlsx");

                    // Sembunyikan loading setelah proses selesai
                    loadingOverlay.style.display = "none";
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    alert("Gagal mengekspor data!");
                    loadingOverlay.style.display = "none";
                });
        }
    </script>
@endsection
