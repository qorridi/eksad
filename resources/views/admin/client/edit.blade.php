@extends('layouts.admin')

@section('title')
    <title>BACKEND - Ubah Slide Client</title>
@endsection

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Edit Client Slide
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.client.index') }}">Client Slide </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit Client Slide
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid my-3">
        <div class="row mb-3">
            <div class="col-12 text-right">
                <a class="btn btn-success" onclick="submitBanner()" style="cursor: pointer;">SIMPAN</a>
                <a class="btn btn-danger rounded-round" style="cursor: pointer;" onclick="modalDelete();">HAPUS</a>
            </div>
        </div>

        {{ Form::open(['route'=>'admin.client.updateSingle','method' => 'post','id' => 'general-form','class' => 'form-material', 'enctype' => 'multipart/form-data', 'novalidate']) }}

        @include('partials.admin._messages')
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
                <div class="card">
                    <div id="banner-section" class="card-body b-b">
                        <div class="row">
                            <input type="hidden" value="{{$banner->id}}" name="id">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label class="form-control">Banner Image (Desktop)</label>
                                        <label class="text-red font-weight-bold">Max upload size 2 MB</label>
                                        <input type="file" class="form-control banner-image" id="banner-image" name="banner-image"
                                               accept="image/png, image/jpg, image/jpeg, image/webp" />
                                    </div>
{{--                                    <div class="form-line">--}}
{{--                                        <label class="form-control">Banner Image (Mobile)</label>--}}
{{--                                        <label class="text-red font-weight-bold">Max upload size 2 MB</label>--}}
{{--                                        <input type="file" class="form-control banner-image" id="banner-image-mobile" name="banner-image-mobile"/>--}}
{{--                                    </div>--}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="form-line">
                                            <img src="{{asset($banner->image_path)}}" style="width: auto; height: 200px" class="pb-3">
{{--                                            <img src="{{asset($banner->image_path_mobile)}}" style="width: auto; height: 200px" class="pb-3">--}}
{{--                                            <label class="form-control">Title (max 20 characters)</label>--}}
{{--                                            <input type="text" id="title" name="title" class="form-control" maxlength="20" value="{{$banner->name}}"/>--}}
                                        </div>
                                    </div>
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-line">--}}
{{--                                            <label class="form-control">Description (max 150 characters)</label>--}}
{{--                                            <input type="text" id="description" name="description" class="form-control" maxlength="150" value="{{$banner->description}}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-12 pt-3">
                                        <div class="form-line">
                                            <label class="form-control">Order</label>
                                            <input type="text" id="order" name="order" class="form-control" value="{{$banner->sort_order}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ Form::close() }}

    </div>
    <!-- Delete Blog Modal -->
    <div class="modal" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
            {{ Form::open(['route'=>['admin.client.destroy'],'method' => 'post','id' => 'general-form', 'novalidate']) }}
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus image ini?
                    <input type="hidden" name="deleted-id" value="{{ $banner->id }}"/>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                    <input type="submit" class="btn btn-success" value="Ya" />
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
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
        $("#banner-image").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            overwriteInitial: false,
            maxFileSize: 2048,
            showUpload: false,
        });
        function modalDelete(){
            $('#modal-delete').modal('show');
        }
    </script>
@endsection
