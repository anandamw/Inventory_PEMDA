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
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->code_item }}</td>
                                                <td><img src="{{ $item->img_item ? asset($item->img_item) : asset('assets/images/no-image.png') }}"
                                                        alt="Item Image" width="50"></td>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->updated_at }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm addToCart"
                                                        data-id="{{ $item->id }}" data-code="{{ $item->code_item }}"
                                                        data-name="{{ $item->item_name }}"
                                                        data-img="{{ $item->img_item ? asset($item->img_item) : asset('assets/images/no-image.png') }}"
                                                        data-price="{{ $item->price }}">Tambah
                                                    </button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.addToCart'); // Menangkap tombol "Tambah"
            const ordersTableBody = document.getElementById('orders'); // Tabel keranjang
            const noDataRow = document.querySelector('.no-data'); // Baris teks "Tidak ada data"
            const totalItemsElement = document.getElementById('totalItems'); // Total item
            const totalPriceElement = document.getElementById('totalPrice'); // Total harga
            const submitButton = document.getElementById('submitCart'); // Tombol submit

            let totalItems = 0;
            let totalPrice = 0;

            // Cek awal apakah ada data atau tidak
            if (ordersTableBody.children.length === 1) { // Hanya ada satu baris (baris no-data)
                noDataRow.style.display = 'table-row';
            }

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Mengambil data atribut dari tombol yang diklik
                    const id = this.getAttribute('data-id');
                    const code = this.getAttribute('data-code');
                    const name = this.getAttribute('data-name');
                    const img = this.getAttribute('data-img');
                    const price = parseInt(this.getAttribute('data-price'));

                    // Membuat elemen baru untuk baris tabel keranjang
                    const newRow = document.createElement('tr');

                    newRow.innerHTML = `
                        <td class="py-2">${totalItems + 1}</td>
                        <td class="py-2"><strong>#${code}</strong></td>
                        <td class="py-2">
                            <img src="${img}" alt="Product Photo" width="50">
                        </td>
                        <td class="py-2">${name}</td>
                        <td class="py-2 text-center">
                            <div class="input-group quantity-control">
                                <button class="btn btn-outline-primary btn-sm decrement" type="button">-</button>
                                <input type="number" class="form-control text-center quantity" value="1" min="1">
                                <button class="btn btn-outline-primary btn-sm increment" type="button">+</button>
                            </div>
                        </td>
                        <td class="py-2">
                            <button class="btn btn-danger btn-sm removeItem">Hapus</button>
                        </td>
                    `;

                    // Menambahkan baris baru ke tabel keranjang
                    ordersTableBody.appendChild(newRow);

                    // Menyembunyikan pesan "Tidak ada data" jika ada item di keranjang
                    noDataRow.style.display = 'none';

                    // Update total item dan total harga
                    totalItems += 1;
                    totalPrice += price;
                    updateTotal();

                    // Mengaktifkan tombol submit
                    submitButton.disabled = false;
                });
            });

            // Event listener untuk hapus item dari keranjang
            ordersTableBody.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('removeItem')) {
                    const row = e.target.closest('tr');
                    const price = parseInt(row.querySelector('.quantity').value) * parseInt(row
                        .querySelector('td:nth-child(2)').innerText.slice(1));

                    // Menghapus baris yang berisi tombol hapus yang diklik
                    row.remove();

                    // Update total item dan total harga
                    totalItems -= 1;
                    totalPrice -= price;
                    updateTotal();

                    // Jika tabel keranjang kosong, tampilkan pesan "Tidak ada data"
                    if (ordersTableBody.children.length === 1) { // Cek jika hanya ada baris no-data
                        noDataRow.style.display = 'table-row';
                    }
                }

                // Fungsi untuk menangani increment
                if (e.target && e.target.classList.contains('increment')) {
                    const quantityInput = e.target.closest('tr').querySelector('.quantity');
                    let currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;

                    // Update total harga
                    updateTotal();
                }

                // Fungsi untuk menangani decrement
                if (e.target && e.target.classList.contains('decrement')) {
                    const quantityInput = e.target.closest('tr').querySelector('.quantity');
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }

                    // Update total harga
                    updateTotal();
                }
            });

            // Fungsi untuk memperbarui total item dan total harga
            function updateTotal() {
                totalItemsElement.innerText = totalItems;
                totalPriceElement.innerText = totalPrice;
            }

            // Event listener untuk submit data
            submitButton.addEventListener('click', function() {
                alert('Data keranjang berhasil disubmit!');
                // Di sini, Anda bisa menambahkan kode untuk mengirimkan data ke server
            });
        });
    </script>
@endsection
