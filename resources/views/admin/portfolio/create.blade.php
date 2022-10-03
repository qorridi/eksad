@extends('layouts.admin')

@section('title')
    <title>BACKEND - Add New Portfolio</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Add Portofolio
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.portfolio.index') }}">Portfolio List</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Add Portofolio
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
                                {{ Form::open(['route'=>['admin.portfolio.store'],'method' => 'post','id' => 'form_create_portfolio','class' => 'form-material space-y-3', 'enctype' => 'multipart/form-data', 'novalidate']) }}
{{--                                <form class="space-y-3" id="form_create_blog_category" method="POST" action="{{ route('admin.portfolio.store') }}">--}}
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button id="btn_loading" type="button" class="btn btn-outline-success" style="display: none;">
                                                <i class="spinner-border spinner-border-sm text-green" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </i>
                                            </button>
                                            <input type="submit" id="btn_submit" class="btn btn-outline-success" value="Submit"/>&nbsp;&nbsp;
                                            <a id="btn_cancel" href="{{ route('admin.portfolio.index') }}" class="btn btn-outline-danger">Cancel</a>
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
                                        <div class="col-12">
                                            <span style="color: red;">Fields with asterisk (*) must be filled!</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="name">Client Name *</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Client Name" value="{{ old('client_name') }}" required/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="project_year">Project Year</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="project_year" name="project_year" type="text" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="services">Included Services</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select id="services" name="services[]" class="form-control" multiple></select>
                                        </div>
                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <label class="col-form-label" for="products">Included Products</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <select id="products" name="products[]" class="form-control" multiple></select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="description">Title</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="description" name="description" class="form-control" placeholder="Title" value="{{ old('description') }}" required/>
{{--                                            <textarea id="description" name="description" class="form-control" rows="4"> {{ old('description') }}</textarea>--}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="status">Status</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select id="status" name="status" class="form-control">
                                                <option value="1" selected>Published</option>
                                                <option value="2">Unpublished</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="logo_image">Upload Client Logo *</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label class="text-red font-weight-bold">Maximum size 2 MB</label>
                                        <input type="file" class="form-control" id="logo_image" name="logo_image"
                                               accept="image/png, image/jpg, image/jpeg, image/webp" />
                                    </div>
                                </div>
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="primary_image">Upload Primary Picture *</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <label class="text-red font-weight-bold">Maximum size 2 MB</label>
                                            <input type="file" class="form-control" id="primary_image" name="primary_image"
                                                   accept="image/png, image/jpg, image/jpeg, image/webp" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="other_images">Upload Other Pictures</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <label class="text-red font-weight-bold">Maximum size 2 MB</label>
                                            <input type="file" class="form-control" id="other_images" name="other_images[]"
                                                   accept="image/png, image/jpg, image/jpeg, image/webp" multiple/>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="description">Description</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="description" name="description_2" class="form-control" rows="4" maxlength="150"> {{ old('description_2') }}</textarea>
                                    </div>
                                </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="description_3" class="col-form-label">Problem Description</label>
                                            <div class="card">
                                                <div class="card-body b-b">
                                                    <!-- Input -->
                                                    <div class="body">
                                                        <div class="form-group">

                                                            <textarea class="form-control" id="description_3" name="description_3"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- #END# Input -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="description_4" class="col-form-label">Solution Description</label>
                                            <div class="card">
                                                <div class="card-body b-b">
                                                    <!-- Input -->
                                                    <div class="body">
                                                        <div class="form-group">

                                                            <textarea class="form-control" id="description_4" name="description_4"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- #END# Input -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="description_5" class="col-form-label">Result Description</label>
                                            <div class="card">
                                                <div class="card-body b-b">
                                                    <!-- Input -->
                                                    <div class="body">
                                                        <div class="form-group">

                                                            <textarea class="form-control" id="description_5" name="description_5"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- #END# Input -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
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
{{--    <link rel="stylesheet" href="{{ asset('custom/summernote/summernote-bs4.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <style>
        .bootstrap-tagsinput {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            display: block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;
            max-width: 100%;
            line-height: 22px;
            cursor: text;
        }
        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 0 6px;
            margin: 0;
            width: auto;
            max-width: inherit;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            color: #000;
        }
    </style>

@endsection

@section('scripts')
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('custom/summernote/summernote-bs4.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('custom/bootstrap-fileinput/js/fileinput.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript" href="{{ asset('custom/dist/bootstrap-tagsinput.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        $('#form_create_portfolio').submit(function(){
            $('#btn_submit').hide();
            $('#btn_cancel').hide();
            $('#btn_loading').show(200);
        })

        $('#solutions').select2({
            placeholder: {
                id: '-1',
                text: ' - Choose Solution - '
            },
            width: '100%',
            minimumInputLength: 0,
            ajax: {
                url: '{{ route('admin.solution.select') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

        {{--$('#products').select2({--}}
        {{--    placeholder: {--}}
        {{--        id: '-1',--}}
        {{--        text: ' - Choose Product - '--}}
        {{--    },--}}
        {{--    width: '100%',--}}
        {{--    minimumInputLength: 0,--}}
        {{--    ajax: {--}}
        {{--        url: '{{ route('admin.product.select') }}',--}}
        {{--        dataType: 'json',--}}
        {{--        data: function (params) {--}}
        {{--            return {--}}
        {{--                q: $.trim(params.term)--}}
        {{--            };--}}
        {{--        },--}}
        {{--        processResults: function (data) {--}}
        {{--            return {--}}
        {{--                results: data--}}
        {{--            };--}}
        {{--        }--}}
        {{--    }--}}
        {{--});--}}


        $(document).ready(function() {
            $('#description_3').summernote({
                'height'    : 400,
                'fontSizes' : ['7', '8', '9', '10', '11', '12', '14', '18', '19', '20', '21', '22', '23', '24', '25', '26'],
                'lineHeight' : 25,
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
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5'],
                tableClassName: 'table table-bordered table-striped',
                codemirror: {
                    lineNumbers: true,
                    theme: 'monokai'
                }
            });

            $('#description_4').summernote({
                'height'    : 400,
                'fontSizes' : ['7', '8', '9', '10', '11', '12', '14', '18', '19', '20', '21', '22', '23', '24', '25', '26'],
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
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5'],
                tableClassName: 'table table-bordered table-striped',
                codemirror: {
                    lineNumbers: true,
                    theme: 'monokai'
                }
            });

            $('#description_5').summernote({
                'height'    : 400,
                'fontSizes' : ['7', '8', '9', '10', '11', '12', '14', '18', '19', '20', '21', '22', '23', '24', '25', '26'],
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
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5'],
                tableClassName: 'table table-bordered table-striped',
                codemirror: {
                    lineNumbers: true,
                    theme: 'monokai'
                }
            });

            $("#logo_image").fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                overwriteInitial: false,
                maxFileSize: 2048,
                showUpload: false,
            });

            $("#primary_image").fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                overwriteInitial: false,
                maxFileSize: 2048,
                showUpload: false,
            });

            $("#other_images")
                .fileinput({
                    allowedFileExtensions: ["jpg", "jpeg", "png"],
                    showUpload: false,
                    maxFileSize: 2048,
                });
        });

        function submitNews(){
            $('#general-form').submit();
        }

        jQuery('#project_year').datepicker({
            minViewMode: 2,
            format: "yyyy"
        });
    </script>
@endsection
