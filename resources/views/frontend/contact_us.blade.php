@extends('layouts.frontend')

@section('head_and_title')
    <meta name="description" content="EKSAD, Technology">
    <meta name="subject" content="EKSAD, Technology">
    <meta name="author" content="EKSAD">
    <title>EKSAD Technology</title>
@endsection

@section('content')

    <!-- Field Section -->
    <section id="" class=" bg-white martop py-5 mr-md-5">
        <div class="container ">
            <div class="row">
                <div class="col-md   bg-blue-eksad p-5 mb-5" >
                    <p class="txt-body1 font-rubik-bold text-white  text-center text-md-start pb-3">Contact Us</p>
                    <div class="row pb-3">
                        <div class="col-1 px-1">
                            <img src="{{asset('images/eksad/contact/icon-phone-white.png')}}" class="w-100"  alt="phone icon">
                        </div>
                        <div class="col">
                            <a href="tel:+622157958040" class="text-white text-decoration-underline txt-body3">(021) 5795 - 8040</a>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-1 px-1">
                            <img src="{{asset('images/eksad/contact/icon-mail-white.png')}}" class="w-100"  alt="mail icon">
                        </div>
                        <div class="col">
                            <a href="mailto:info@eksad.com" class="text-white text-decoration-underline txt-body3">info@eksad.com</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 px-1">
                            <img src="{{asset('images/eksad/contact/icon-location-white.png')}}" class="w-100"  alt="location icon">
                        </div>
                        <div class="col">
                            <p class="text-white txt-body3 d-none d-md-block">PT. Tiga Daya Digital Indonesia The East<br/>
                                Tower 19th Floor Jl. Dr. Ide Anak Agung<br/>
                                Gde Agung Blok E3.2<br/>
                                Mega Kuningan, Jakarta Selatan 12950</p>
                            <p class="text-white txt-body3 d-block d-md-none">PT. Tiga Daya Digital Indonesia The East
                                Tower 19th Floor Jl. Dr. Ide Anak Agung
                                Gde Agung Blok E3.2
                                Mega Kuningan, Jakarta Selatan 12950</p>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-12 pt-md-9 text-center text-md-start pt-3 pt-md-0" id="socmed">
                            <p class="txt-body3 text-white pb-3">Follow our Social Media</p>
                            <a href="https://www.linkedin.com/company/pt-tiga-daya-digital-indonesia-triputra-group-eksad-technology" class="">
                                <img src="{{asset('images/eksad/contact/icon-linkedin-white.png')}}" style="width: 25px;" alt="">
                            </a>
                            <a href="https://twitter.com/eksadtechnology" class="px-3">
                                <img src="{{asset('images/eksad/contact/twitter-white.png')}}" style="width: 25px;" alt="">
                            </a>
                            <a href="https://www.instagram.com/eksad_technology/">
                                <img src="{{asset('images/eksad/contact/icon-instagram-white.png')}}" style="width: 25px;" alt="">
                            </a>
                            <a href="https://youtube.com/eksad_technology" class="ps-3">
                                <img src="{{asset('images/eksad/contact/icon-youtube-white.png')}}" style="width: 25px;" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 border-contact"></div>
                <div class="col-12 col-md p-3 p-md-5 border-outline-contact text-center text-md-start">
                    <p class="txt-header-color txt-body5 fw-bold ">
                        or Send us a message
                    </p>
                    <p class="txt-body4 text-dark">and a our team will reach out to you soon.</p>
                    <div style="padding-top: 40px">

                        {{ Form::open(['route'=>['frontend.contact_us.save'],'method' => 'post','id' => 'contact-form', ]) }}
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <p class="mb-0">
                                    {{ \Illuminate\Support\Facades\Session::get('success') }}
                                </p>
                            </div>
                        @endif

                        @if(\Illuminate\Support\Facades\Session::has('Error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <p class="mb-0">
                                    {{ \Illuminate\Support\Facades\Session::get('Error') }}
                                </p>
                            </div>
                        @endif
                        @if(count($errors))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <input type="text" id="name" name="name" placeholder="Full Name" class="form-control text-form" value="{{old('name')}}"/>

                        <input type="email" id="email" name="email" placeholder="Business Email" class="form-control text-form" value="{{old('email')}}"/>

{{--                        <input type="text" id="company" name="company" placeholder="Company" class="form-control text-form"/>--}}

                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="number" id="phone" name="phone" placeholder="Business Phone (812345xxxxxx)" class="form-control " style="border-left: none"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('phone')}}"/>
                        </div>


                        <input type="text" id="message" name="message" placeholder="Message" class="form-control text-form" style="height: 100px" value="{{old('message')}}"/>
                        <button class="btn btn-outline-danger-c w-100 py-3 br-10 mt-5" type="submit" id="button-addon2">Send</button>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <style>
        .border-outline-contact{
            border : 1px solid #17abd9;
            border-radius: 10px;
        }
        .border-contact{
            border-left: 1px solid darkgrey;
            margin: auto;
        }
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;
            background-color: #000;
        }

        .slick-slide {
            height: auto;
        }

        .martop {
            margin-top: 9vh;
        }

        .odd:not(.custom) .card:not(.no-hover):not(:hover) {
            background-color: #184d47;
        }

        .odd h4, .body-mode-dark h4 {
            color: #000;
        }



        .text-form {
            margin-top: 12px;
            /*display: flex;
            align-items: start;
            justify-content: start;*/
        }



        @media (min-width: 576px) {

        }

        @media (min-width: 1900px) {

        }
    </style>
@endsection
