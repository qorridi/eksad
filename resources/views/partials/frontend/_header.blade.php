<header id="header">

    <!-- Navbar -->
    <nav class="navbar navbar-expand" style="background-color: white">
        <div class="container header">

            <!-- Navbar Brand-->
            <a href="{{ route('frontend.home') }}">
                <img src="{{ asset('images/eksad/logo-eksad.png') }}" alt="EKSAD Technology" class="logo-responsive">
{{--                <span class="text-white pl-3">EKSAD Technology</span>--}}
            </a>

            <!-- Nav holder -->
            <div class="ml-auto"></div>

            <!-- Navbar Items -->
            <ul class="navbar-nav items">
                <li class="nav-item">
                    <a href="{{route('frontend.about')}}" class="nav-link text-dark">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('frontend.solutions')}}" class="nav-link text-dark ">Solutions</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('frontend.portfolio')}}" class="text-dark nav-link">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('frontend.career')}}" class="nav-link text-dark ">Career</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('frontend.blogs') }}" class="nav-link text-dark">Blog</a>
                </li>
            </ul>

            <!-- Navbar Icons -->
            <ul class="navbar-nav icons">

            </ul>

            <!-- Navbar Toggle -->
            <ul class="navbar-nav toggle">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                        <i class="icon-menu m-0"></i>
                    </a>
                </li>
            </ul>

            <!-- Navbar Action -->
            <ul class="navbar-nav  items pt-5 pt-md-0">
                <li class="nav-item ml-3 ">
                    <a href="{{route('frontend.contact_us')}}" class="btn ml-lg-auto text-white nav-link bg-red px-3 " style="border-radius: 10px;" >
                        Let's Chat</a>
                </li>
            </ul>
            <ul class="navbar-nav  items pt-5 pt-md-0 d-none">
                <li>
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
                </li>
            </ul>

        </div>
    </nav>

</header>

<style>
    .menu .nav-link:first-child {
         font-weight: 400;
    }
    .menu .nav-link:not(.btn) {
        font-weight: 400;
    }
    :root{
        --top-nav-item-color: black;
    }
    header .navbar-expand {
        padding: 20px 5px;
    }
    .bg-red{
        background-color: #d42627;
    }
    .navbar-expand .navbar-nav .nav-item a:not(.btn) {
         font-weight: normal;
    }
    @media (max-width: 575px) {
        .navbar-expand .navbar-nav .nav-link:not(.btn) {
            padding-right: 0 !important;
        }

    }
</style>
