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
                    <p class="txt-body1 font-rubik-bold text-white">Portfolio</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <div class="input-group">
                        <input type="text" id="search_keyword" class="form-control custom-search-bar" placeholder="Search Project" aria-label="Search Project" aria-describedby="search-title" value="{{ $filterKeyword ?? '' }}">
                        <span class="input-group-text custom-search-icon" id="search-articles"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="col-md-1 col-2 m-auto text-center">
                    <button type="button" class="btn  btn-lg" data-toggle="modal" data-target="#exampleModal">
                        @if($active_filter_id != 0)
                            <img class="" src="{{asset('images/eksad/icon-filter-active.png')}}" style="width: 5vw;" alt="">
                        @else
                            <img class="" src="{{asset('images/eksad/icon-filter.png')}}" style="width: 5vw;" alt="">
                        @endif
                    </button>
                </div>
            </div>
            @if(!empty($filterKeyword))
                <div class="row">
                    <div class="col">
                        <a href="{{ route('frontend.portfolio') }}" class="btn btn-primary bg-blue-white">Clear Filter</a>
                    </div>
                </div>
            @endif

            <div class="row pb-5">
                <div class="col-11">
                    @foreach($solutionCategories as $categories)
                        @foreach($categories->solutions as $solution)
                            @if($active_filter_id != 0 && $solution->id == $active_filter_id)
                                <p class="txt-body3 text-dark">Selected Filter: <button class=" ms-3 btn btn-filter-2">{{$solution->name}}<a href="{{ route('frontend.portfolio') }}" class=" ps-3 red-eksad ">X</a></button></p>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="row">
                @foreach( $portfolios as $portfolio)
                    <div class="col-md-4 pb-5">
                        <div class="card">
                            <div class="card-top">
                                <div style="height: 25vh">
                                    <img src="{{ asset('/storage/portfolio_images/'. $portfolio->img_primary) }}" class="w-100 p-3" alt="" style="max-height: 25vh;">
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route("frontend.portfolio_detail", ['id' => $portfolio->id])}}">
                                    <p class="txt-body4 pt-3 m-0 text-dark">{{$portfolio->year}}</p>
                                    <p class="card-title txt-body2 fw-bolder m-0 text-dark ellipsis">{{$portfolio->description}}</p>
                                    <div class="py-3">
                                        <img src="{{asset('storage/portfolio_images/'.$portfolio->img_logo)}}" class="img-solution-porto" alt="">
                                    </div>
                                </a>
                                <a href="{{route("frontend.portfolio_detail", ['id' => $portfolio->id])}}" class="txt-body3 red-eksad text-decoration-underline fw-bold pb-3"><p>See Detail</p></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title txt-body5" id="exampleModalLabel">Filter</p>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body txt-body4">
                    <div class="container">
                        @foreach($solutionCategories as $categories)
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p class="fw-bold">{{ $categories->name }}</p>
                                    @foreach($categories->solutions as $solution)
                                        @if($active_filter_id != 0 && $solution->id == $active_filter_id)
                                            <button class="border-filter-active filter_option" onclick="changeFilter({{ $solution->id }})" id="solution_{{ $solution->id }}">{{ $solution->name }}</button>
                                        @else
                                            <button class="border-filter filter_option" onclick="changeFilter({{ $solution->id }})" id="solution_{{ $solution->id }}">{{ $solution->name }}</button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-6">
                                <button class="w-100 btn-clear py-2" id="clear_filter_btn">Clear Filter</button>
                            </div>
                            <div class="col-6">
                                <button class="w-100 btn-filter py-2" id="filter_btn">Activate Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        .ellipsis{
            display: -webkit-box !important;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
        }
        .modal-body{
            padding: 1rem;
        }
        .border-filter-active{
            background-color: transparent;
            color: #d42627;
            border: 2px solid #d42627;
            border-radius: 20px;
            padding: 5px 10px;
            margin: 10px;
        }
        .border-filter{
            background-color: transparent;
            border: 1px solid grey;
            border-radius: 20px;
            padding: 10px;
            margin: 5px;
        }
        .btn-filter{
            border: 1px solid #d42627;
            background-color: #d42627;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            margin:auto;
        }
        .btn-filter-2{
            border: 1px solid #d42627;
            background-color: transparent;
            color: #d42627 !important;
            font-weight: bold;
            border-radius: 10px;
            margin:auto;
        }
        .btn-clear{
            border: 1px solid gray;
            background-color: gray;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            margin:auto;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #000;
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
            border-color: #CCCCCC;
        }


        .odd h4, .body-mode-dark h4{
            color: #000;
        }

        p{
            margin-bottom: 1em;
        }

        @media(min-width: 576px){

        }
        @media(min-width: 1900px){

        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        var selectedFilter = 0;
        var arrSelectedFilter = [];

        function changeFilter(value){
            selectedFilter = value;
            $('.filter_option').removeClass('border-filter-active');
            $('.filter_option').addClass('border-filter');
            if($('#solution_' + value).hasClass('border-filter-active')){
                $('#solution_' + value).removeClass('border-filter-active');
                $('#solution_' + value).addClass('border-filter');
            }
            else{
                $('#solution_' + value).removeClass('border-filter');
                $('#solution_' + value).addClass('border-filter-active');
            }
        }

        $('#search_keyword').on('keypress', function (e) {
            if(e.which === 13){
                let keyword = $(this).val();
                if(!keyword || keyword === ''){
                    return false;
                }

                $(this).prop('disabled', true);
                if(keyword.includes('%')){
                    alert("dont search with '%'!");
                }else{
                    window.location.href = '{{ route('frontend.portfolio') }}?keyword=' + keyword;
                }
                $(this).prop('disabled', false);
            }
        });

        $('#filter_btn').on('click', function (e) {
            if(selectedFilter !== 0){
                window.location.href = '{{ route('frontend.portfolio') }}?filter=' + selectedFilter;
            }
        });

        $('#clear_filter_btn').on('click', function (e) {
            window.location.href = '{{ route('frontend.portfolio') }}';
        });

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
