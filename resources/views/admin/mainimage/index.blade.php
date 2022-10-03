@extends('layouts.admin')

@section('title')
    <title>BACKEND - Ubah Main Image</title>
@endsection

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Main Image
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Main Image
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid my-3">

        {{ Form::open(['route'=>'admin.mainimage.update','method' => 'post','id' => 'general-form','class' => 'form-material', 'enctype' => 'multipart/form-data', 'novalidate']) }}

        @if(count($errors))
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body b-b">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-12">
                                        <div role="alert" class="alert alert-danger">
                                            <h4>Terdapat Kesalahan Input</h4>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-12">
                @include('partials.admin._messages')
                <div class="card">
                    <div id="banner-section" class="card-body b-b">
                        @php $idx = 1 @endphp
                        @if(count($mainimages) > 0)
                        @foreach($mainimages as $mainimage)
                                @if($idx != 1)
                                    <hr>
                                @endif
                            <div class="row">
                                <div class="col-md-6 col-12 text-center">
                                    <div class="form-group">
                                        <div class="">
                                            <img src="{{asset($mainimage->image_path)}}" style="width: auto; height: 425px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-2">
                                    <a class='form-control btn btn-warning' href="{{route('admin.mainimage.edit', ['id'=>$mainimage->id])}}">Edit</a>
                                </div>
                            </div>
                                @php $idx++ @endphp
                        @endforeach
                        @else
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="form-control">Main Image</label>
                                            <label class="text-red font-weight-bold">Recommendation dimension 1:1, max upload size 2 MB</label>
                                            <input type="file" class="form-control banner-image" id="banner-image" name="banner-image[]"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7"></div>
                            </div>
                        @endif

                        <div id="banner{{$idx}}">
                        </div>
                    </div>
                    @if($idx != 1)
                        <hr>
                    @else
                    <div class="row p-3">
                        <div class="col-md-2">
                            <div class="form-group form-float form-group-lg">
                                <div class="form-line">
                                    <label for="customer">&nbsp;</label>
                                    <a class="form-control btn btn-success" onclick="submitBanner()">Simpan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

{{--                    <div id="submit-div" class="col-6 text-right" style="display: none">--}}
{{--                        <a class="btn btn-success" onclick="submitBanner()" style="cursor: pointer;">SIMPAN</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>

        {{ Form::close() }}

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
    <link href="{{ asset('custom/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('custom/summernote/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/bootstrap-fileinput/js/fileinput.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        function submitBanner(){
            $('#general-form').submit();
        }
    </script>
    <script type="text/javascript">
        jQuery('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "dd M yyyy"
        });
        $(".banner-image")
            .fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png","webp"],
                showUpload: false,
            });



        function deleteBanner(rowId){
            // alert(rowId);
            $('#banner' + rowId).remove();
        }
    </script>
@endsection
