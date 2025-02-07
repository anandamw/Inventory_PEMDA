@extends('components.template')

@section('content')
    <!--**********************************
                                                Content body start
                                            ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <!-- Card kiri atas: Detail User -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">History</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>History date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($historys as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $item->img_item ? asset($item->img_item) : asset('assets/images/no-image.png') }}"
                                                        alt="Item Image" width="50"></td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->quantity }}</td>

                                                <td>Admin</td>
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
                                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalGrid">Detail</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalGrid">
        <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg class here -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengambilan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <!-- Image Section (left) -->
                            <div class="col-md-4">
                                <img src="path_to_your_image.jpg" alt="Image" class="img-fluid">
                            </div>

                            <!-- Description Section (right) -->
                            <div class="col-md-8">
                                <h5>Nama: <span id="nama">John Doe</span></h5>
                                <p>NIP: <span id="nip">123456789</span></p>

                                <!-- Detail Barang (table) -->
                                <h6>Detail Barang:</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Laptop</td>
                                            <td>2</td>
                                            <td>20,000</td>
                                        </tr>
                                        <tr>
                                            <td>Mouse</td>
                                            <td>1</td>
                                            <td>500</td>
                                        </tr>
                                        <tr>
                                            <td>Keyboard</td>
                                            <td>3</td>
                                            <td>1,500</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p>Total Barang: <span id="total">3</span></p>
                                <p>DateTime: <span id="datetime">2025-02-06 14:30</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
