@extends('layouts.frontend')

@section('head_and_title')
    <meta name="description" content="EKSAD, Technology">
    <meta name="subject" content="EKSAD, Technology">
    <meta name="author" content="EKSAD">
    <title>EKSAD Technology</title>
@endsection

@section('content')

    <section class="py-5 martop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <p class="txt-body6 txt-header-color font-rubik-bold pb-3">{{$portfolio->client_name}}</p>
                    <p class="txt-body3 text-dark pe-md-7 pb-5">{{$portfolio->description_2}}</p>
                    <img src="{{asset('storage/portfolio_images/'.$portfolio->img_logo)}}" class="img-solution-porto" alt="">
                </div>
                <div class="col-md-6">
                    <img src="{{asset('storage/portfolio_images/'.$portfolio->img_primary)}}" class="h-100" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 mb-1" style="background-color: #f2f2f2">
        <div class="container">
            <div class="row txt-body3 text-dark">
                <div class="col-md-4">
                    <p class="fw-bold">Client</p>
                    <p>{{$portfolio->client_name}}</p>
                </div>
                <div class="col-md-4">
                    <p class="fw-bold">Year</p>
                    <p>{{$portfolio->year}}</p>
                </div>
                <div class="col-md-4">
                    <p class="fw-bold pb-3">Solutions Offered</p>
                    @foreach($portfolio->solutions as $solution)
                    <a href="{{route('frontend.solutions')}}">
                        <p class="fw-bold text-decoration-underline red-eksad pb-3">{{ $solution->name }}</p>
                    </a>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row text-center">
                        <ul class="nav nav-pills mb-3 text-center" id="pills-tab" role="tablist">
                            <li class="nav-item col-md-4">
                                <a class="nav-link active txt-body5" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="false">Problem </a>
                            </li>
                            <li class="nav-item col-md-4">
                                <a class="nav-link txt-body5" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false"><span class="float-start">&nbsp;></span>Solution </a>
                            </li>
                            <li class="nav-item col-md-4">
                                <a class="nav-link txt-body5" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false"><span class="float-start">&nbsp;></span>Result</a>
                            </li>
                        </ul>
                    </div>

                    <div style="border-bottom: 2px solid black !important;width:100%;"></div>
                    <div class="tab-content txt-body3 text-dark py-3 px-3" id="pills-tabContent">
                        <div class="tab-pane fade show active txt-body3" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                            {!! $portfolio->description_3 !!}
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                            {!! $portfolio->description_4 !!}
                        </div>
                        <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                            {!! $portfolio->description_5 !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12 text-center">
                        <p class="txt-body6 txt-header-color font-rubik-bold pb-3">Related Portfolio</p>
                </div>
            </div>
            <div class="row">
                @foreach($relatedPortfolios as $relatedPortfolio)
                    <div class="col-md-4 pb-5">
                        <div class="card">
                            <div class="card-top">
                                <div>
                                    <img src="{{ asset('/storage/portfolio_images/'. $relatedPortfolio->img_primary) }}" class="w-100 p-3" alt="">
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route("frontend.portfolio_detail", ['id' => $relatedPortfolio->id])}}">
                                    <p class="txt-body4 pt-3 m-0 text-dark">{{$relatedPortfolio->year}}</p>
                                    <p class="card-title txt-body2 fw-bolder m-0 text-dark">{{$relatedPortfolio->description}}</p>
                                    <div class="py-3">
                                        <img src="{{asset('storage/portfolio_images/'.$relatedPortfolio->img_logo)}}" class="img-solution-porto" alt="">
                                    </div>
                                </a>
                                <a href="{{route("frontend.portfolio_detail", ['id' => $relatedPortfolio->id])}}" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Detail</p></a>
                            </div>
                        </div>
                    </div>
                @endforeach
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
            border-bottom: 1px solid #d42627;
            margin: auto;
            width:65%;
            font-weight: bold;
        }

        .container-fluid{
            padding: 0 !important;
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

        .card{
            border-color: black;
        }


        .odd h4, .body-mode-dark h4{
            color: #000;
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
