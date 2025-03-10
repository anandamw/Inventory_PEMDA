<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="CryptoZone : Crypto Trading Admin Bootstrap 5 Template" />
    <meta property="og:title" content="CryptoZone  :Crypto Trading Admin Bootstrap 5 Template" />
    <meta property="og:description" content="CryptoZone  :Crypto Trading Admin  Admin Bootstrap 5 Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
                    <a href="https://dexignzone.com/" target="_blank">Anandamw</a>
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
