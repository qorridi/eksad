<!DOCTYPE html>

<html lang="en">

<head>
@yield('head_and_title')

    <!-- ==============================================
    Basic Page Needs
    =============================================== -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->



    <!-- ==============================================
    Favicons
    =============================================== -->
    <link rel="shortcut icon" href="{{ asset('frontend/media/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontend/media/favicons/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/media/favicons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontend/media/favicons/apple-touch-icon-114x114.png') }}">

    <!-- ==============================================
    Vendor Stylesheet
    =============================================== -->
{{--    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/oneui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/slider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/animation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/gallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/cookie-notice.min.css') }}">

    <!-- ==============================================
    Custom Stylesheet
    =============================================== -->
    <link rel="stylesheet" href="{{ asset('frontend/css/default.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('frontend/css/theme-pink.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom-responsive.css') }}">

    <!-- ==============================================
    Theme Settings
    =============================================== -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap');
    </style>

    @yield('styles')
</head>

<body class="home" style="font-family: 'Rubik', sans-serif;">

<!-- Header -->
<header id="header">

    <!-- Navbar -->
    @include('partials.frontend._header')

</header>

<!-- Modal [responsive menu] -->
<div id="menu" class="p-0 modal fade" role="dialog" aria-labelledby="menu" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout" role="document">
        <div class="modal-content full">
            <div class="modal-header" data-dismiss="modal" style="font-size: 25px;">
                Menu <i class="icon-close"></i>
            </div>
            <div class="menu modal-body">
                <div class="row w-100">
                    <div class="items p-0 col-12 text-center">
                        <!-- Append [navbar] -->
                    </div>
                    <div class="contacts p-0 col-12 text-center">
                        <!-- Append [navbar] -->
                    </div>
                </div>
            </div>
            <div class="modal-header" data-dismiss="modal" style="font-size: 25px;">
                <div>
                    <a href="https://www.linkedin.com/company/pt-tiga-daya-digital-indonesia-triputra-group-eksad-technology" class="">
                        <img src="{{asset('images/eksad/linkedin.png')}}" style="width: 25px;" alt="">&nbsp;&nbsp;
                    </a>
                    <a href="https://twitter.com/eksadtechnology" class="px-3">
                        <img src="{{asset('images/eksad/twitter.jpg')}}" style="width: 25px;" alt="">&nbsp;&nbsp;
                    </a>
                    <a href="https://www.instagram.com/eksad_technology/">
                        <img src="{{asset('images/eksad/instagram.png')}}" style="width: 25px;" alt="">&nbsp;&nbsp;
                    </a>
                    <a href="https://youtube.com/eksad_technology" class="ps-3">
                        <img src="{{asset('images/eksad/youtube.png')}}" style="width: 25px;" alt="">
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@yield('content')

<!-- Footer -->
@include('partials.frontend._footer')

<!-- #region Global ============================ -->

<!-- ==============================================
Google reCAPTCHA // Put your site key here
=============================================== -->
{{--<script src="https://www.google.com/recaptcha/api.js?render=6Lf-NwEVAAAAAPo_wwOYxFW18D9_EKvwxJxeyUx7"></script>--}}

<!-- ==============================================
Vendor Scripts
=============================================== -->
<script src="{{ asset('frontend/js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery.inview.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/ponyfill.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/slider.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/animation.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/progress-radial.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/bricklayer.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/gallery.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/shuffle.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/cookie-notice.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/particles.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

<!-- #endregion Global ========================= -->

@yield('scripts')

</body>
</html>
