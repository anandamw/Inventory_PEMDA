@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-xl-4 col-lg-4 h-100">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-body d-flex justify-content-center">
                                <div class="p-5">
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
                    </div>
                </div>

                {{-- table item --}}
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="search-box">
                                <input type="text" id="tableSearch" class="form-control" placeholder="Search...">
                            </div>
                            @if (auth()->user()->role == 'admin')
                                <a href="/item/create"
                                    class="btn btn-primary btn-info d-flex align-items-center justify-content-center">
                                    <span class="btn-icon-start text-info">
                                        <i class="fa fa-plus color-info"></i>
                                    </span>
                                    Add
                                </a>
                            @endif
                        </div>
                        <div class="card-body" style="padding: 0 20px">
                            <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">
                                <table id="mytable" class="table table-responsive-md text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">#Code</th>
                                            <th class="text-center">Photo</th>
                                            <th class="text-center">Item</th>
                                            <th class="text-center">Stok</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Action</th>
                                            @if (auth()->user()->role == 'admin')
                                                <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- jika tidak ada gambar tampilkan assets/images/no-image.png --}}
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->code_item }}</td>
                                                <td><img src="{{ $item->img_item ? asset('uploads/items/' . $item->img_item) : asset('assets/images/no-image.png') }}"
                                                        alt="Item Image" width="50"></td>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->updated_at }}</td>
                                                <td>
                                                    <div class="shopping-cart   addToCart"
                                                        data-id="{{ $item->id_inventories }}"
                                                        data-code="{{ $item->code_item }}"
                                                        data-name="{{ $item->item_name }}"
                                                        data-img="{{ $item->img_item ? asset($item->img_item) : asset('assets/images/no-image.png') }}">
                                                        <a class="btn btn-primary" href="javascript:void(0);;"><i
                                                                class="fa fa-shopping-basket me-2"></i>Cart</a>
                                                    </div>
                                                </td>
                                                @if (auth()->user()->role == 'admin')
                                                    <td class="text-end ps-0">
                                                        <div class="dropdown d-flex justify-content-center">
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
                                                                <!-- Edit Button -->
                                                                <a href="#" class="dropdown-item editBtn"
                                                                    data-id="{{ $item->id_inventories }}"
                                                                    data-name="{{ $item->item_name }}"
                                                                    data-quantity="{{ $item->quantity }}"
                                                                    data-image="{{ $item->img_item ? asset('uploads/items/' . $item->img_item) : 'assets/images/no-image.png' }}">
                                                                    Edit
                                                                </a>

                                                                <!-- Delete Button -->
                                                                <a href="{{ route('inventory.destroy', $item->id_inventories) }}"
                                                                    data-confirm-delete="true"
                                                                    class="dropdown-item text-danger">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="pagination" class="mt-3 d-flex justify-content-center"></div>
                        </div>
                    </div>
                </div>

                {{-- table keranjang --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead class="text-white bg-primary">
                                        <tr>
                                            <th class="align-middle">No</th>
                                            <th class="align-middle">#Code</th>
                                            <th class="align-middle pe-7">Photo</th>
                                            <th class="align-middle" style="min-width: 12.5rem;">Item</th>
                                            <th class="align-middle">Quantity</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">
                                        <tr class="no-data" style="display: none;">
                                            <td colspan="6" class="text-center py-3">Tidak ada data di keranjang</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="mb-3">
                                    <label for="events" class="form-label">Kebutuhan Acara</label>
                                    <input type="text" class="form-control" name="events" id="events"
                                        placeholder="Masukkan kebutuhan acara...">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">No Telepon</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="Masukkan no telepon...">
                                </div>

                            </div>
                            <div class="d-flex mt-3 gap-3   align-items-center ">
                                <button type="submit" class="btn btn-primary" id="submitCart">Submit</button>
                                <div>
                                    <h6>Total: <span id="totalItems">0</span> item </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalGrid" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="id_inventories">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Item</label>
                                    <input type="text" class="form-control" id="editName" name="item_name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="editQuantity" name="quantity"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <label class="form-label d-block">Item Picture</label>
                                <div class="card p-1 shadow-sm d-flex align-items-center">
                                    <div id="dropZoneEdit"
                                        class="border rounded d-flex flex-column align-items-center justify-content-center position-relative"
                                        style="width: 120px; height: 120px; border: 2px dashed #ccc; cursor: pointer; background-color: #f8f9fa; overflow: hidden;"
                                        onclick="document.getElementById('editFile').click()">

                                        <img id="previewEditImage" src="{{ asset('assets/images/no-image.png') }}"
                                            alt="Drag & Drop" class="img-thumbnail"
                                            style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 8px;">

                                        <input type="file" id="editFile" name="img_item" accept="image/*" hidden
                                            onchange="previewEditFile(event)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".editBtn").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id"); // Harus sesuai dengan id_inventories
                    let name = this.getAttribute("data-name");
                    let quantity = this.getAttribute("data-quantity");
                    let image = this.getAttribute("data-image") ||
                        "https://via.placeholder.com/100";

                    document.getElementById("editId").value = id;
                    document.getElementById("editName").value = name;
                    document.getElementById("editQuantity").value = quantity;
                    document.getElementById("previewEditImage").src = image;

                    var modal = new bootstrap.Modal(document.getElementById('modalGrid'));
                    modal.show();
                });
            });

            document.getElementById("editForm").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                let id = document.getElementById("editId").value;

                // Laravel perlu _method=PUT agar update bekerja
                formData.append("_method", "PUT");

                fetch(`/inventory/${id}/update`, {
                        method: "POST", // Laravel akan mengenali sebagai PUT karena _method
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil!",
                                text: data.message
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Terjadi kesalahan",
                                text: "Terjadi kesalahan saat mengupdate data."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: "Gagal melakukan update, coba lagi."
                        });
                    });
            });
        });

        function previewEditFile(event) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById("previewEditImage").src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            const addToCartButtons = document.querySelectorAll(".addToCart");
            const ordersTableBody = document.getElementById("orders");
            const noDataRow = document.querySelector(".no-data");
            const totalItemsElement = document.getElementById("totalItems");
            const submitButton = document.getElementById("submitCart");

            function updateTotal() {
                let totalItems = 0;
                document.querySelectorAll("#orders tr[data-id]").forEach(row => {
                    totalItems += parseInt(row.querySelector(".quantity").value, 10);
                });
                totalItemsElement.innerText = totalItems;
            }

            function checkEmptyCart() {
                if (ordersTableBody.querySelectorAll("tr[data-id]").length === 0) {
                    noDataRow.style.display = "table-row";
                } else {
                    noDataRow.style.display = "none";
                }
            }

            addToCartButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const code = this.getAttribute("data-code");
                    const name = this.getAttribute("data-name");
                    const img = this.getAttribute("data-img");

                    const existingRow = ordersTableBody.querySelector(`tr[data-id="${id}"]`);
                    if (existingRow) {
                        const quantityInput = existingRow.querySelector(".quantity");
                        quantityInput.value = parseInt(quantityInput.value, 10) + 1;
                        updateTotal();
                        return;
                    }

                    const newRow = document.createElement("tr");
                    newRow.setAttribute("data-id", id);
                    newRow.innerHTML = `
                    <td class="py-2">${ordersTableBody.children.length}</td>
                    <td class="py-2"><strong>#${code}</strong></td>
                    <td class="py-2"><img src="${img}" alt="Product Photo" width="50"></td>
                    <td class="py-2">${name}</td>
                    <td class="py-2 text-center">
                        <div class="input-group quantity-control">
                            <button class="btn btn-outline-primary btn-sm decrement">-</button>
                            <input type="number" class="form-control text-center quantity" value="1" min="1">
                            <button class="btn btn-outline-primary btn-sm increment">+</button>
                        </div>
                    </td>
                    <td class="py-2">
                        <button class="btn btn-danger btn-sm removeItem"><i class="fa fa-trash me-2"></i> Hapus</button>
                    </td>
                `;

                    ordersTableBody.appendChild(newRow);
                    checkEmptyCarsavet();
                    updateTotal();
                });
            });

            ordersTableBody.addEventListener("click", function(e) {
                if (e.target.classList.contains("removeItem")) {
                    e.target.closest("tr").remove();
                    checkEmptyCart();
                    updateTotal();
                }

                if (e.target.classList.contains("increment")) {
                    const quantityInput = e.target.closest("tr").querySelector(".quantity");
                    quantityInput.value = parseInt(quantityInput.value, 10) + 1;
                    updateTotal();
                }

                if (e.target.classList.contains("decrement")) {
                    const quantityInput = e.target.closest("tr").querySelector(".quantity");
                    if (parseInt(quantityInput.value, 10) > 1) {
                        quantityInput.value = parseInt(quantityInput.value, 10) - 1;
                        updateTotal();
                    }
                }
            });

            submitButton.addEventListener("click", function() {
                const cartItems = [];

                document.querySelectorAll("#orders tr[data-id]").forEach(row => {
                    const id = row.getAttribute("data-id");
                    const quantity = parseInt(row.querySelector(".quantity").value, 10);

                    cartItems.push({
                        id: id,
                        quantity: quantity
                    });
                });

                if (cartItems.length === 0) {
                    Swal.fire({
                        icon: "warning",
                        title: "Keranjang kosong",
                        text: "Keranjang masih kosong!"
                    });
                    return;
                }

                const events = document.getElementById("events").value;
                const phone = document.getElementById("phone").value;

                if (!events || !phone) {
                    Swal.fire({
                        icon: "warning",
                        title: "Data tidak lengkap",
                        text: "Harap isi semua field sebelum mengirim!"
                    });
                    return;
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

                fetch("/save", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: JSON.stringify({
                            items: cartItems,
                            events: events,
                            phone: phone
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil!",
                                text: data.message
                            }).then(() => {


                                window.location.href = "/";



                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Terjadi kesalahan",
                                text: "Terjadi kesalahan, coba lagi."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: "Terjadi kesalahan saat mengirim data."
                        });
                    });
            });
        });
    </script>
@endsection
