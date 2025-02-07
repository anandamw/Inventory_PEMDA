<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from cryptozone.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Feb 2025 02:57:18 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="CryptoZone : Crypto Trading Admin Bootstrap 5 Template" />
    <meta property="og:title" content="CryptoZone  :Crypto Trading Admin Bootstrap 5 Template" />
    <meta property="og:description" content="CryptoZone  :Crypto Trading Admin  Admin Bootstrap 5 Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no" />

    <!-- PAGE TITLE HERE -->
    <title>LogisHub</title>

    @include('components.style')
</head>

<body>
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
                    <a href="https://dexignzone.com/" target="_blank">DexignZone</a>
                    2022
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
