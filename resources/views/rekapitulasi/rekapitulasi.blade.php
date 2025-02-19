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
            border-radius: 10px;
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
            border-radius: 15%;
            object-fit: cover;
            border: 3px solid rgb(0, 0, 0);
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="search-box">
                                <input type="text" id="tableSearch" class="form-control" placeholder="Search...">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="shopping-cart">
                                    <a class="btn btn-primary btn-sm" href="javascript:void(0);">
                                        <i class="fa fa-download me-2"></i>Download Excle
                                    </a>
                                </div>
                                <div class="dropdown bootstrap-select">
                                    <select class="image-select default-select dashboard-select width-130"
                                        aria-label="Default" tabindex="0">
                                        <option selected="">This Month</option>
                                        <option value="1">Weeks</option>
                                        <option value="2">Today</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0 20px">
                            <div class="table-responsive" style="max-height: 330px; overflow-y: auto;">
                                <table id="mytable" class="table table-responsive-md text-center">
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
                                            <td><img src="http://127.0.0.1:8000/assets/images/no-image.png" alt="Item Image"
                                                    width="50"></td>
                                            <td>Heru</td>
                                            <td>2025-02-12 01:03:12</td>
                                            <td class="text-center d-flex justify-content-center align-items-center">
                                                <a href="javascript:void(0)" onclick="downloadData()"
                                                    class="d-flex justify-content-center align-items-center"
                                                    style="width: 53px; height: 53px;">
                                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
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
                                                        data-bs-toggle="modal" data-bs-target="#invoiceModal">
                                                        <i class="fas fa-eye text-white"></i>
                                                    </a>

                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
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



    <!-- Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="text-center d-flex align-content-between justify-content-between">
                            <div>
                                <img src="{{ asset('') }}assets/images/logo/logo-color.png" width="90"
                                    alt="Profil">
                            </div>
                            <div>
                                <h3 class="fw-bold">LogisHub Inventory</h3>
                                <p>helloreallygreatsite.com</p>
                                <p>123 Anywhere st., Any City, ST 12345</p>
                            </div>
                            <div>
                                <img src="{{ asset('') }}assets/images/about.png" width="90" alt="Profil">
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex">
                            <!-- Profil di Kiri -->
                            <div class="profile-container">
                                <img src="{{ asset('') }}assets/images/no-profile.jpg" alt="Profil">
                                <h5 class="mt-2">Daniel Gallego</h5>
                                <p class="text-white-50">User</p>
                                <hr class="border-white">
                            </div>
                            <div class="invoice-container">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Barang</th>
                                            <th>Kuantitas</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Deskripsi barang</td>
                                            <td>1</td>
                                            <td>Rp 1,234.56</td>
                                            <td>Rp 1,234.56</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Deskripsi barang</td>
                                            <td>1</td>
                                            <td>Rp 1,234.56</td>
                                            <td>Rp 1,234.56</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Deskripsi barang</td>
                                            <td>1</td>
                                            <td>Rp 1,234.56</td>
                                            <td>Rp 1,234.56</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold">Total</td>
                                            <td>Rp 3,703.68</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h5 class="fw-bold">Detail Pengambilan</h5>
                        <p><strong>NAMA:</strong> DANIEL GALLEGO</p>
                        <p><strong>NIP:</strong> #1234567890</p>
                        <p><strong>TANGGAL:</strong> 10 Agustus 2023</p>
                        <div class="text-end">
                            <p>ADMINISTRATOR</p>
                            <img src="{{ asset('') }}assets/images/ttd.png" alt="Tanda Tangan" style="width: 130px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
@endsection
