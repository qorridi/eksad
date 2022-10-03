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
                    <p class="txt-body1 font-rubik-bold text-white">What’s new from EKSAD?</p>
                    <p class="txt-body4 text-white">Find latest tech news, service updates and </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row mb-2">
                <div class="col">
                    <div class="input-group">
                        <input type="hidden" id="search-category" value="{{$filterCategoryId}}">
                        <input type="text" id="search-keyword" class="form-control custom-search-bar" placeholder="Search Articles" aria-label="Search Articles" aria-describedby="search-title" value="{{ $filterKeyword }}">
                        <span class="input-group-text custom-search-icon" id="search-articles"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="input-group">
                        @if($filterCategoryName != '')
                            <p>Kategori = {{$filterCategoryName}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @foreach($latestBlogs as $latestBlog)
                        <div class="col-md-6 pb-3">
                            <a href="{{ route('frontend.blog.show', ['slug' => $latestBlog->slug]) }}">
                                <div class="card mt-3">
{{--                                    <img class="card-img-top" src="{{ asset('images/eksad/blog/img-blog-dummy.png') }}" alt="Card image cap">--}}
                                    <div style="max-height: 20vh">
                                        <img class="card-img-top w-100" style="max-height: 20vh;" src="{{ asset($latestBlog->img_path) }}" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <span class="text-black">
                                            @if(!empty($latestBlog->published_at))
                                                {{ \Carbon\Carbon::parse($latestBlog->published_at)->format('d F Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($latestBlog->created_at)->format('d F Y') }}
                                            @endif
                                            <span class="ps-3 red-eksad text-decoration-underline">{{$latestBlog->blog_category->description}}</span>
                                        </span>
                                        <p class="card-title text-dark txt-body2 fw-bolder ellipsis">{{ $latestBlog->title }}</p>
                                        <p class="card-text text-dark ellipsis h-b">{{ $latestBlog->subtitle }}</p>
                                        <p class="red-eksad">Read More</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 m-auto pt-3">
                    @foreach ($relatedBlogs as $relatedBlogs)
                        <a href="{{ route('frontend.blog.show', ['slug' => $relatedBlogs->slug]) }}">
                        <div class="row pb-4">
                            <div class="col-md-4">
{{--                                <img src="{{asset('images/eksad/home/blog-3.png')}}" class="w-100" alt="Card image cap" alt="">--}}
                                <img class="w-100" src="{{ asset($relatedBlogs->img_path) }}" alt="Card image cap">
                            </div>
                            <div class="col-md-8">
                                <span class="text-black">
                                    @if(!empty($relatedBlogs->published_at))
                                        {{ \Carbon\Carbon::parse($relatedBlogs->published_at)->format('d F Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($relatedBlogs->created_at)->format('d F Y') }}
                                    @endif
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

    <!-- Article List -->
    <section class="" >
        <div class="container">
            <div class="row" style="border-top: 1px solid #666666; width: 100%"></div>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-md-4 pb-3">
                        <a href="{{ route('frontend.blog.show', ['slug' => $blog->slug]) }}">
                            <div class="card mt-3">
{{--                                <img class="card-img-top" src="{{ asset('images/eksad/blog/img-blog-dummy.png') }}" alt="Card image cap">--}}
                                <div style="height:21vh;">
                                    <img class="card-img-top w-100" style="max-height: 21vh" src="{{ asset($blog->img_path) }}" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <span class="text-black">
                                        @if(!empty($blog->published_at))
                                            {{ \Carbon\Carbon::parse($blog->published_at)->format('d F Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}
                                        @endif
                                        <span class="ps-3 red-eksad text-decoration-underline">{{$blog->blog_category->description}}</span>
                                    </span>
                                    <p class="card-title text-dark txt-body2 fw-bolder ellipsis">{{ $blog->title }}</p>
                                    <p class="card-text text-dark ellipsis h-b">{{ $blog->subtitle }}</p>
                                    <p class="red-eksad">Read More</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                @if(count($blogs) == 0)
                    <p class="card-title text-dark txt-body2">Blog tidak ditemukan...</p>
                @endif
            </div>
            <div class="row">
                <div class="col text-center">
                    {{ $blogs->links() }}
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



        .custom-search-bar{
            border-right: none;
        }

        .custom-search-icon{
            background-color: #fff;
            border-top: 1px solid var(--primary-l-color);
            border-bottom: 1px solid var(--primary-l-color);
            border-right: 1px solid var(--primary-l-color);
        }



        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }



        .pagination .page-item.active .page-link{
            background-color: #000;
            border-color: #000;
            color: #fff;
        }

    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('plugins/fontawesome-6.1.0/js/all.min.js') }}"></script>
    <script>
        $('#search-keyword').on('keypress', function (e) {
            if(e.which === 13){
                let keyword = $('#search-keyword').val();
                let categoryId = $('#search-category').val();

                $(this).prop('disabled', true);
                if(keyword.includes('%')){
                    alert("dont search with '%'!");
                }else{
                    if(categoryId !== 0){
                        window.location.href = '{{ route('frontend.blogs') }}?keyword=' + keyword + '&category_id=' + categoryId;
                    }
                    else{
                        window.location.href = '{{ route('frontend.blogs') }}?keyword=' + keyword;
                    }
                }
                $(this).prop('disabled', false);
            }
        });
    </script>

@endsection
