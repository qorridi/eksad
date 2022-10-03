@extends('layouts.admin')

@section('title')
    <title>BACKEND - Detil Team</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Detil Team "{{ $team->name }}"
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.team.index') }}">Blog List</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Detil Team
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content">
        <div class="row items-push">
            <div class="col-md-12 col-xl-12">
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-12 space-y-3">
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <a id="btn_cancel" href="{{ route('admin.team.index') }}" class="btn btn-outline-danger">Batal</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        @include('partials._success')
                                        @include('partials._error')
                                    </div>
                                </div>
                                @if(count($errors))
                                    <div class="row">
                                        <div class="col-lg-8">
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
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="name">Nama *</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Nama" value="{{$team->name}}" readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="name">Jabatan *</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="position" name="position" class="form-control"
                                               placeholder="position" value="{{$team->position}}" readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="description">Deskripsi Singkat</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <textarea id="description" name="description" class="form-control" rows="4" maxlength="150" disabled> {{ $team->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="description">Link Twitter</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" id="sosmed_1" name="sosmed_1" class="form-control"
                                               placeholder="Link Twitter" value="{{$team->sosmed_1}}" readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="description">Link Linkedin</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" id="sosmed_2" name="sosmed_2" class="form-control"
                                               placeholder="Link Linkedin" value="{{$team->sosmed_2}}" readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="description">Link Instagram</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" id="sosmed_3" name="sosmed_3" class="form-control"
                                               placeholder="Link Instagram" value="{{$team->sosmed_3}}" readonly/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="gambar">Upload Gambar Utama</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ asset($team->img_path) }}" style="height:300px" alt="team-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/bootstrap-fileinput/js/fileinput.js') }}"></script>
    <script>
        $('#form_edit_blog').submit(function(){
            $('#btn_submit').hide();
            $('#btn_cancel').hide();
            $('#btn_loading').show(200);
        })

        $("#featured-image").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            overwriteInitial: false,
            maxFileSize: 2048,
            showUpload: false,
        });
    </script>
@endsection
