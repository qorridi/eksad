@extends('layouts.admin')

@section('title')
    <title>BACKEND - Edit Blog</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Edit Blog "{{ $blog->title }}"
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.blog.index') }}">Blog List</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit Blog
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
                                {{ Form::open(['route'=>['admin.blog.update', $blog->id],'method' => 'post','id' => 'form_edit_blog','class' => 'form-material space-y-3', 'enctype' => 'multipart/form-data', 'novalidate']) }}
                                {{--                                <form class="space-y-3" id="form_create_blog_category" method="POST" action="{{ route('admin.blog.store') }}">--}}
                                @csrf
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button id="btn_loading" type="button" class="btn btn-outline-success" style="display: none;">
                                            <i class="spinner-border spinner-border-sm text-green" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </i>
                                        </button>
                                        <input type="submit" id="btn_submit" class="btn btn-outline-success" value="Simpan"/>&nbsp;&nbsp;
                                        <a id="btn_cancel" href="{{ route('admin.blog.index') }}" class="btn btn-outline-danger">Batal</a>
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
                                    <label class="col-sm-3 col-form-label" for="status">Status *</label>
                                    <div class="col-sm-4">
                                        <select id="status_id" name="status_id" class="custom-select form-control">
                                            <option value="-1">- Pilih Status -</option>
                                            <option value="9" @if($blog->status_id == 9) selected @endif >UNPUBLISH</option>
                                            <option value="10" @if($blog->status_id == 10) selected @endif >PUBLISH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="name">Blog Title *</label>
                                    <div class="col-sm-4">
                                        <input id="title" type="text" class="form-control"
                                               name="title" value="{{ $blog->title }}" placeholder="Blog Title" required> </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="category">Category *</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <select id="category" name="category" class="custom-select form-control">
                                            <option value="-1">- Pilih Kategori -</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($category->id == $blog->blog_category->id) selected @endif >{{ $category->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="gambar">Upload Gambar Utama</label>
                                        @if($blog->status_id === 2)
                                            <img src="{{ asset('images/eksad/empty.png') }}" style="height:300px" alt="article-image">
                                        @else
                                            <img src="{{ asset($blog->img_path) }}" style="height:300px" alt="article-image">
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="text-red font-weight-bold">Maksimal size gambar 2 MB</label>
                                        <input type="file" class="form-control" id="featured-image" name="featured-image"
                                               accept="image/png, image/jpg, image/jpeg, image/webp" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="subtitle">Short Description</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" id="subtitle" name="subtitle" class="form-control" placeholder="Short Description" value="{{ $blog->subtitle }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="total_manday">Publish At </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="start_date" name="start_date" type="text" class="form-control" autocomplete="off" value="{{ $blog->published_at->format('d M Y') }}" required>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="content" class="col-form-label">Konten Berita</label>
                                        <div class="card">
                                            <div class="card-body b-b">
                                                <!-- Input -->
                                                <div class="body">
                                                    <div class="form-group">

                                                        <textarea class="form-control" id="content" name="content">{!! $blog->description_1 !!}</textarea>
                                                    </div>
                                                </div>
                                                <!-- #END# Input -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                                {{--                                </form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('content')--}}
{{--    <!-- Hero -->--}}
{{--    <div class="bg-body-light">--}}
{{--        <div class="content content-full">--}}
{{--            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">--}}
{{--                <div class="flex-grow-1">--}}
{{--                    <h1 class="h3 fw-bold mb-2">--}}
{{--                        Edit Blog "{{ $blog->title }}"--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">--}}
{{--                    <ol class="breadcrumb breadcrumb-alt">--}}
{{--                        <li class="breadcrumb-item">--}}
{{--                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>--}}
{{--                        </li>--}}
{{--                        <li class="breadcrumb-item">--}}
{{--                            <a class="link-fx" href="{{ route('admin.blog.index') }}">Blog List</a>--}}
{{--                        </li>--}}
{{--                        <li class="breadcrumb-item" aria-current="page">--}}
{{--                            Edit Blog--}}
{{--                        </li>--}}
{{--                    </ol>--}}
{{--                </nav>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- END Hero -->--}}

{{--    <div class="content">--}}
{{--        <div class="row items-push">--}}
{{--            <div class="col-md-12 col-xl-12">--}}
{{--                <div class="block block-rounded h-100 mb-0">--}}
{{--                    <div class="block-content block-content-full">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-12">--}}
{{--                                {{ Form::open(['route'=>['admin.blog.update', $blog->id],'method' => 'post','id' => 'form_edit_blog','class' => 'form-material space-y-3', 'enctype' => 'multipart/form-data', 'novalidate']) }}--}}

{{--                                <form class="space-y-3" id="form_edit_blog" method="POST" action="{{ route('admin.blog.update', $blog->id) }}">--}}
{{--                                    @csrf--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-12 text-end">--}}
{{--                                            <button id="btn_loading" type="button" class="btn btn-outline-success" style="display: none;">--}}
{{--                                                <i class="spinner-border spinner-border-sm text-green" role="status">--}}
{{--                                                    <span class="visually-hidden">Loading...</span>--}}
{{--                                                </i>--}}
{{--                                            </button>--}}
{{--                                            <input type="submit" id="btn_submit" class="btn btn-outline-success" value="Simpan"/>&nbsp;&nbsp;--}}
{{--                                            <a id="btn_cancel" href="{{ route('admin.blog.index') }}" class="btn btn-outline-danger">Batal</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            @include('partials._success')--}}
{{--                                            @include('partials._error')--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @if(count($errors))--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-8">--}}
{{--                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                                                    <ul>--}}
{{--                                                        @foreach($errors->all() as $error)--}}
{{--                                                            <li>{{ $error }}</li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    <div class="row">--}}
{{--                                        <label class="col-sm-3 col-form-label" for="name">Blog Title*</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input id="name" type="text" class="form-control"--}}
{{--                                                   name="name" value="{{ $blog->title }}" placeholder="Blog Title" required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                <div class="row">--}}
{{--                                    <label class="col-sm-3 col-form-label" for="status">Status *</label>--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <select id="status_id" name="status_id" class="custom-select form-control">--}}
{{--                                            <option value="-1">- Pilih Status -</option>--}}
{{--                                            <option value="9" @if($blog->status_id == 9) selected @endif >PUBLISH</option>--}}
{{--                                            <option value="10" @if($blog->status_id == 10) selected @endif >UNPUBLISH</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row ">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <label class="col-form-label" for="category">Category *</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <select id="category" name="category" class="custom-select form-control">--}}
{{--                                            <option value="-1">- Pilih Kategori -</option>--}}
{{--                                            @foreach($categories as $category)--}}
{{--                                                <option value="{{ $category->id }}" @if($category->id == $blog->blog_category->id) selected @endif >{{ $category->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row form-group">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <label class="col-form-label" for="gambar">Upload Gambar Utama</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <label class="text-red font-weight-bold">Maksimal size gambar 2 MB</label>--}}
{{--                                        <input type="file" class="form-control" id="featured-image" name="featured-image"/>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <label class="col-form-label" for="subtitle">Short Description</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <input type="text" id="subtitle" name="subtitle" class="form-control" placeholder="Short Description" value="{{ $blog->subtitle }}" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <label class="col-form-label" for="total_manday">Publish At </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <input id="start_date" name="start_date" type="text" class="form-control" autocomplete="off" value="{{ $blog->published_at->format('d M Y') }}" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <label for="content" class="form-control">Konten Berita</label>--}}
{{--                                        <div class="card">--}}
{{--                                            <div class="card-body b-b">--}}
{{--                                                <!-- Input -->--}}
{{--                                                <div class="body">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <textarea class="form-control" id="content" name="content">{!! $blog->description_1 !!}</textarea>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!-- #END# Input -->--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                </form>--}}
{{--                                {{ Form::close() }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@section('styles')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
{{--    <link href="{{ asset('custom/summernote/summernote-bs4.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('scripts')
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
{{--    <script src="{{ asset('custom/summernote/summernote-bs4.min.js') }}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script type="text/javascript" src="{{ asset('custom/bootstrap-fileinput/js/fileinput.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('#form_edit_blog').submit(function(){
            $('#btn_submit').hide();
            $('#btn_cancel').hide();
            $('#btn_loading').show(200);
        })

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
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                'height'    : 400,
                // 'lineHeight' : 25,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear', 'style']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['height', ['height']],
                    ['misc', ['undo', 'redo', 'print', 'help', 'fullscreen']]
                ],
                popover: {
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']]
                    ]
                },
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5'],
                tableClassName: 'table table-bordered table-striped',
                codemirror: {
                    lineNumbers: true,
                    theme: 'monokai'
                }
            });

            $("#featured-image").fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                overwriteInitial: false,
                maxFileSize: 2048,
                showUpload: false,
            });
            $("#detail_image")
                .fileinput({
                    allowedFileExtensions: ["jpg", "jpeg", "png"],
                    showUpload: false,
                });
            // $("#featured-image2").fileinput({
            //     allowedFileExtensions: ["jpg", "jpeg", "png"],
            //     overwriteInitial: false,
            //     maxFileSize: 4096,
            //     showUpload: false,
            // });
        });

        function submitNews(){
            $('#general-form').submit();
        }
    </script>
    <script type="text/javascript">
        jQuery('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "dd M yyyy"
        });
    </script>
@endsection
