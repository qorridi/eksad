@extends('layouts.frontend')


<meta name="description" content="EKSAD, Technology">
<meta name="subject" content="EKSAD, Technology">
<meta name="author" content="EKSAD">
<title>EKSAD Technology</title>

@section('content')

    <!-- Banner -->
    <section  id="" class=" bg-banner py-5 martop">
        <div class="container-fluid pt-3">
            <div class="d-none d-md-block">
                <div class="row px-md-5">
                    <div class="col-6 ps-md-5">
                        <div class="row pb-3">
                            <div class="col-12">
                                <p class="txt-body1 fw-bold text-dark">{{ $portfolio->client_name }}</p>
                                <div class="border-title"></div>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-12">
                                <p class="txt-body4 text-dark pt-md-5 ">{{ $portfolio->description }}</p>
                            </div>
                            <div class="col-12">
                                <img src="{{ asset('storage/portfolio_images/'. $portfolio->img_logo) }}" alt="{{ $portfolio->client_name }}" class="logo-responsive" style="width: auto; height: 55px">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <img src="{{ asset('storage/portfolio_images/'. $portfolio->img_primary) }}" class="img-banner" alt="" style="max-height: 500px">
                    </div>
                </div>
            </div>
            <div class="row d-block d-md-none">
                <div class="col-12 text-end">
                    <img src="{{ asset('storage/portfolio_images/'. $portfolio->img_primary) }}" class="img-banner" alt="">
                </div>
                <div class="col-12 pb-3">
                    <p class="txt-body1 fw-bold text-dark">Lorem ipsum dolor sit amet</p>
                    <div class="border-title"></div>
                </div>
                <div class="col-12 pb-5">
                    <p class="txt-body3 text-dark pt-md-5 ">{{ $portfolio->description }}</p>
                </div>
                <div class="col-12">
                    <img src="{{ asset('storage/portfolio_images/'. $portfolio->img_logo) }}" alt="{{ $portfolio->client_name }}" class="logo-responsive" style="width: auto; height: 55px">
                </div>

            </div>
        </div>
    </section>
{{--    <section class="py-5" style="background-color: #F2F2F2;">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row px-md-5">--}}
{{--                <div class="col-2">--}}
{{--                    <div class="row">--}}
{{--                        <a href="" class="pt-3">--}}
{{--                            <p class="txt-body4 text-dark fw-bold">Client</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="row pt-2">--}}
{{--                        <div class="col-12">--}}
{{--                            <a href="">--}}
{{--                                <p class="txt-body4 text-dark ">{{ $portfolio->client_name }}</p>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-2 text-center">--}}
{{--                    <div class="row">--}}
{{--                        <a href="" class="pt-3">--}}
{{--                            <p class="txt-body4 text-dark fw-bold">Year</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="row pt-2">--}}
{{--                        <div class="col-12">--}}
{{--                            <a href="">--}}
{{--                                <p class="txt-body4 text-dark ">{{ $portfolio->year ?? '-' }}</p>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-4">--}}
{{--                    <div class="row">--}}
{{--                        <a href="" class="pt-3">--}}
{{--                            <p class="txt-body4 text-dark fw-bold">Services</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="row pt-2">--}}
{{--                        @if($portfolio->solutions != null && $portfolio->solutions->count() > 0)--}}
{{--                            @foreach($portfolio->solutions as $solution)--}}
{{--                                <div class="col-6">--}}
{{--                                    <a href="{{ route('frontend.solution.detail', ['id' => $solution->id]) }}">--}}
{{--                                        <p class="txt-body4 text-blue text-decoration-underline m-0">{{ $solution->name }}</p>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            <div class="col-6">-</div>--}}
{{--                        @endif--}}


{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-4">--}}
{{--                    <div class="row">--}}
{{--                        <a href="" class="pt-3">--}}
{{--                            <p class="txt-body4 text-dark fw-bold">Products</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="row pt-2">--}}
{{--                        <div class="col-12">--}}
{{--                            @if($portfolio->products != null && $portfolio->products->count() > 0)--}}
{{--                                @foreach($portfolio->products as $product)--}}
{{--                                    <div class="col-6">--}}
{{--                                        <a href="#">--}}
{{--                                            <p class="txt-body4 text-blue text-decoration-underline m-0">{{ $product->name }}</p>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                                <div class="col-6">-</div>--}}
{{--                            @endif--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section class="py-5" style="background: white">
        <div class="container">
            <div class="col-12">
                <ul class="nav nav-pills nav-fill mb-3 justify-content-center" id="pills-tab" role="tablist">
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active txt-body3" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab"--}}
{{--                           aria-controls="pills-1" aria-selected="false">Pre Process</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link txt-body3" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab"--}}
{{--                           aria-controls="pills-2" aria-selected="false">Process</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link txt-body3" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab"--}}
{{--                           aria-controls="pills-3" aria-selected="false">Post Process</a>--}}
{{--                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link active txt-body3" id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab"
                           aria-controls="pills-4" aria-selected="false">Gallery</a>
                    </li>
                </ul>
                <div class="tab-content txt-body3 text-dark py-3 px-3" id="pills-tabContent">
                    <div class="tab-pane fade  " id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                        <div class="col-12">
                            @if(!empty($portfolio->description_3))
                                {!! $portfolio->description_3 !!}
                            @else
                                -
                            @endif
{{--                            <p class="txt-body4 text-dark pt-md-5 ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fortasse id optimum, sed ubi illud: Plus semper voluptatis. Ea, quae dialectici nunc tradunt et docent, nonne ab illis instituta sunt aut inventa sunt.--}}
{{--                                Id enim volumus, id contendimus, ut officii fructus sit ipsum officium. Et quod est munus, quod opus sapientiae? Istam voluptatem, inquit, Epicurus ignorat.</p>--}}

{{--                            <img src="{{asset('images/wholesome/card-dummy.png')}}" class="w-50" alt=""><img>--}}
{{--                            <p class="txt-body4 text-dark pt-md-5 ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fortasse id optimum, sed ubi illud: Plus semper voluptatis. Ea, quae dialectici nunc tradunt et docent, nonne ab illis instituta sunt aut inventa sunt.--}}
{{--                                Id enim volumus, id contendimus, ut officii fructus sit ipsum officium. Et quod est munus, quod opus sapientiae? Istam voluptatem, inquit, Epicurus ignorat.</p>--}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                        <div class="col-12">
                            @if(!empty($portfolio->description_4))
                                {!! $portfolio->description_4 !!}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                        <div class="col-12">
                            @if(!empty($portfolio->description_5))
                                {!! $portfolio->description_5 !!}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
                        <div class="col-12">
                            <div class="row">
                                @foreach($portfolio->portfolio_images as $img)
                                    <div class="col-4 py-3">
                                        <img src="{{ asset('storage/portfolio_images/'. $img->img_path) }}" class="w-100" alt=""><img>
                                    </div>
                                @endforeach
{{--                                <div class="col-4 py-3">--}}
{{--                                    <img src="{{asset('images/wholesome/card-dummy.png')}}" class="w-100" alt=""><img>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-6 text-start text-black">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> &nbsp;&nbsp; Previous

                </div>
                <div class="col-6 text-end text-black">
                    Next&nbsp;&nbsp; <i class="fa fa-chevron-right" aria-hidden="true"></i>

                </div>
            </div>
        </div>
    </section>
    <section class="py-5" style="background: white">
        <div class="container-fluid">
            <div class="row pb-5">
                <div class="col-12 text-center">
                    <p class="txt-body1 fw-bold text-dark">Related Portfolios</p>
                    <div class="border-title-2"></div>
                </div>
            </div>
            <div class="row px-5">
                @foreach($relatedPortfolios as $relatedPortfolio)
                    <div class="col-md-4 py-3">
                        <div class="portfolio-slider">
                            @foreach($relatedPortfolio->portfolio_images as $img)
                                <div>
                                    <img src="{{ asset('storage/portfolio_images/'. $img->img_path) }}" class="w-100" alt="">
                                </div>
                            @endforeach
{{--                            <div>--}}
{{--                                <img src="{{asset('images/wholesome/card-dummy.png')}}" class="w-100" alt="">--}}
{{--                            </div>--}}
                        </div>

                        <p class="txt-body-4 pt-3 m-0 text-dark">2022</p>
                        <a href="{{ route("frontend.portfolio.detail", ['id' => $relatedPortfolio->id] )}}">
                            <p class="txt-body1 fw-bolder m-0 text-dark">{{ $relatedPortfolio->client_name }}</p>
                        </a>
                        <p class="txt-body-4 text-dark">{{ $relatedPortfolio->short_description }}</p>
                        <img src="{{ asset('storage/portfolio_images/'. $img->img_path) }}" class="" alt="" width="50">
                    </div>
                @endforeach

{{--                <div class="col-md-4 py-3">--}}
{{--                    <div class="portfolio-slider">--}}
{{--                        <div>--}}
{{--                            <img src="{{asset('images/wholesome/card-dummy.png')}}" class="w-100" alt="">--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <img src="{{asset('images/wholesome/card-dummy.png')}}" class="w-100" alt="">--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <img src="{{asset('images/wholesome/card-dummy.png')}}" class="w-100" alt="">--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <img src="{{asset('images/wholesome/card-dummy.png')}}" class="w-100" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <p class="txt-body-4 pt-3 m-0 text-dark">2022</p>--}}
{{--                    <a href="{{route("frontend.portfolio_detail", ['slug' => 'porto1'])}}">--}}
{{--                        <p class="txt-body1 fw-bolder m-0 text-dark">Non enim, si malum est dolor</p>--}}
{{--                    </a>--}}
{{--                    <p class="txt-body-4 text-dark">Recte, inquit, intellegis. Si stante, hoc natura videlicet vult, salvam esse se, quod concedim...</p>--}}
{{--                    <img src="{{asset('images/wholesome/logo.png')}}" class="" alt="" width="50">--}}
{{--                    <img src="{{asset('images/wholesome/logo.png')}}" class="" alt="" width="50">--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
    <section class="py-5" style="background-color: #F2F2F2;">
        <div class="container-fluid">
            <div class="row pb-5 px-md-5">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <p class="txt-body1 fw-bold text-dark">Ready to transform?</p>
                            <div class="border-title"></div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="" class="pt-3">
                            <p class="txt-body3 text-dark">Whenever you’re ready!
                                Don’t hesitate to reach us, by clicking the “Get a Quote” button. After clicking, you’ll be directed to a page where you can tell us all of your needs.</p>
                        </a>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12">
                            <a href="">
                                <p class="txt-body2 text-blue fw-bold">Get a Quote</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <p class="txt-body1 fw-bold text-dark">Or Learn More About Us</p>
                            <div class="border-title"></div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="" class="pt-3">
                            <p class="txt-body3 text-dark">
                                Not sure which service to choose? Feel free to learn more about us, see our portfolio or browse our products.
                            </p>
                        </a>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12">
                            <a href="">
                                <p class="txt-body2 text-blue fw-bold">Learn More About Us</p>
                            </a>
                            <a href="">
                                <p class="txt-body2 text-blue fw-bold">See Our Portfolio</p>
                            </a>
                            <a href="">
                                <p class="txt-body2 text-blue fw-bold">Browse Our Products</p>
                            </a>
                        </div>
                    </div>
                </div>
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
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: #334155;
            background-color: transparent;
            border-color: transparent;
            /*box-shadow: inset 0 -3px #00B0F7;*/
            border-radius: 0;
        }
        .martop-banner{
            margin-top: 58vh;
        }
        .container-fluid{
            padding: 0 !important;
        }
        .icon-team-socmed{
            width:25px;
        }
        .img-vision{
            width: 100px;
        }
        .img-mission{
            width: 65px;
        }
        .bg-service{
            background-image: url('{{asset('images/wholesome/solution/solutions - banner.png')}}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            width: 100%;
            height: 21vh;
            position: relative;
            margin-top: -1px;
        }

        .img-core{
            width:75px;
        }
        .slick-slide{
            height: auto;
        }
        .martop{
            margin-top: 9vh;
        }
        .txt-card{
            color:#331d5e;
        }
        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }

        .card{
            border-color: black;
        }


        .odd h4, .body-mode-dark h4{
            color: #000;
        }
        .bg-banner{
            background-color: white;
        }
        .img-banner{
            width:80%;
        }
        .border-title{
            border-bottom: 5px solid #7BDBFC;
            width:50px;
            margin-top: -25px;
        }
        .border-title-2{
            border-bottom: 5px solid #7BDBFC;
            width:100px;
            margin:0 auto;
            margin-top: -25px;
        }


        @media(min-width: 576px){
            .img-banner{
                width:80%;
            }
            .bg-service{
                height: 41vh;
            }
            .martop-banner{
                margin-top: 49vh;
            }
        }
        @media(min-width: 1900px){
            .martop-banner{
                margin-top: 58vh;
            }
            .img-banner{
                width:80%;
            }
            .bg-vision{
                height:57vh;
            }
            .bg-mission{
                height:57vh;
            }
            .bg-service{
                height: 40vh;
            }
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>

        $(".portfolio-slider").slick({
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
    </script>

@endsection
