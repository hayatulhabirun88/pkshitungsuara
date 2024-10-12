<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Title -->
    <title>Dashboard - PKS Hitung Suara</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/') }}afan/img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="{{ asset('/') }}afan/img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/') }}afan/img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('/') }}afan/img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/') }}afan/img/icons/icon-180x180.png">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}afan/style.css">

    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('/') }}afan/manifest.json">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Internet Connection Status -->
    <div class="internet-connection-status" id="internetStatus"></div>

    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content -->
            <div
                class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                <!-- Logo Wrapper -->
                <div class="logo-wrapper">
                    <a href="/">
                        <img src="{{ asset('/') }}logopks.png" alt="">
                        Hitung Suara
                    </a>
                </div>

            </div>
        </div>
    </div>


    <div class="page-content-wrapper">


        <div class="pt-3"></div>

        @livewire('mobile.input-suara')

        <div class="pb-3"></div>
    </div>

    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
        <div class="container px-0">
            <!-- Footer Content -->
            <div class="footer-nav position-relative">
                <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                    <li class="active">
                        <a href="/m/dashboard">
                            <i class="bi bi-house"></i>
                            <span>Input Suara</span>
                        </a>
                    </li>

                    <li>
                        <a href="/m/logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- All JavaScript Files -->
    <script src="{{ asset('/') }}afan/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}afan/js/slideToggle.min.js"></script>
    <script src="{{ asset('/') }}afan/js/internet-status.js"></script>
    <script src="{{ asset('/') }}afan/js/tiny-slider.js"></script>
    <script src="{{ asset('/') }}afan/js/venobox.min.js"></script>
    <script src="{{ asset('/') }}afan/js/countdown.js"></script>
    <script src="{{ asset('/') }}afan/js/rangeslider.min.js"></script>
    <script src="{{ asset('/') }}afan/js/vanilla-dataTables.min.js"></script>
    <script src="{{ asset('/') }}afan/js/index.js"></script>
    <script src="{{ asset('/') }}afan/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('/') }}afan/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('/') }}afan/js/dark-rtl.js"></script>
    <script src="{{ asset('/') }}afan/js/active.js"></script>
    <script src="{{ asset('/') }}afan/js/pwa.js"></script>
</body>

</html>
