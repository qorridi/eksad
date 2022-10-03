<!DOCTYPE html>

<html lang="en">

<head>

    <!-- ==============================================
    Basic Page Needs
    =============================================== -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/slider.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">--}}
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
    <link rel="stylesheet" href="{{ asset('frontend/css/custom-responsive.css') }}">

    <!-- ==============================================
    Theme Settings
    =============================================== -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');
    </style>

    @yield('styles')
</head>

<body class="home" style="font-family: 'Source Sans Pro', sans-serif;">

<!-- Header -->
<header id="header">

    <!-- Navbar -->
    @include('partials.frontend._header')

</header>

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
