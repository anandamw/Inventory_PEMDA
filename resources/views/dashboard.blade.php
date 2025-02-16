@extends('components.template')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card bubles">
                                <div class="card-body">
                                    <div class="buy-coin bubles-down">
                                        <div>
                                            <h2>Grab Items Easy & Fast!</h2>
                                            <p>
                                                Permudah ambil barang dengan sistem yang cepat dan transparan. Klik untuk
                                                memulai!
                                            </p>
                                            <a href="/item" class="btn btn-primary">Ambil Barang</a>
                                        </div>
                                        <div class="coin-img">
                                            <img src="{{ asset('') }}assets/images/coin.png" class="img-fluid"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-12 col-sm-12 wow fadeInRight" data-wow-delay="0.3s">
                            <div class="card digital-cash">
                                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0 heading">About</h4>
                                    <div class="dropdown custom-dropdown mb-0 tbl-orders-style">
                                        <div class="btn sharp tp-btn" data-bs-toggle="dropdown" aria-expanded="false"
                                            role="button">
                                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.0335 13C12.5854 13 13.0328 12.5523 13.0328 12C13.0328 11.4477 12.5854 11 12.0335 11C11.4816 11 11.0342 11.4477 11.0342 12C11.0342 12.5523 11.4816 13 12.0335 13Z"
                                                    stroke="#342E59" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12.0335 6C12.5854 6 13.0328 5.55228 13.0328 5C13.0328 4.44772 12.5854 4 12.0335 4C11.4816 4 11.0342 4.44772 11.0342 5C11.0342 5.55228 11.4816 6 12.0335 6Z"
                                                    stroke="#342E59" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12.0335 20C12.5854 20 13.0328 19.5523 13.0328 19C13.0328 18.4477 12.5854 18 12.0335 18C11.4816 18 11.0342 18.4477 11.0342 19C11.0342 19.5523 11.4816 20 12.0335 20Z"
                                                    stroke="#342E59" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                        </div>
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
                        <div class="card bg-primary">
                            <div class="card-header border-0 pb-0">
                                <div>
                                    <h2 class="heading mb-0 text-white">Data Item</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive" style="max-height: 505px; overflow-y: auto;">
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
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead class="text-white bg-primary text-center">
                                        <tr>
                                            <th class="align-middle">No</th>
                                            <th class="align-middle">Name</th>
                                            <th class="align-middle pe-7">Events</th>
                                            <th class="align-middle" style="min-width: 12.5rem;">Phone</th>
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
                                                                Edit Item
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

            </div>
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
                                <img src="{{ auth()->user()->profile ? asset(auth()->user()->profile) : asset('assets/images/no-profile.jpg') }}"
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
                                            <th>Update Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem->where('orders_id', $item->id_orders) as $data)
                                            <tr>
                                                <td>{{ $data->item_name }}</td>

                                                @if ($data->status !== 'success') 
                                                <td class="py-2 text-center">
                                                    <div class="input-group quantity-control">
                                                        <button class="btn btn-outline-primary btn-sm decrement">-</button>
                                                        <input type="number" name="quantity[]" class="form-control text-center quantity"
                                                            value="{{ $data->quantity }}" data-id="{{ $data->id_order_items }}" min="1">
                                                        <button class="btn btn-outline-primary btn-sm increment">+</button>
                                                    </div>
                                                </td>

                                                @else
                                                <td class="py-2 text-center hidden">
                                                    <div class="input-group quantity-control">
                                                        <button class="btn btn-outline-primary btn-sm decrement">-</button>
                                                        <input type="number" name="quantity[]" class="form-control text-center quantity"
                                                            value="{{ $data->quantity }}" data-id="{{ $data->id_order_items }}" min="1">
                                                        <button class="btn btn-outline-primary btn-sm increment">+</button>
                                                    </div>
                                                </td>
                                                @endif
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
 
                                            
                                            <td>
                                              
                                                    <select name="status[]" data-id="{{ $data->id_order_items }}" class="form-select" required>
                                                        <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="success" {{ $data->status == 'success' ? 'selected' : '' }}>Success</option>
                                                    </select>
                                               
                                            </td>
                                            


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <p>Acara: <span id="datetime">{{ $item->events }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success light" onclick="updateAllRecaps({{ $item->id_orders }})">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal About -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Syarat dan Ketentuan Penggunaan LogisHub</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <h5>1. Penerimaan Syarat dan Ketentuan</h5>
                    <p>Dengan menggunakan layanan LogisHub, Anda setuju untuk mematuhi syarat dan ketentuan ini.</p>

                    <h5>2. Definisi</h5>
                    <p>
                        <strong>Layanan:</strong> Fitur pengambilan barang, pelacakan, dan pengelolaan data pengguna.<br>
                        <strong>Pengguna:</strong> Individu atau instansi yang menggunakan layanan.<br>
                        <strong>Data Pengguna:</strong> Informasi yang dikumpulkan dari pengguna terkait pengambilan barang.
                    </p>

                    <h5>3. Pendaftaran dan Akun</h5>
                    <p>
                        Pengguna harus mendaftar dan memberikan informasi yang akurat.<br>
                        Pengguna bertanggung jawab atas keamanan akun dan harus melaporkan penggunaan yang tidak sah.
                    </p>

                    <h5>4. Penggunaan Layanan</h5>
                    <p>
                        Pengguna hanya boleh menggunakan layanan untuk tujuan yang sah.<br>
                        Dilarang melakukan tindakan ilegal atau merugikan pihak lain.
                    </p>

                    <h5>5. Proses Pengambilan Barang</h5>
                    <p>
                        Pengguna harus mengajukan permohonan melalui platform.<br>
                        Permohonan akan diproses dan pengguna akan diberitahu tentang statusnya.
                    </p>

                    <h5>6. Pelacakan dan Pengajuan</h5>
                    <p>
                        Fitur pelacakan tersedia untuk memantau status pengambilan barang.<br>
                        Pengguna bertanggung jawab untuk memeriksa status pengajuan.
                    </p>

                    <h5>7. Pengelolaan Data Pengguna</h5>
                    <p>
                        Data pengguna dikumpulkan untuk memproses pengambilan barang dan tujuan administratif.<br>
                        Data disimpan dengan aman dan hanya diakses oleh pihak berwenang.<br>
                        Pengguna berhak untuk mengakses, memperbaiki, atau menghapus data pribadi mereka.
                    </p>

                    <h5>8. Tanggung Jawab Pengguna</h5>
                    <p>Pengguna bertanggung jawab atas semua aktivitas di akun mereka dan setuju untuk mengganti rugi
                        LogisHub atas kerugian yang timbul akibat pelanggaran.</p>

                    <h5>9. Pembatasan Tanggung Jawab</h5>
                    <p>LogisHub tidak bertanggung jawab atas kerugian yang timbul akibat penggunaan layanan.</p>

                    <h5>10. Perubahan Syarat dan Ketentuan</h5>
                    <p>LogisHub berhak untuk mengubah syarat dan ketentuan kapan saja, dan pengguna akan diberitahu tentang
                        perubahan tersebut.</p>

                    <h5>11. Hukum yang Berlaku</h5>
                    <p>Syarat dan ketentuan ini diatur oleh hukum yang berlaku di Indonesia.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".quantity-control").forEach(function(control) {
                let decrementBtn = control.querySelector(".decrement");
                let incrementBtn = control.querySelector(".increment");
                let inputField = control.querySelector(".quantity");
    
                decrementBtn.addEventListener("click", function() {
                    let currentValue = parseInt(inputField.value) || 0;
                    if (currentValue > 0) {  
                        inputField.value = currentValue - 1;
                    }
                });
    
                incrementBtn.addEventListener("click", function() {
                    let currentValue = parseInt(inputField.value) || 0;
                    inputField.value = currentValue + 1;
                });
            });
        });
    
        function updateAllRecaps(orderId) {
            let recaps = [];
    
            document.querySelectorAll(`#exampleModal${orderId} tbody tr`).forEach(row => {
                let id = row.querySelector("input[name='quantity[]']").getAttribute("data-id");
                let quantity = parseInt(row.querySelector("input[name='quantity[]']").value) || 0;
                let status = row.querySelector("select[name='status[]']").value;
    
                recaps.push({
                    id: id,
                    quantity: quantity,
                    status: status
                });
            });
    
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    
            fetch("{{ route('history.dashboard.update') }}", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ recaps: recaps })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => {
                console.error("Error updating data:", error);
            });
        }
    </script>
    
@endsection
