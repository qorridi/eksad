@extends('layouts.admin')

@section('title')
    <title>BACKEND - Ubah Client</title>
@endsection

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Client Slides
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Client Slides
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid my-3">

        {{ Form::open(['route'=>'admin.client.update','method' => 'post','id' => 'general-form','class' => 'form-material', 'enctype' => 'multipart/form-data', 'novalidate']) }}

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

        <div class="row py-3">
            <div class="col-12">
                @include('partials.admin._messages')
                <div class="card">
                    <div id="banner-section" class="card-body b-b">
                        @php $idx = 1 @endphp
                        @if(count($clients) > 0)
                        @foreach($clients as $client)
                                @if($idx != 1)
                                    <hr>
                                @endif
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <img src="{{asset($client->image_path)}}" class="w-75" style="height: 200px">
                                        </div>

                                    </div>
                                </div>
{{--                                <div class="col-md">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <div class="form-line">--}}
{{--                                            <img src="{{asset($client->image_path_mobile)}}" style="width: auto; height: 200px">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Judul (max 20 Huruf)</label>--}}
{{--                                                <input type="text" id="title" class="form-control" maxlength="20" value="{{$facility->name}}" readonly/>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Deskripsi (max 150 huruf)</label>--}}
{{--                                                <input type="text" id="description" class="form-control" maxlength="150" value="{{$facility->description}}" readonly/>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class='col-md-3'>
                                    <div class="col-md-12">
                                        <div class="form-line">
                                            <label>Urutan Slide</label>
                                            <input type="text" id="order"  class="form-control" value="{{$client->sort_order}}" readonly/>
                                        </div>
                                    </div>
                                    <a class='form-control btn btn-warning' href="{{route('admin.client.edit', ['id'=>$client->id])}}">Edit</a>
                                </div>
                            </div>
                                @php $idx++ @endphp
                        @endforeach
                        @else
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="form-control">Slide Image (Desktop)</label>
                                            <label class="text-red font-weight-bold">Max upload size 2 MB</label>
                                            <input type="file" class="form-control" id="banner-image" name="banner-image"
                                                   accept="image/png, image/jpg, image/jpeg, image/webp" />
                                        </div>
{{--                                        <div class="form-line">--}}
{{--                                            <label class="form-control">Slide Image (Mobile)</label>--}}
{{--                                            <label class="text-red font-weight-bold">Max upload size 2 MB</label>--}}
{{--                                            <input type="file" class="form-control banner-image" id="banner-image-mobile" name="banner-image-mobile[]"/>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Judul (max 20 huruf)</label>--}}
{{--                                                <input type="text" id="title" name="title[]" class="form-control" maxlength="20"/>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Deskripsi (max 150 huruf)</label>--}}
{{--                                                <input type="text" id="description" name="description[]" class="form-control" maxlength="150"/>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <label>Urutan Slide</label>
                                                <input type="text" id="order" name="order[]" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div id="banner{{$idx}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 text-left">
                            <a class="form-control btn btn-primary" onclick="addBanner()">Add Image</a>
                        </div>
                        <div id="submit-div" class="col-6 text-right" style="display: none">
                            <a class="btn btn-success" onclick="submitBanner()" style="cursor: pointer;">SIMPAN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ Form::close() }}

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link href="{{ asset('custom/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('scripts')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>--}}
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
        $("#banner-image").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            overwriteInitial: false,
            maxFileSize: 2048,
            showUpload: false,
        });


        var i = '{{$idx}}';
        var defaultCt = '{{$idx}}';
        var newData = 0;
        function addBanner(){
            $('#submit-div').show();
            // alert(i);
            $('#banner'+i).html(
                "<hr>" +
                "<div class='row'>" +
                    "<div class='col-md-5 col-12'>" +
                        "<div class='form-group'>" +
                            "<div class='form-line'>" +
                                "<label class='form-control'>Slide Image</label>" +
                                "<label class='text-red font-weight-bold'>Max upload size 2 MB</label>" +
                                "<input type='file' class='form-control banner-image' id='banner-image' name='banner-image[]' accept='image/png, image/jpg, image/jpeg, image/webp' />" +
                            "</div>" +
                            // "<div class='form-line'>" +
                            //     "<label class='form-control'>Banner Image (Mobile)</label>" +
                            //     "<label class='text-red font-weight-bold'>Max upload size 2 MB</label>" +
                            //     "<input type='file' class='form-control banner-image' id='banner-image-mobile' name='banner-image-mobile[]'/>" +
                            // "</div>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-md-5'>" +
                        "<div class='form-group'>" +
                            // "<div class='col-md-12'>" +
                            //     "<div class='form-line'>" +
                            //         "<label class='form-control'>Judul (max 20 huruf)</label>" +
                            //         "<input type='text' id='title' name='title[]' class='form-control' maxlength='20'/>" +
                            //     "</div>" +
                            // "</div>" +
                            // "<div class='col-md-12'>" +
                            //     "<div class='form-line'>" +
                            //         "<label class='form-control'>Deskripsi (max 150 huruf)</label>" +
                            //         "<input type='text' id='description' name='description[]' class='form-control' maxlength='150'/>" +
                            //     "</div>" +
                            // "</div>" +
                            "<div class='col-md-12'> " +
                                "<div class='form-line'>" +
                                    "<label class='form-control'>Urutan Slide</label>" +
                                    "<input type='text' id='order' name='order[]' class='form-control'/>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-md-2'>"+
                    "<a class='form-control btn btn-danger' onclick='deleteBanner("+ i +")'>Delete</a> "+
                    "</div> "+
                "</div> "
            );

            $('#banner-section').append('<div id="banner'+(parseInt(i) + 1)+'"></div>');
            i++;
            newData++;

            $(".banner-image")
                .fileinput({
                    allowedFileExtensions: ["jpg", "jpeg", "png"],
                    showUpload: false,
                });
        }
        function deleteBanner(rowId){
            $('#banner' + rowId).remove();
            newData--;
            if(parseInt(newData) === 0){
                $('#submit-div').hide();
            }
        }
    </script>
@endsection
