@extends('layouts.frontend')


<meta name="description" content="EKSAD, Technology">
<meta name="subject" content="EKSAD, Technology">
<meta name="author" content="EKSAD">
<title>EKSAD Technology</title>

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
                        <li class="nav-item">
                            <a class="nav-link active txt-tab" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="false">Software as a Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link txt-tab" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">Cloud</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link txt-tab" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">IT Resource</a>
                        </li>
                    </ul>

                    {{--                    <button class="tablinks active txt-body-3 d-none d-md-block pb-3" onclick="openCity(event, 'saas')">Software as a Solution</button>--}}
                    {{--                    <button class="tablinks txt-body-3 d-none d-md-block pb-3" onclick="openCity(event, 'cloud')">Cloud</button>--}}
                    {{--                    <button class="tablinks txt-body-3 d-none d-md-block pb-3" onclick="openCity(event, 'resource')">IT Resource</button>--}}
                    {{--                    <div class="btn btn-lg btn-dev-bg font-angleciapro txt-body-3 text-center text-white py-3 px-5">URBAN+</div>--}}
                </div>
                <div class="col-md-8 text-dark">
                    <div class="tab-content txt-body3 text-dark py-3 px-3" id="pills-tabContent">
                        <div class="tab-pane fade show active " id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                            <img src="{{asset('images/eksad/home/solutions-1.png')}}" style="width:65px;"  alt="">
                            <p class="txt-body5 fw-bold">Software as a Service</p>
                            <p class="txt-body3">
                                Partim cursu et peragratione laetantur, congregatione aliae coetum quodam modo civitatis imitantur
                            </p>
                            <div class="row pt-5">
                                @foreach( $services_1 as $service_1)
                                <div class="col-md-6 pb-3">
                                    <div class="card mt-3">
                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">
                                        <div class="card-body">
                                            <p class="text-dark txt-body2 pb-2 fw-bold">{{$service_1->name}}</p>
                                            <p class="card-text txt-body4 text-dark">{{$service_1->description}}</p>
                                            <p class="txt-body3 text-dark py-3">Portfolio</p>
                                            <div class="pb-3">
                                                <img src="{{$service_1->image_path}}" class="img-solution-porto" alt="">
{{--                                                <img src="{{asset('images/eksad/solutions/solution-1-2.png')}}" class="img-solution-porto" alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-1-3.png')}}" class="img-solution-porto" alt="">--}}
                                            </div>
                                            <a href="{{route('frontend.portfolio')}}" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Portfolio</p></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">HRIS</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quare attende, quaeso. Si id dicis, vicimus. Duo Reges.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Portfolio</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-2-1.png')}}" class="img-solution-porto" alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-2-2.png')}}" class="img-solution-porto " alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Portfolio</p></a>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold"><p>Visit Product Website</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">Mobile Application</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Clients:</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-1.png')}}" class="img-solution-porto" alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-2.png')}}" class="img-solution-porto " alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-3.png')}}" class="img-solution-porto " alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>More Info</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">E-Procurement</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Clients:</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-1-3.png')}}" class="img-solution-porto" alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>More Info</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                            <img src="{{asset('images/eksad/home/solutions-2.png')}}" style="width:65px;"  alt="">
                            <p class="txt-body5 fw-bold">Cloud</p>
                            <p class="txt-body3">
                                Partim cursu et peragratione laetantur, congregatione aliae coetum quodam modo civitatis imitantur
                            </p>
                            <div class="row pt-5">
                                @foreach( $services_2 as $service_2)
                                    <div class="col-md-6 pb-3">
                                        <div class="card mt-3">
                                            <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">
                                            <div class="card-body">
                                                <p class="text-dark txt-body2 pb-2 fw-bold">{{$service_2->name}}</p>
                                                <p class="card-text txt-body4 text-dark">{{$service_2->description}}</p>
                                                <p class="txt-body3 text-dark py-3">Portfolio</p>
                                                <div class="pb-3">
                                                    <img src="{{$service_2->image_path}}" class="img-solution-porto" alt="">
                                                    {{--                                                <img src="{{asset('images/eksad/solutions/solution-1-2.png')}}" class="img-solution-porto" alt="">--}}
                                                    {{--                                                <img src="{{asset('images/eksad/solutions/solution-1-3.png')}}" class="img-solution-porto" alt="">--}}
                                                </div>
                                                <a href="{{route('frontend.portfolio')}}" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Portfolio</p></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">HRIS</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quare attende, quaeso. Si id dicis, vicimus. Duo Reges.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Portfolio</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-2-1.png')}}" class="img-solution-porto" alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-2-2.png')}}" class="img-solution-porto " alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Portfolio</p></a>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold"><p>Visit Product Website</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">Mobile Application</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Clients:</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-1.png')}}" class="img-solution-porto" alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-2.png')}}" class="img-solution-porto " alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-3.png')}}" class="img-solution-porto " alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>More Info</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">E-Procurement</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Clients:</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-1-3.png')}}" class="img-solution-porto" alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>More Info</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                            <img src="{{asset('images/eksad/home/solutions-3.png')}}" style="width:65px;"  alt="">
                            <p class="txt-body5 fw-bold">IT Resource</p>
                            <p class="txt-body3">
                                Partim cursu et peragratione laetantur, congregatione aliae coetum quodam modo civitatis imitantur
                            </p>
                            <div class="row pt-5">
                                @foreach( $services_3 as $service_3)
                                    <div class="col-md-6 pb-3">
                                        <div class="card mt-3">
                                            <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">
                                            <div class="card-body">
                                                <p class="text-dark txt-body2 pb-2 fw-bold">{{$service_3->name}}</p>
                                                <p class="card-text txt-body4 text-dark">{{$service_3->description}}</p>
                                                <p class="txt-body3 text-dark py-3">Portfolio</p>
                                                <div class="pb-3">
                                                    <img src="{{$service_3->image_path}}" class="img-solution-porto" alt="">
                                                    {{--                                                <img src="{{asset('images/eksad/solutions/solution-1-2.png')}}" class="img-solution-porto" alt="">--}}
                                                    {{--                                                <img src="{{asset('images/eksad/solutions/solution-1-3.png')}}" class="img-solution-porto" alt="">--}}
                                                </div>
                                                <a href="{{route('frontend.portfolio')}}" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Portfolio</p></a>
{{--                                                <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold"><p>Visit Product Website</p></a>--}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">HRIS</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quare attende, quaeso. Si id dicis, vicimus. Duo Reges.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Portfolio</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-2-1.png')}}" class="img-solution-porto" alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-2-2.png')}}" class="img-solution-porto " alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Portfolio</p></a>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold"><p>Visit Product Website</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">Mobile Application</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Clients:</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-1.png')}}" class="img-solution-porto" alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-2.png')}}" class="img-solution-porto " alt="">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-3-3.png')}}" class="img-solution-porto " alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>More Info</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 pb-3">--}}
{{--                                    <div class="card mt-3">--}}
{{--                                        <img class="card-img-top" src="{{asset('images/eksad/solutions/img-solution-dummy.png')}}"  alt="Card image cap">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="text-dark txt-body2 pb-2 fw-bold">E-Procurement</p>--}}
{{--                                            <p class="card-text txt-body4 text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                                            <p class="txt-body3 text-dark py-3">Clients:</p>--}}
{{--                                            <div class="pb-3">--}}
{{--                                                <img src="{{asset('images/eksad/solutions/solution-1-3.png')}}" class="img-solution-porto" alt="">--}}
{{--                                            </div>--}}
{{--                                            <a href="" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>More Info</p></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
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
        .icon-team-socmed{
            width:25px;
        }
        .img-vision{
            width: 100px;
        }
        .img-mission{
            width: 65px;
        }
        .bg-indonesia{
            background-image: url('{{asset('images/eksad/about/indonesia-map.png')}}');
            background-repeat: no-repeat;
            background-position: right;
            background-size: contain;
            width: 100%;
            height: 43vh;
            position: relative;
            margin-top: -1px;
        }
        .bg-vision{
            background-image: url('{{asset('images/infinit/about/about - vision.png')}}');
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            width: 100%;
            height: 43vh;
            position: relative;
            margin-top: -1px;
        }
        .bg-mission{
            background-image: url('{{asset('images/infinit/about/about - mission.png')}}');
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            width: 100%;
            height: 43vh;
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
        }
        @media(min-width: 1900px){
            .img-banner{
                width:100%;
            }
            .bg-vision{
                height:57vh;
            }
            .bg-mission{
                height:57vh;
            }
            .bg-indonesia{
                height:60vh;
            }
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
