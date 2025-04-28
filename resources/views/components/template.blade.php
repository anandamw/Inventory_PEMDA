<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords"
        content="Ananda Maulana Wahyudi, Nama Teman Anda, Portfolio, Web Developer, Programmer, UI/UX, Software Engineer" />
    <meta name="author" content="Ananda Maulana Wahyudi, Nama Teman Anda" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Portofolio Ananda Maulana Wahyudi & Nama Teman Anda - Web Developer & Software Engineer" />
    <meta property="og:title" content="Ananda Maulana Wahyudi & Nama Teman Anda | Portfolio" />
    <meta property="og:description"
        content="Lihat portofolio dan proyek kami di bidang pengembangan web, UI/UX, dan software engineering." />
    <meta property="og:image" content="portfolio-image.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- PAGE TITLE HERE -->
    <title>LogisHub - {{ $headerText }}</title>
    @include('components.style')

</head>

<body>
    @include('sweetalert::alert')

    <!--*******************
        Preloader start
    ********************-->
    <div id="loader"></div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('components.layouts.nav-header')
        @include('components.layouts.checkbox')
        @include('components.layouts.start-header')
        @include('components.layouts.sidebar')
        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')

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

        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer out-footer">
            <div class="copyright">
                <p>
                    Copyright © Developed by
                    <a href="https://mywebsite-fri.vercel.app/" target="_blank">FriemZ </a>&
                    <a href="https://anandamw.turbo-main.com/" target="_blank">Anandamw</a>
                    2025
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    @include('components.script')

</body>

</html>
