@extends('components.template')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-xl-4 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-body">
                                <div class="p-5">
                                    <div class="author-profile">
                                        <div class="author-media">
                                            <img src="{{ auth()->user()->profile ? asset(auth()->user()->profile) : asset('assets/images/no-profile.jpg') }}"
                                                alt="">
                                            <div class="upload-link" title="" data-toggle="tooltip"
                                                data-placement="right" data-original-title="update">
                                                <input type="file" class="update-flie">
                                                <i class="fa fa-camera"></i>
                                            </div>

                                        </div>
                                        <div class="author-info">
                                            <h6 class="title">{{ auth()->user()->name }}</h6>
                                            <span>{{ auth()->user()->nip }}</span>
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
                            <a href="/item/create"
                                class="btn btn-primary btn-info d-flex align-items-center justify-content-center">
                                <span class="btn-icon-start text-info">
                                    <i class="fa fa-plus color-info"></i>
                                </span>
                                Add
                            </a>
                        </div>
                        <div class="card-body" style="padding: 0 20px">
                            <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">
                                <table id="mytable" class="table table-responsive-md text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>#Code</th>
                                            <th>Photo</th>
                                            <th>Item</th>
                                            <th>Stok</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- jika tidak ada gambar tampilkan assets/images/no-image.png --}}
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $item->id_inventories }}</td>
                                                <td>{{ $item->code_item }}</td>
                                                <td><img src="{{ $item->img_item ? asset($item->img_item) : asset('assets/images/no-image.png') }}"
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
                                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalGrid">Edit</button>
                                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                            
                                                        </div>
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
<<<<<<< HEAD


         <!-- Modal -->
         <div class="modal fade" id="modalGrid">
            <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg class here -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Kolom Kiri: Input Data -->
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Item</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Item....." style="opacity: 0.6;" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan Quantity....." style="opacity: 0.6;" required>
                                    </div>
                                </div>
                                
                                <!-- Kolom Kanan: Input Gambar dengan Drag & Drop -->
                                <div class="col-md-4 text-center">
                                    <label class="form-label d-block">Item Picture</label>
                                    <div class="card p-1 shadow-sm d-flex align-items-center"> 
                                        <div id="dropZone" class="border rounded d-flex flex-column align-items-center justify-content-center position-relative"
                                            style="width: 120px; height: 120px; border: 2px dashed #ccc; cursor: pointer; background-color: #f8f9fa; overflow: hidden;">
                                            <img id="previewImage" src="https://via.placeholder.com/100" alt="Drag & Drop" class="img-thumbnail"
                                                style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 8px;">
                                            <input type="file" id="formFile" name="profile_picture" accept="image/*" hidden onchange="previewFile(event)">
                                        </div>
                                    </div>                                                                                
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        



=======
>>>>>>> bdee02d780b9c5876b583bfa6b5d24b09e8cee60
    <script>
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
                    const price = parseInt(this.getAttribute("data-price"), 10);

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
                    checkEmptyCart();
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

                    console.log("Item ID:", id, "Quantity:", quantity); // Debug ID

                    cartItems.push({
                        id: id,
                        quantity: quantity
                    });
                });

                if (cartItems.length === 0) {
                    alert("Keranjang masih kosong!");
                    return;
                }

                console.log("Cart Items:", cartItems); // Debug sebelum fetch

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

                fetch("/save", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: JSON.stringify({
                            items: cartItems
                        })
                    })
                    .then(async response => {
                        const text = await response.text(); // Ambil respons mentah untuk debugging
                        console.log("Raw response:", text);

                        if (!response.ok) {
                            throw new Error(`HTTP Error ${response.status}: ${text}`);
                        }
                        return JSON.parse(text);
                    })
                    .then(data => {
                        console.log("Response JSON:", data);
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan saat mengirim data.");
                    });

            });
        });
    </script>
@endsection
