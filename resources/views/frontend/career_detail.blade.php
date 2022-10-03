@extends('layouts.frontend')


@section('head_and_title')
    <meta name="description" content="{{$job->level}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;{{$job->division}}">
    <meta name="author" content="EKSAD">
    <meta name="keywords" content="EKSAD TECHNOLOGY, Technology, IT Programmer, Job Opportunity, Lowongan Pekerjaan">
    <meta name="title" content="{{$job->name}}">

    <meta property="og:url" content="{{ route('frontend.career_detail', ['slug' => $job->slug]) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$job->name}}" />
    <meta property="og:description" content="{{$job->level}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;{{$job->division}}" />
    <meta property="og:image" content="http://eksad.acmetek.id/public/images/eksad/logo-eksad.png" />
    <meta property="og:site_name" content="http://eksad.acmetek.id" />
    <title>EKSAD Technology</title>
@endsection


@section('content')


    <section  id="" class="bg-blue-eksad bg-about   py-5 martop">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5 text-center text-md-start">
                    <p class="txt-body1 font-rubik-bold text-white">{{$job->name}}</p>
                    <p class="txt-body4 text-white">{{$job->level}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;{{$job->division}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;Jakarta</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5 ">
        <div class="container">
            <div class="row mb-2">
                @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <p class="mb-0">
                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </p>
                    </div>
                @endif

                @if(\Illuminate\Support\Facades\Session::has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <p class="mb-0">
                            {{ \Illuminate\Support\Facades\Session::get('error') }}
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
                <div class="col-sm-9 col-12 text-dark">
                    {!! $job->description !!}
                </div>
                <div class="col-sm-3 col-12 ">
                    <div class="row mb-3">
                        <div class="col text-center">
                            <a href="{{route('frontend.career_form', ['id' => $job->id])}}">
                            <button class=" btn btn-outline-danger-c red-eksad px-4 py-2 br-10 mb-4" type="button" id="button-addon2">Apply</button>
                            </a>
                            <div class="mb-2">
                                <span class="text-black">Share:</span>
                            </div>
{{--                            <div>--}}
{{--                                <a href="https://www.linkedin.com/company/pt-tiga-daya-digital-indonesia-triputra-group-eksad-technology" class="">--}}
{{--                                    <img src="{{asset('images/eksad/linkedin.png')}}" style="width: 25px;" alt="">&nbsp;&nbsp;--}}
{{--                                </a>--}}
{{--                                <a href="https://twitter.com/eksadtechnology" class="px-3">--}}
{{--                                    <img src="{{asset('images/eksad/twitter.jpg')}}" style="width: 25px;" alt="">&nbsp;&nbsp;--}}
{{--                                </a>--}}
{{--                                <a href="https://www.instagram.com/eksad_technology/">--}}
{{--                                    <img src="{{asset('images/eksad/instagram.png')}}" style="width: 25px;" alt="">&nbsp;&nbsp;--}}
{{--                                </a>--}}
{{--                                <a href="https://youtube.com/eksad_technology" class="ps-3">--}}
{{--                                    <img src="{{asset('images/eksad/youtube.png')}}" style="width: 25px;" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
                            <div>
                                <a href="{{$shareButtons['whatsapp']}}"><img src="{{asset('images/eksad/whatsapp-black.svg')}}" style="width: 25px;" alt=""></a>&nbsp;&nbsp;
                                <a href="{{$shareButtons['facebook']}}"><img src="{{asset('images/eksad/facebook-black.svg')}}" style="width: 25px;" alt=""></a>&nbsp;&nbsp;
                                <a href="{{$shareButtons['linkedin']}}"><img src="{{asset('images/eksad/linkedin-black.svg')}}" style="width: 25px;" alt=""></a>&nbsp;&nbsp;
                                <a onclick="copyToClipboard('{{route('frontend.career_detail', ['slug' => $job->slug])}}')"><img src="{{asset('images/eksad/share-black.svg')}}" style="width: 25px;" alt=""></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End of Article Content -->




    <!-- Scroll [to top] -->
    <div id="scroll-to-top" class="scroll-to-top">
        <a href="#header" class="smooth-anchor">
            <i class="icon-arrow-up"></i>
        </a>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/fontawesome-6.1.0/css/all.min.css') }}"/>
    <style>
        li{
            margin: 0;
        }
        .martop{
            margin-top: 9vh;
        }

        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }


    </style>
@endsection

@section('scripts')
    <script src="{{ asset('js/share.js') }}"></script>
    <script>
        function copyToClipboard(url){
            navigator.clipboard.writeText(url);
            alert("Success Copy Link To Clipboard")
        }
    </script>
@endsection
