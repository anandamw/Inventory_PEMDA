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
                                <p>Dengan menggunakan layanan LogisHub, Anda setuju untuk mematuhi syarat dan ketentuan ini.
                                </p>

                                <h5>2. Definisi</h5>
                                <p>
                                    <strong>Layanan:</strong> Fitur pengambilan barang, pelacakan, dan pengelolaan data
                                    pengguna.<br>
                                    <strong>Pengguna:</strong> Individu atau instansi yang menggunakan layanan.<br>
                                    <strong>Data Pengguna:</strong> Informasi yang dikumpulkan dari pengguna terkait
                                    pengambilan barang.
                                </p>

                                <h5>3. Pendaftaran dan Akun</h5>
                                <p>
                                    Pengguna harus mendaftar dan memberikan informasi yang akurat.<br>
                                    Pengguna bertanggung jawab atas keamanan akun dan harus melaporkan penggunaan yang tidak
                                    sah.
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
                                    Data pengguna dikumpulkan untuk memproses pengambilan barang dan tujuan
                                    administratif.<br>
                                    Data disimpan dengan aman dan hanya diakses oleh pihak berwenang.<br>
                                    Pengguna berhak untuk mengakses, memperbaiki, atau menghapus data pribadi mereka.
                                </p>

                                <h5>8. Tanggung Jawab Pengguna</h5>
                                <p>Pengguna bertanggung jawab atas semua aktivitas di akun mereka dan setuju untuk mengganti
                                    rugi
                                    LogisHub atas kerugian yang timbul akibat pelanggaran.</p>

                                <h5>9. Pembatasan Tanggung Jawab</h5>
                                <p>LogisHub tidak bertanggung jawab atas kerugian yang timbul akibat penggunaan layanan.</p>

                                <h5>10. Perubahan Syarat dan Ketentuan</h5>
                                <p>LogisHub berhak untuk mengubah syarat dan ketentuan kapan saja, dan pengguna akan
                                    diberitahu tentang
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


                <div class="col-xl-4">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card bg-primary">
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
                        <div class="card border-0 pb-0">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Message</h4>
                            </div>
                            <div class="card-body p-0">
                                <div id="DZ_W_Todo3" class="widget-media dz-scroll height210 my-4 px-4">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-panel">
                                                <div class="media me-2">
                                                    <img alt="image" width="50" src="images/avatar/1.jpg">
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mb-1">Alfie Mason <small class="">- 29 July
                                                            2020</small>
                                                    </h5>
                                                    <p class="mb-1">I shared this on my fb wall a few months back..</p>
                                                    <a href="#" class="btn btn-primary btn-xxs shadow">Reply</a>
                                                    <a href="#" class="btn btn-danger btn-xxs">Delete</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
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
                                                    <th>inventories_id</th>
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


                                {{-- table item --}}

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <div class="search-box">
                                                <input type="text" id="tableSearch" class="form-control"
                                                    placeholder="Search...">
                                            </div>
                                        </div>
                                        <div class="card-body" style="padding: 0 20px">
                                            <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">

                                                {{-- tabel item --}}
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

            // Ambil semua input quantity di tabel Detail Barang
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
                        status: status // Menambahkan status jika ada
                    });
                }
            });

            if (updatedItems.length === 0 && newItems.length === 0) {
                alert("Tidak ada perubahan yang disimpan.");
                return;
            }
            console.log("Data yang dikirim:", JSON.stringify({
                orderId: orderId,
                updatedItems: updatedItems,
                newItems: newItems,
                status: status
            }, null, 2));

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
                        status: status // Kirim status jika ada
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                let data = await response.json();

                if (data.success) {
                    alert("Perubahan berhasil disimpan!");
                    location.reload();
                } else {
                    console.error("Error dari server:", data.error);
                    alert("Terjadi kesalahan: " + data.error);
                }
            } catch (error) {
                console.error("Fetch error:", error);
                alert("Gagal menyimpan perubahan.");
            }
        }
    </script>


    {{-- simpan perubahan --}}
    <script>
        async function saveChangesData(orderId) {
            let updatedItems = [];
            let newItems = [];

            // Ambil semua input quantity di tabel Detail Barang
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
                alert("Tidak ada perubahan yang disimpan.");
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
                    alert("Perubahan berhasil disimpan!");
                    location.reload();
                } else {
                    console.error("Error dari server:", data.error);
                    alert("Terjadi kesalahan: " + data.error);
                }
            } catch (error) {
                console.error("Fetch error:", error);
                alert("Gagal menyimpan perubahan.");
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
                <td>${inventoryId}</td>
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
