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



                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header justify-content-between border-0">
                            <h2 class="heading mb-0">Latest Transaction</h2>
                            <div class="d-flex align-items-center">
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
                        <div class="card-body pt-0 px-0">
                            <div class="table-responsive">
                                <table class="table tb-transaction table-hover mb-4 dataTable no-footer" id="example6">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-w700 fs-16">1</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('assets/images/studio/5.jpg') }}" alt=""
                                                        class="avatar">
                                                    <div class="ms-3">
                                                        <h5 class="mb-0"><a class="text-secondary"
                                                                href="page-error-404.html">Dhoni Salaman</a></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="font-w700 fs-16">Item Name</td>
                                            <td class="font-w700 fs-16">9</td>
                                            <td class="fs-14 font-w400">June 1, 2022</td>
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



    <!-- Modal -->
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
@endsection
