@extends('layouts.frontend')

@section('head_and_title')

    <meta name="description" content="{{$blog->subtitle}}">
    <meta name="author" content="EKSAD">
    <meta name="keywords" content="EKSAD TECHNOLOGY, Technology, IT Programmer, IT Services">
    <meta name="title" content="{{$blog->title}}}">

    <meta property="og:url" content="{{ route('frontend.blog.show', ['slug' => $blog->slug]) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$blog->title}}" />
    <meta property="og:description" content="{{$blog->subtitle}}" />
    <meta property="og:image" content="{{asset($blog->img_path)}}" />
    <meta property="og:site_name" content="http://eksad.acmetek.id" />

    <title>EKSAD Technology</title>
@endsection

@section('content')



    <!-- Article Content -->
    <section class="py-5 martop">
        <div class="container">
            <div class="row pb-3">
                <div class="col-12 text-center text-dark">
                    @if(!empty($blog->published_at))
                        <span>{{ \Carbon\Carbon::parse($blog->published_at)->format('d F Y') }}</span>
                    @else
                        <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}</span>
                    @endif
                </div>
            </div>
            <div class="row pb-3">
                <div class="col text-center">
                    <span class="txt-body6 txt-header-color font-rubik-bold ">{{$blog->title}}</span>
                    <div class="row pt-3">
                        <div class="col-md"></div>
                        <div class="col-md-4">
                            <div class="row text-center red-eksad text-decoration-underline">
                                <div class="col-md-12 text-center">
                                    <a href="{{ route('frontend.blogs') }}?category_id={{$blog->blog_category_id}}" class="red-eksad">
                                        <p>{{$blog->blog_category->description}}</p>
                                    </a>
                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <a href="" class="red-eksad">--}}
{{--                                        <p>Technology</p>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="col-md"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <img src="{{asset($blog->img_path)}}" class="w-100" alt="">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 col-12 pt-5">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="mb-2">
                                <span class="text-black">Share:</span>
                            </div>
                            <div>
                                <a href="{{$shareButtons['whatsapp']}}"><img src="{{asset('images/eksad/whatsapp-black.svg')}}" style="width: 25px;" alt=""></a>&nbsp;&nbsp;
                                <a href="{{$shareButtons['facebook']}}"><img src="{{asset('images/eksad/facebook-black.svg')}}" style="width: 25px;" alt=""></a>&nbsp;&nbsp;
                                <a href="{{$shareButtons['linkedin']}}"><img src="{{asset('images/eksad/linkedin-black.svg')}}" style="width: 25px;" alt=""></a>&nbsp;&nbsp;
                                <a onclick="copyToClipboard('{{route('frontend.blog.show', ['slug' => $blog->slug])}}')"><img src="{{asset('images/eksad/share-black.svg')}}" style="width: 25px;" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-row">
                                <img src="{{asset('images/eksad/blog/author-avatar.svg')}}" style="width: 35px;" alt="">&nbsp;&nbsp;
                                <div>
                                    <span class="text-black txt-body4">Admin Eksad</span><br/>
                                    <span class="small">Content Writer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-12 txt-body3 text-dark pt-5">
                    {!! $blog->description_1 !!}
                    <div class="row pt-3" style="border-bottom: 3px solid #d42627;width:30px;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="blog-image" style="background-image: url('{{ asset($blog->img_path) }}')"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Article Content -->

    <!-- Related Articles -->
    <section class="py-5" >
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <p class="txt-body6 txt-header-color font-rubik-bold pb-3">Related Articles</p>
                </div>
            </div>
            <div class="row">
                @foreach($relatedBlogs as $relatedBlog)
                    <div class="col-md-4">
                        <a href="{{ route('frontend.blog.show', ['slug' => $relatedBlog->slug]) }}">
                            <div class="card mt-3">
                                <div style="height:22vh;">
                                    <img class="card-img-top w-100" style="max-height: 22vh" src="{{ asset($relatedBlog->img_path) }}" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <span class="text-black txt-body4">
                                        @if(!empty($relatedBlog->published_at))
                                            {{ \Carbon\Carbon::parse($relatedBlog->published_at)->format('d F Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($relatedBlog->created_at)->format('d F Y') }}
                                        @endif
                                    </span>
                                    <p class="card-title text-dark txt-body2 fw-bolder ellipsis">{{ $relatedBlog->title }}</p>
                                    <p class="card-text text-dark txt-body4 ellipsis h-b">{{ $relatedBlog->subtitle }}</p>
{{--                                    <p class="red-eksad txt-body4 ">{{$relatedBlog->blog_category->description}}</p>--}}
                                    <p class="red-eksad">Read More</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End of Related Articles -->

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
            height: auto;
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
        .martop{
            margin-top: 9vh;
        }

        .font-custom-red{
            color: #F82800;
        }

        .bg-custom-red{
            background-color: #F82800;
        }

        .font-section-title-size{
            font-size: 36px;
        }

        .custom-bg-image{
            background-image: url("{{ asset('images/infinit/blog/detail_banner.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 400px;
        }

        .custom-border-top-title{
            border-top: 4px solid red;
        }

        .custom-btn{
            padding: 0.3rem 1rem;
        }

        .custom-search-bar{
            border-right: none;
        }

        .custom-search-icon{
            background-color: #fff;
            border-top: 1px solid var(--primary-l-color);
            border-bottom: 1px solid var(--primary-l-color);
            border-right: 1px solid var(--primary-l-color);
        }

        .txt-card{
            color:#331d5e;
        }
        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }

        .blog-image{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 500px;
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
