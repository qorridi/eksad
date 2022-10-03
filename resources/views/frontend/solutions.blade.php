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
                    <p class="txt-body1 font-rubik-bold text-white">Solutions</p>
                </div>
            </div>
        </div>
    </section>



    <section class="py-5">
        <div class="container">
            <div class="row text-dark">
                <div class="col-md-3 text-center text-md-start ">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @php($ct=1)
                        @foreach($solutionCategories as $solutionCategory)
                            @php($activeblock = "")
                            @if($ct == 1)
                                @php($activeblock = "active")
                            @endif
                            <li class="nav-item">
                                <a class="nav-link {{$activeblock}} txt-tab" id="pills-{{$ct}}-tab" data-toggle="pill" href="#pills-{{$ct}}" role="tab" aria-controls="pills-{{$ct}}" aria-selected="false">
                                    {{$solutionCategory->name}}
                                </a>
                            </li>
                            @php($ct++)
                        @endforeach

                    </ul>
               </div>
                <div class="col-md-8 text-dark">
                    <div class="tab-content txt-body3 text-dark py-3 px-3" id="pills-tabContent">
                        @php($ct2=1)
                        @foreach($solutionCategories as $solutionCategory)
                            @php($activeblock = "")
                            @if($ct2 == 1)
                                @php($activeblock = "active")
                            @endif
                            <div class="tab-pane fade show {{$activeblock}} " id="pills-{{$ct2}}" role="tabpanel" aria-labelledby="pills-{{$ct2}}-tab">
                                <img src="{{asset($solutionCategory->image_path)}}" style="width:65px;"  alt="">
                                <p class="txt-body5 fw-bold pt-3">{{$solutionCategory->name}}</p>
                                <p class="txt-body3">
                                    {{$solutionCategory->description}}
                                </p>
                                <div class="row pt-5">
                                    @if(count($solutionCategory->solutions))
                                        @foreach($solutionCategory->solutions as $solution_1)
                                            <div class="col-md-6 pb-3">
                                                <div class="card mt-3">
                                                    <div style="height: 22vh;">
                                                        <img class="card-img-top w-100" src="{{asset($solution_1->image_path)}}" style="max-height: 22vh;"  alt="Card image cap">
                                                    </div>
                                                    <div class="card-body">
                                                    <p class="text-dark txt-body2 pb-2 fw-bold">{{$solution_1->name}}</p>
                                                    <p class="card-text txt-body4 text-dark sol-card-h">{{$solution_1->description}}</p>
                                                    <p class="txt-body3 text-dark py-3">Portfolio</p>
                                                    <div class="pb-3">
                                                        @if(count($solution_1->portfolios) > 0)
                                                            @foreach($solution_1->portfolios as $portfolio)
                                                                <img src="{{asset('storage/portfolio_images/'. $portfolio->img_logo)}}" class="img-solution-porto" alt="">
                                                            @endforeach
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </div>
                                                    <a href="{{route('frontend.portfolio')}}" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Portfolio</p></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <span style="color: red">On Progress Development</span>
                                    @endif
                                </div>
                            </div>

                            @php($ct2++)
                        @endforeach
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
        .txt-tab{
            font-size: 16px;
        }
        button{
            background-color: transparent;
            border-radius: 0;
            border: none;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color:#d42627;
            text-decoration: underline;
            font-weight: bold;
            background-color: transparent;
        }
        .nav{
            display: contents;
        }
        .container-fluid{
            padding:0 !important;
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
                width:100%;
            }
            .bg-vision{
                height: 70vh;
            }
            .bg-mission{
                height: 70vh;
            }
            .sol-card-h{
                height:10vh;
            }
        }
        @media(min-width: 1900px){
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the link that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

@endsection
