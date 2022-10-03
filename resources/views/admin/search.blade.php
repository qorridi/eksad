@extends('layouts.admin')

@section('content')

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Search
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Page Result found.
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Search
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Search -->
    <div class="content">
        <form id="search-page-form" action="{{route('admin.search')}}" method="POST">
            {{csrf_field()}}
            <div class="input-group">
                <input id="search" name="search" type="text" class="form-control" placeholder="Search Portfolio, Blog, Solution">
                <input id="skip" name="skip" type="hidden">
                <span class="input-group-text">
                <i class="fa fa-fw fa-search"></i>
              </span>
            </div>
        </form>
    </div>
    <!-- END Search -->

    <!-- Page Content -->
    <div class="content">
        <!-- Results -->
            <div class="block block-rounded h-100 mb-0">
                <!-- Classic -->
                <div class="block-content block-content-full">
                    <div class="fs-4 fw-semibold p-2 mb-4 border-start border-4 border-primary bg-body-light">
                        <span class="text-primary fw-bold">{{$searchCount}}</span> found for <mark class="text-danger">{{$searchString}}</mark>
                    </div>
                    <div class="row py-3">
                        @foreach($resultdata as $data)
                            <div class="col-lg-6">
                                <h4 class="h5 mb-1">
                                    <a href="{{$data->route}}">{{$data->name}}</a>
                                </h4>
                                <div class="fs-sm fw-medium text-success mb-1">{{$data->route}}</div>
                                <p class="fs-sm text-muted">{{$data->description}}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            @if($searchCount > 0)
                                <div class="col-dataTables_info" aria-live="polite">Page {{ $activePage }} of {{ $totalPage }}</div>
                            @else
                                <div class="col-dataTables_info" aria-live="polite">Page 0 of 0</div>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" style="float: right;">
                                <ul class="pagination">
                                    @if($skip == 0)
                                    <li class="paginate_button page-item previous disabled" v-if="skip === 0">
                                        <i class="fa fa-angle-left page-link"></i>
                                    </li>
                                    @else
                                        <li class="paginate_button page-item previous" onclick="previousPage()">
                                            <i class="fa fa-angle-left page-link"></i>
                                        </li>
                                    @endif

                                        @if($activePage == $totalPage)
                                            <li class="paginate_button page-item next disabled">
                                                <i class="fa fa-angle-right page-link"></i>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item next" onclick="nextPage()">
                                                <i class="fa fa-angle-right page-link"></i>
                                            </li>
                                        @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END Classic -->
        </div>
    </div>
</div>


@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script>
        function previousPage(){
            var searchString = '{{$searchString}}';
            var take = parseInt({{$take}});
            var skip = parseInt({{$skip}});
            skip -= take;

            $('#search').val(searchString);
            $('#skip').val(skip);

            $( "#search-page-form" ).submit();
        }
        function nextPage(){
            var searchString = '{{$searchString}}';
            var take = parseInt({{$take}});
            var skip = parseInt({{$skip}});
            skip += take;

            $('#search').val(searchString);
            $('#skip').val(skip);

            $( "#search-page-form" ).submit();
        }
    </script>
@endsection
