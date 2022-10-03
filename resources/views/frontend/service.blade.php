@extends('layouts.frontend')

@section('head_and_title')
    <meta name="description" content="EKSAD, Technology">
    <meta name="subject" content="EKSAD, Technology">
    <meta name="author" content="EKSAD">
    <title>EKSAD Technology</title>
@endsection

@section('content')

    <!-- Banner -->
    <section  id="" class=" bg-service   py-5 martop">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-6"></div>
                <div class="col-6 px-0">
                    <div class="bg-white p-md-3 martop-banner d-none d-md-block" style="border-left: 5px solid #4d7efa;height: auto">
                        <p class="text-dark txt-banner fw-bolder mb-1">We strive for excellence</p>
                        <p class="text-dark txt-banner ">in every project we handle</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pb-3">
                    <p class="txt-body1 fw-bold text-dark">Discover IT solution<br/> that works for you</p>
                    <p class="text-dark txt-body4 pe-md-5">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Etsi ea quidem, quae adhuc dixisti, quamvis ad aetatem recte isto modo dicerentur.
                        Idem fecisset Epicurus, si sententiam hanc, quae nunc Hieronymi est, coniunxisset cum Aristippi vetere sententia.
                    </p>
                </div>
                <div class="col-md-8">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">Business Analytics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">Big Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">IT Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab" aria-controls="pills-4" aria-selected="false">IT Infrastructure</a>
                        </li>
                    </ul>
                    <div class="tab-content txt-body3 text-dark" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etsi ea quidem, quae adhuc dixisti, quamvis ad aetatem recte isto modo dicerentur. Idem fecisset Epicurus, si sententiam hanc, quae nunc Hieronymi est, coniunxisset cum Aristippi vetere sententia. Quis negat? Ut optime, secundum naturam affectum esse possit. Atque hoc loco similitudines eas, quibus illi uti solent, dissimillimas proferebas.</p>
                            <a href="" class="pt-3">
                                <p class="txt-body3 text-danger fw-bolder">See portfolio&nbsp;&nbsp;&nbsp;→</p>
                            </a>
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etsi ea quidem, quae adhuc dixisti, quamvis ad aetatem recte isto modo dicerentur. Idem fecisset Epicurus, si sententiam hanc, quae nunc Hieronymi est, coniunxisset cum Aristippi vetere sententia. Quis negat? Ut optime, secundum naturam affectum esse possit. Atque hoc loco similitudines eas, quibus illi uti solent, dissimillimas proferebas.</p>
                            <a href="" class="pt-3">
                                <p class="txt-body3 text-danger fw-bolder">See portfolio&nbsp;&nbsp;&nbsp;→</p>
                            </a>
                        </div>
                        <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etsi ea quidem, quae adhuc dixisti, quamvis ad aetatem recte isto modo dicerentur. Idem fecisset Epicurus, si sententiam hanc, quae nunc Hieronymi est, coniunxisset cum Aristippi vetere sententia. Quis negat? Ut optime, secundum naturam affectum esse possit. Atque hoc loco similitudines eas, quibus illi uti solent, dissimillimas proferebas.</p>
                            <a href="" class="pt-3">
                                <p class="txt-body3 text-danger fw-bolder">See portfolio&nbsp;&nbsp;&nbsp;→</p>
                            </a>
                        </div>
                        <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etsi ea quidem, quae adhuc dixisti, quamvis ad aetatem recte isto modo dicerentur. Idem fecisset Epicurus, si sententiam hanc, quae nunc Hieronymi est, coniunxisset cum Aristippi vetere sententia. Quis negat? Ut optime, secundum naturam affectum esse possit. Atque hoc loco similitudines eas, quibus illi uti solent, dissimillimas proferebas.</p>
                            <a href="" class="pt-3">
                                <p class="txt-body3 text-danger fw-bolder">See portfolio&nbsp;&nbsp;&nbsp;→</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5" style="background-color: #F2F2F2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="txt-body1 fw-bolder text-dark">Notable Achievements</p>
                    <div class="border-title-2"></div>
                    <div class="pb-3">
                        <p class="pt-5"><span class="txt-body1 fw-bolder text-dark">Rp.600B+</span><br/>
                        <span class="text-dark">of infrastructure cost</span></p>
                        <p class="txt-body-4 text-dark">was saved in the first 3 months of implementations</p>
                    </div>
                    <div class="pb-3">
                        <p class="pt-5"><span class="txt-body1 fw-bolder text-dark">30</span><br/>
                            <span class="text-dark">sites installed</span></p>
                        <p class="txt-body-4 text-dark">was saved in the first 3 months of implementations</p>
                    </div>
                </div>
                <div class="col-md-6" style="margin: auto 0;">
                    <img src="{{asset('images/infinit/solution/solutions - notable achievements.png')}}" class="w-100" alt="">
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
            color: #fff;
            background-color: #000;
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
            background-image: url('{{asset('images/infinit/solution/solutions - banner.png')}}');
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
            background-color: #1b1b1b;
        }
        .img-banner{
            width:100%;
        }
        .border-title{
            border-bottom: 5px solid red;
            width:100px;
            margin:0 auto;
            margin-top: -25px;
        }
        .border-title-2{
            border-bottom: 5px solid red;
            width:100px;
            margin-top: -25px;
        }
        p{
            margin-bottom: 1em;
        }

        @media(min-width: 576px){
            .img-banner{
                width:100%;
            }
            .bg-service{
                height: 81vh;
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
                width:100%;
            }
            .bg-vision{
                height:57vh;
            }
            .bg-mission{
                height:57vh;
            }
            .bg-service{
                height: 80vh;
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
