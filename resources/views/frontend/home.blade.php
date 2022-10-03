@extends('layouts.frontend')


<meta name="description" content="EKSAD, Technology">
<meta name="subject" content="EKSAD, Technology">
<meta name="author" content="EKSAD">
<title>EKSAD Technology</title>

@section('content')

    <!-- Banner -->
    <section class="py-5 martop">
        <div class="container">
            <div class="row">
                <div class="col-12 pb-5">
                    <div class="d-block d-md-none">
                        @foreach ($mainimages as $mainimage)
                                <img src="{{asset($mainimage->image_path)}}" class="w-100" alt="">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-dark txt-body2">Take your business to reach</p>
                    <p class="txt-header-color txt-banner font-rubik-bold">A whole new height</p>
                    <p class=" txt-body3 pb-3 d-none d-md-block">And be the leader in your industry through reliable technology<br/> at your fingertips</p>
                    <p class=" txt-body3 pb-3 d-block d-md-none">And be the leader in your industry through reliable technology at your fingertips</p>
                    <div class="p-3" style="border: 1px solid gray;border-radius: 10px;">
                        <p class="txt-body4">Reach us using your email</p>
                        <span id="invalid-data_home" class="font-weight-bold" style="color:red;display:none;">Data ada yang salah</span>
                        <span id="invalid-submit_home" class="font-weight-bold" style="color:red;display:none;">Terjadi kendala</span>
                        <span id="success-subscribe_home" class="font-weight-bold" style="color:green;display:none;">Thank You for Subscribe</span>
                        <div class="input-group mb-3" >
                            <input id="subscribe_email_home" type="email" class="form-control" placeholder="youremail@email.com" aria-label="Recipient's username" aria-describedby="button-addon2" >
                            <button class="btn btn-outline-danger-c" type="button" id="button-addon2" onclick="submit('home')">Let's have a chat</button>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-4 col-6">
                            <img src="{{asset('images/eksad/home/icon-check.png')}}" style="width:25px;" alt="">
                            <span class="txt-body3 text-dark">3+ years of exp.</span>
                        </div>
                        <div class="col-md-5 col-6">
                            <img src="{{asset('images/eksad/home/icon-check.png')}}" style="width:25px;" alt="">
                            <span class="txt-body3 text-dark">100+ projects handled.</span>
                        </div>
                        <div class="col-md"></div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="d-none d-md-block">
                        @foreach ($mainimages as $mainimage)
                            <img src="{{asset($mainimage->image_path)}}" class="w-100" alt="">
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 px-3 px-md-0">
        <div class="container border-dna p-md-5 p-3">
            <div class="row">
                <div class="col-md-5 pb-3">
                    <p class="txt-header-color txt-body1 font-rubik-bold">Our DNA</p>
                    <p class="txt-body3 text-dark">With 3+ years of experience, we bring you the most modern and capable technologies to boost your business into a whole new level</p>
                    <div class="pt-3">
                        <a href="{{route('frontend.about')}}">
                            <p class="txt-body3 red-eksad fw-bold"><span class="text-decoration-underline">Read More</span>&nbsp;&nbsp;&nbsp;&rarr;</p>
                        </a>
                    </div>
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
                        <div class="col-md-6 pb-5">
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
    <section class="py-5 px-3 px-md-0" >
        <div class="container">
            <div class="row pb-5">
                <div class="col-12 text-center">
                    <p class="txt-body1 txt-header-color font-rubik-bold">Solutions</p>
                    <p class="txt-body3">We help your business grow faster with our sets of IT solutions</p>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col-12 text-center">
                    <div class="solution-slider">
                        @foreach($solutioncategories as $solutioncategory)
                            <div>
                                <div class="card p-4" style="background-color: #FFF">
                                    <img class="img-card" src="{{asset($solutioncategory->image_path)}}" style alt="Card image cap">
                                    <div class="card-body text-start">
                                        <p class="card-title text-dark txt-header-card fw-bolder">{{$solutioncategory->name}}</p>
                                        <p class="card-text pb-3 ellipsis-3">{{$solutioncategory->description}}</p>
                                        <div class="row red-eksad txt-body4 py-2 px-0">
                                        @foreach($solutioncategory->solutions as $solution)
                                            <div class="col-md-6 px-0 pb-2">
                                                <span class="text-decoration-underline ">{{ $solution->name }}</span>
                                            </div>
                                        @endforeach
                                        </div>

{{--                                            <div class="col-md px-0">--}}
{{--                                                <span class="text-decoration-underline ">Dealer Management System</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3 pr-0">--}}
{{--                                                <span class="text-decoration-underline">HRIS</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row red-eksad txt-body4 pb-3">--}}
{{--                                            <div class="col-md-6 px-0">--}}
{{--                                                <span class="text-decoration-underline ">E-Procurement</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 px-0">--}}
{{--                                                <span class="text-decoration-underline">Mobile Application</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <a href="{{route('frontend.solutions')}}">
                                            <p class="txt-body3 red-eksad fw-bold"><span class="text-decoration-underline">Read More</span>&nbsp;&nbsp;&nbsp;&rarr;</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 text-center">
                    <a href="{{route('frontend.solutions')}}" class="btn btn-lg text-white txt-body2 fw-bold bg-red px-4" style="border-radius: 10px;" >
                        See All Solutions</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row pb-5 ">
                <div class="col-md"></div>
                <div class="col-md-10 bg-upgrade text-center">
                    <div class="row">
                        <div class="col-md"></div>
                        <div class="col-md-10 pt-md-7 pt-5">
                            <p class="txt-body1 text-white font-rubik-bold pb-2">Upgrade your tech today</p>
                            <p class="txt-body2 text-white pb-3">With our 10+ years of experience in the tech space, we’ll make sure your business keeps up with the best tech that suits your needs</p>
                            <a href="{{route('frontend.contact_us')}}" class="btn btn-lg text-white txt-body2 fw-bold bg-red px-4" style="border-radius: 10px;" >
                                Let's have a chat</a>
                        </div>
                        <div class="col-md"></div>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
        </div>
    </section>
    <section class="py-md-5 py-3">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12 text-center">
                    <p class="txt-body5 txt-header-color fw-bold">Over dozens of official partners, locally and internationally</p>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col-12 text-center">
                    <div class="partners-slider">
                        <div>
                            <img src="{{asset('images/eksad/home/partners/aws-logo.png')}}" class="w-100 pt-4" alt="">
                        </div>
                        <div>
                            <img src="{{asset('images/eksad/home/partners/google-cloud-logo.png')}}" class="w-100" alt="">
                        </div>
                        <div>
                            <img src="{{asset('images/eksad/home/partners/huawei-logo.png')}}" class="w-100" alt="">
                        </div>
                        <div>
                            <img src="{{asset('images/eksad/home/partners/logo-alibaba_square.png')}}" class="w-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-md-5 py-3">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12 text-center">
                    <p class="txt-body1 fw-bold txt-header-color">Our Clients</p>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 text-center">
                    <div class="clients-slider text-center">
                        @foreach ($clients as $client)
                            <div>
                                <img src="{{asset($client->image_path)}}" class="w-100" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-md-5 py-3">
        <div class="container">
            <div class="row pb-md-5 pb-3">
                <div class="col-12 text-center">
                    <p class="txt-body1 txt-header-color font-rubik-bold">Testimonials</p>
                    <p class="txt-body3">Check what our clients are saying</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-slider">
                        @foreach($testimonies as $testimony)
                        <div>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{asset($testimony->image_path)}}" class="w-100" alt="">
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-6 m-auto">
                                    <p class="quote">&ldquo;</p>
                                    <p class="text-dark fw-bold txt-body5">{{$testimony->description }}</p>
                                    <div class="row pt-5">
                                        <div class="col-md-6">
                                            <p class="txt-body-2 text-dark">{{$testimony->name}}</p>
                                            <p class="txt-body-3 text-gray">{{$testimony->company_name}}</p>
                                        </div>
                                        <div class="col-md-6 text-end">
{{--                                            <img src="{{asset('images/eksad/home/partners-1.png')}}" class="w-50" alt="">--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                        @endforeach
{{--                        <div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <img src="{{asset('images/eksad/home/testimonial-1.png')}}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-1"></div>--}}
{{--                                <div class="col-md-6 m-auto">--}}
{{--                                    <p class="quote">&ldquo;</p>--}}
{{--                                    <p class="text-dark fw-bold txt-body5">Partim cursu et peragratione laetantur, congregatione aliae coetum quodam modo civitatis imitantur; Si enim ad populum me vocas, eum. </p>--}}
{{--                                    <div class="row pt-5">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <p class="txt-body-2 text-dark">Patrick Revera</p>--}}
{{--                                            <p class="txt-body-3 text-gray">Infra Tech Lead</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6 text-end">--}}
{{--                                            <img src="{{asset('images/eksad/home/partners-1.png')}}" class="w-50" alt="">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-1"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12">
                    <p class="txt-body1 d-none d-md-block font-rubik-bold"><span class="txt-header-color">Our Latest Blog Posts</span>
                        <span class="float-end ">
                            <a href="{{route('frontend.blogs')}}" >
                                <span class="red-eksad txt-body2 text-decoration-underline">See all post</span>
                            </a>
                        </span>
                    </p>
                    <p class="txt-body1 d-block d-md-none font-rubik-bold pb-3"><span class="txt-header-color">Our Latest Blog Posts</span> <span class="float-end "><a href="" ></a></span></p>
                    <a href="{{route('frontend.blogs')}}" class="red-eksad d-block d-md-none txt-body2 text-decoration-underline">See all post</a>
                </div>
            </div>
            <div class="row  pb-5">
                @foreach($latestBlogs as $latestBlog)
                    <div class="col-md-4 pb-3">
                        <a href="{{ route('frontend.blog.show', ['slug' => $latestBlog->slug]) }}">
                            <div class="card mt-3 ">
                                <div style="max-height: 21vh">
                                    <img class="card-img-top w-100" style="max-height: 21vh;" src="{{ asset($latestBlog->img_path) }}" alt="Card image cap">
                                </div>
                                {{--                                        <img class="card-img-top" src="{{ asset($blog->img_path) }}" alt="Card image cap">--}}
                                <div class="card-body">
                                        <span class="text-black">{{ \Carbon\Carbon::parse($latestBlog->created_at)->format('d F Y') }}
                                            <span class="ps-3 red-eksad text-decoration-underline">{{$latestBlog->blog_category->description}}</span>
                                        </span>
                                    <p class="card-title text-dark txt-body2 fw-bolder ellipsis-4">{{ $latestBlog->title }}</p>
                                    <p class="card-text text-dark ellipsis h-b">{{ $latestBlog->subtitle }}</p>
                                    <p class="red-eksad">Read More</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="col-md-4 m-auto pt-3">
                    @foreach ($relatedBlogs as $relatedBlogs)
                        <a href="{{ route('frontend.blog.show', ['slug' => $relatedBlogs->slug]) }}">
                            <div class="row pb-4">
                                <div class="col-md-4">
                                    <img src="{{asset($relatedBlogs->img_path)}}" class="w-100" alt="Card image cap" alt="">
                                </div>
                                <div class="col-md-8">
                                <span class="text-black">{{ \Carbon\Carbon::parse($relatedBlogs->created_at)->format('d F Y') }}
                                    <span class="ps-3 red-eksad text-decoration-underline">{{$relatedBlogs->blog_category->description}}</span>
                                </span>
                                    <p class="card-title text-dark txt-body2 fw-bolder ellipsis-2">{{ $relatedBlogs->title }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach

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
        .h-b{
            height: 10vh !important;
        }
        .ellipsis{
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: pre-wrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            height: 80px;
        }
        .ellipsis-2{
            display: -webkit-box !important;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            white-space: pre-wrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            height: auto;
        }
        .ellipsis-3{
            display: -webkit-box !important;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            white-space: pre-wrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            height: 80px;
        }
        .ellipsis-4{
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            white-space: pre-wrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            height: auto;
        }
        ::placeholder{
            font-size: 14px;
        }
        .img-card{
            width: 65px;
        }

        .quote {
            font-family: 'Arial';
            font-weight: bold;
            font-size: 50px;
            color: #D42627;
            margin-bottom: -15px;
        }

        .bg-upgrade{
            background-image: url('{{asset('images/eksad/home/upgrade.png')}}'), radial-gradient(100% 100% at 100% 0%, #17ABD9 0%, #3759A8 100%);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            border-radius: 30px;
            /*width: 830px;*/
            height: 400px;
            position: relative;
            margin-top: -1px;
        }
        .bg-red{
            background-color: #d42627;
        }
        .card{
            border: none;
        }
        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }
        /* the slides */
        .slick-slide {
            margin: 0 20px;
        }
        /* the parent */
        .slick-list {
            margin: 0 -20px;
        }
        .border-dna{
            border: 1px solid #0d99ff;
            border-radius: 10px;
        }
        .slick-slide{
            height: auto;
        }
        .martop{
            margin-top: 9vh;
        }

        .card{
            border-color: black;
        }

        .odd h4, .body-mode-dark h4{
            color: #000;
        }


        @media(min-width: 576px){
            .img-banner{
                width:75%;
            }
        }
        @media(min-width: 1900px){
            .quote{
                font-family: 'Arial';
                font-weight: bold;
                font-size: 100px;
                color: #D42627;
                margin-bottom: 0;
            }

            .img-card{
                width: 65px;
            }
            .txt-header-card{
                font-size: 24px;
            }
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(".testimonial-slider").slick({
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
        $(".solution-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
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
        $(".clients-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 5,
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
