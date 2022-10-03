@extends('layouts.frontend')


@section('head_and_title')
    <meta name="description" content="EKSAD, Technology">
    <meta name="subject" content="EKSAD, Technology">
    <meta name="author" content="EKSAD">
    <title>EKSAD Technology</title>
@endsection

@section('content')

    <!-- Banner -->
    <section  id="" class="bg-blue-eksad bg-about   py-5 martop">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5 text-center text-md-start">
                    <p class="txt-body1 font-rubik-bold text-white">About EKSAD</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 " style="background-color: #F2F2F2">
        <div class="container">
            <div class="row">
                <div class="col-md-5 ">
                    <img src="{{asset('images/eksad/about/img-about-dummy.png')}}" class="w-100" alt="">
                </div>
                <div class="col-md-7 m-auto ps-md-5 pt-3 pt-md-0">
                    <p class="font-rubik-bold txt-body6 pb-3 pb-md-0"><span class="txt-header-color">About EKS</span><span class="red-eksad">AD</span></p>
                    <p class="txt-body3 text-dark">In today’s increasingly technology driven marketplace, it is critical to keep up with the latest innovations and solutions, in order to make the most of your investments and keep your business moving forward. So whether you are new to working with an IT Partner, or have worked with one for years, with EKSAD TECHNOLOGY you will find cost-efficient support, guidance and the inspiration you need to provide your business with a competitive advantage.</p>
                    <p class="txt-body3 text-dark pb-3">EKSAD provides tailored services focusing on clients’ specific demands in international and domestic markets. EKSAD TECHNOLOGY is a full-service solution provider. Our head office is located in Jakarta and we support remote sites across multiple continents. We place our focus on leveraging our infrastructure and footprint to support a broad spectrum of organisations with rapid deployment and emerging technologies.</p>
                    <a href="https://erp.eksad.com/document/share/43/25866fe3-5b7b-4270-a106-0991ba8e0af5" class="btn btn-lg text-white txt-body3  bg-red px-4" style="border-radius: 10px;" >
                        Download Company Profile&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{asset("images/eksad/about/icon-download.png")}}" style="width:20px;" alt=""></a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container border-dna p-md-5 p-3">
            <div class="row">
                <div class="col-md-5 text-center text-md-start pb-5">
                    <p class="txt-header-color txt-body6 font-rubik-bold pb-3">Our DNA</p>
                    <p class="txt-body3 text-dark">With 3+ years of experience, we bring you the most modern and capable technologies to boost your business into a whole new level</p>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6 pb-5">
                            <img src="{{asset('images/eksad/home/excellence.png')}}" class="w-25" alt="">
                            <span class="text-dark txt-body2 m-auto">&nbsp;&nbsp;&nbsp;&nbsp;Excellence</span>
                        </div>
                        <div class="col-md-6 pb-5">
                            <img src="{{asset('images/eksad/home/integrity.png')}}" class="w-25" alt="">
                            <span class="text-dark txt-body2 m-auto">&nbsp;&nbsp;&nbsp;&nbsp;Integrity</span>
                        </div>
                        <div class="col-md-6 pb-5 ">
                            <img src="{{asset('images/eksad/home/compassion.png')}}" class="w-25" alt="">
                            <span class="text-dark txt-body2 m-auto">&nbsp;&nbsp;&nbsp;&nbsp;Compassion</span>
                        </div>
                        <div class="col-md-6 ">
                            <img src="{{asset('images/eksad/home/humility.png')}}" class="w-25" alt="">
                            <span class="text-dark txt-body2 m-auto">&nbsp;&nbsp;&nbsp;&nbsp;Humility</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-blue-eksad py-5">
        <div class="container-fluid bg-indonesia">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3 m-auto pt-md-5 pt-xxl-7 pt-3">
                    <div class="pb-5">
                        <p class="txt-body1 font-rubik-bold text-white">Vision</p>
                        <p class="txt-body3 text-white pt-3">To be Preferred IT Partner In The Region.</p>
                    </div>
                    <div>
                        <p class="txt-body1 fw-bold text-white">Mission</p>
                        <p class="txt-body3 text-white pt-3">Establish excellent end to end IT Services to enable clients to grow their business rapidly thru high competence and professional resources</p>
                    </div>
                </div>
                <div class="col-md-7 px-0">
{{--                    <img src="{{asset('images/eksad/about/indonesia-map.png')}}" alt="">--}}
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12">
                    <p class="txt-header-color txt-body6 font-rubik-bold pb-3">Our DNA</p>
                </div>
            </div>
            <div class="row">
                @foreach($teams as $team)
                    <div class="col-md-3 pb-5">
                        <img src="{{asset($team->img_path)}}" class="w-100" alt="">
                        <p class="txt-body5 text-dark fw-bold m-0 pt-3">{{$team->name}}</p>
                        <p class=" text-dark txt-body3 pb-3">{{$team->position}}</p>
                        <p class="text-dark txt-body3 pb-3">{{$team->description}}</p>
                        <div>
                            <a href="{{$team->sosmed_1}}">
                                <img src="{{asset('images/eksad/about/icon-twitter-team.png')}}" class="icon-team-socmed" alt="">
                            </a>
                            <a href="{{$team->sosmed_2}}" class="mx-3">
                                <img src="{{asset('images/eksad/about/icon-linkedin-team.png')}}" class="icon-team-socmed" alt="">
                            </a>
                            <a href="{{$team->sosmed_3}}">
                                <img src="{{asset('images/eksad/about/icon-instagram-team.png')}}" class="icon-team-socmed" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
{{--                <div class="col-md-3 pb-5">--}}
{{--                    <img src="{{asset('images/eksad/about/about - team01.png')}}" class="w-100" alt="">--}}
{{--                    <p class="txt-body5 text-dark fw-bold m-0 pt-3">Ford Harrison</p>--}}
{{--                    <p class=" text-dark txt-body3 pb-3">President Director</p>--}}
{{--                    <p class="text-dark txt-body3 pb-3">Ita relinquet duas, de quibus etiam atque etiam consideret.--}}
{{--                        Quae est igitur causa istarum angustiarum?--}}
{{--                        Bonum integritas corporis: misera debilitas.</p>--}}
{{--                    <div>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-twitter-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#" class="mx-3">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-linkedin-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-instagram-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 pb-5">--}}
{{--                    <img src="{{asset('images/eksad/about/about - team02.png')}}" class="w-100" alt="">--}}
{{--                    <p class="txt-body5 text-dark fw-bold m-0 pt-3">Mark Schaft</p>--}}
{{--                    <p class=" text-dark txt-body3 pb-3">Chief Financial Officer</p>--}}
{{--                    <p class="text-dark txt-body3 pb-3">Epicurus, si sententiam hanc, quae nunc Hieronymi est,--}}
{{--                        coniunxisset cum Aristippi vetere sententia. Quis negat?--}}
{{--                        Ut optime, secundum naturam affectum esse possit.</p>--}}
{{--                    <div>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-twitter-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#" class="mx-3">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-linkedin-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-instagram-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 pb-5">--}}
{{--                    <img src="{{asset('images/eksad/about/about - team03.png')}}" class="w-100" alt="">--}}
{{--                    <p class="txt-body5 text-dark fw-bold m-0 pt-3">Catherine Lynch</p>--}}
{{--                    <p class=" text-dark txt-body3 pb-3">Lead Interior Designer</p>--}}
{{--                    <p class="text-dark txt-body3 pb-3">Restant Stoici, qui cum a Peripateticis et Academicis omnia transtulissent,--}}
{{--                        nominibus aliis easdem res secuti sunt. </p>--}}
{{--                    <div>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-twitter-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#" class="mx-3">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-linkedin-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-instagram-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 pb-5">--}}
{{--                    <img src="{{asset('images/eksad/about/about - team04.png')}}" class="w-100" alt="">--}}
{{--                    <p class="txt-body5 text-dark fw-bold m-0 pt-3">Pablo Wright</p>--}}
{{--                    <p class=" text-dark txt-body3 pb-3">Independent Commissary</p>--}}
{{--                    <p class="text-dark txt-body3 pb-3">Huius, Lyco, oratione locuples, rebus ipsis ielunior.--}}
{{--                        Facillimum id quidem est, inquam. Inde sermone vario sex illa a Dipylo stadia confecimus.</p>--}}
{{--                    <div>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-twitter-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#" class="mx-3">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-linkedin-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                        <a href="#">--}}
{{--                            <img src="{{asset('images/eksad/about/icon-instagram-team.png')}}" class="icon-team-socmed" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>


    <!-- Scroll [to top] -->
    <div id="scroll-to-top" class="scroll-to-top">
        <a href="#header" class="smooth-anchor">
            <i class="icon-arrow-up"></i>
        </a>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <style>
        .container-fluid{
            padding:0 !important;
        }
        .icon-team-socmed{
            width:25px;
        }
        .bg-indonesia{
            {{--background-image: url('{{asset('images/eksad/about/indonesia-map.png')}}');--}}
            background-repeat: no-repeat;
            background-position: right;
            background-size: contain;
            width: 100%;
            height: 43vh;
            position: relative;
            margin-top: -1px;
        }
        .slick-slide{
            height: auto;
        }
        .martop{
            margin-top: 9vh;
        }
        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }

        .odd h4, .body-mode-dark h4{
            color: #000;
        }



        @media(min-width: 576px){

        }
        @media(min-width: 768px){
            .bg-indonesia{
                background-image: url('{{asset('images/eksad/about/indonesia-map.png')}}');
                height:60vh;
            }
        }
        @media(min-width: 1200px){
            .bg-indonesia{
                background-image: url('{{asset('images/eksad/about/indonesia-map.png')}}');
                height:55vh;
            }
        }
        @media(min-width: 1300px){
            .bg-indonesia{
                background-image: url('{{asset('images/eksad/about/indonesia-map.png')}}');
                height:60vh;
            }
        }
        @media(min-width: 1900px){
            .bg-indonesia{
                height:60vh;
            }
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(".partners-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 2,
                        slidesToScroll:2
                    }
                }
            ]
        });
        $(".solutions-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        slidesToShow: 1,
                        slidesToScroll:1
                    }
                }
            ]
        });
    </script>

@endsection
