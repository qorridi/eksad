@extends('layouts.admin')

@section('title')
    <title>BACKEND - Add New Solution Category</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Add Solution Category
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.solutioncategory.index') }}">Solution Category List</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Add Solution Category
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
                            <div class="col-12">
                                <form class="space-y-3" id="form_create_solution_category" method="POST" action="{{ route('admin.solutioncategory.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button id="btn_loading" type="button" class="btn btn-outline-success" style="display: none;">
                                                <i class="spinner-border spinner-border-sm text-green" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </i>
                                            </button>
                                            <input type="submit" id="btn_submit" class="btn btn-outline-success" value="Simpan"/>&nbsp;&nbsp;
                                            <a id="btn_cancel" href="{{ route('admin.solutioncategory.index') }}" class="btn btn-outline-danger">Batal</a>
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
                                        <label class="col-sm-3 col-form-label" for="name">Solution Category Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Solution Category Solution" value="{{old('name')}}" required/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="description">Description</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="description" name="description" class="form-control" placeholder="Desc" value="{{old('description')}}" required/>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="gambar">Upload Main Image</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <label class="text-red font-weight-bold">Maximum image size 2 MB</label>
                                            <input type="file" class="form-control" id="featured-image" name="featured-image"
                                                   accept="image/png, image/jpg, image/jpeg, image/webp" />
                                        </div>
                                    </div>
                                </form>
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
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/bootstrap-fileinput/js/fileinput.js') }}"></script>
    <script>
        $('#form_create_solution_category').submit(function(){
            $('#btn_submit').hide();
            $('#btn_cancel').hide();
            $('#btn_loading').show(200);
        })

        $("#featured-image").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            overwriteInitial: false,
            maxFileSize: 10240,
            showUpload: false,
        });

        // Autonumber toggle
        {{--$('#auto_number').change(function(){--}}
        {{--    if(this.checked){--}}
        {{--        $('#code').val('{{ $autonumber }}');--}}
        {{--        $('#code').prop('readonly', true);--}}
        {{--    }--}}
        {{--    else{--}}
        {{--        $('#code').val('');--}}
        {{--        $('#code').prop('readonly', false);--}}
        {{--    }--}}
        {{--});--}}
    </script>
@endsection
