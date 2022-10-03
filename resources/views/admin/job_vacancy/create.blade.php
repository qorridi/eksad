    @extends('layouts.admin')

    @section('title')
        <title>BACKEND - Add New Job Vacancy</title>
    @endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Add New Job Vacancy
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.job_vacancy.index') }}">Job Vacancy List</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Add New Job Vacancy
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
                                {{ Form::open(['route'=>['admin.job_vacancy.store'],'method' => 'post','id' => 'form_create','class' => 'form-material space-y-3', 'enctype' => 'multipart/form-data', 'novalidate']) }}
{{--                                <form class="space-y-3" id="form_create_blog_category" method="POST" action="{{ route('admin.solution.store') }}">--}}
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button id="btn_loading" type="button" class="btn btn-outline-success" style="display: none;">
                                                <i class="spinner-border spinner-border-sm text-green" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </i>
                                            </button>
                                            <input type="submit" id="btn_submit" class="btn btn-outline-success" value="Submit"/>&nbsp;&nbsp;
                                            <a id="btn_cancel" href="{{ route('admin.job_vacancy.index') }}" class="btn btn-outline-danger">Cancel</a>
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
                                        <label class="col-sm-3 col-form-label" for="name">Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Nama" value="{{old('name')}}" required/>
                                        </div>
                                    </div>
                                <div class="row ">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="category">Category *</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <select id="category" name="category" class="custom-select form-control">
                                            <option value="-1">- Pilih Category -</option>
                                            @foreach($categories as $category)
                                                @if(!empty(old('category')))
                                                    <option value="{{ $category->id }}" @if($category->id == old('category')) selected @endif >{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="name">Departmen/Division *</label>
                                    <div class="col-sm-4">
                                        <select id="department" name="department" class="custom-select form-control">
                                            <option value="-1">- Pilih Department -</option>
                                            @foreach($departments as $department)
                                                @if(!empty(old('department')))
                                                    <option value="{{ $department->id }}" @if($department->id == old('department')) selected @endif >{{ $department->description }}</option>
                                                @else
                                                    <option value="{{ $department->id }}">{{ $department->description }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="name">Level *</label>
                                    <div class="col-sm-4">
                                        <select id="level" name="level" class="custom-select form-control">
                                            <option value="-1">- Pilih level -</option>
                                            @foreach($levels as $level)
                                                @if(!empty(old('level')))
                                                    <option value="{{ $level->id }}" @if($level->id == old('level')) selected @endif >{{ $level->description }}</option>
                                                @else
                                                    <option value="{{ $level->id }}">{{ $level->description }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                     </div>
                                </div>
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <label class="col-form-label" for="total_manday">Tahun Project </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-9">--}}
{{--                                            <input id="start_date" name="start_date" type="text" class="form-control" autocomplete="off"  required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="description">Description</label>
                                        </div>
                                        <div class="card">
                                            <div class="card-body b-b">
                                                <!-- Input -->
                                                <div class="body">
                                                    <div class="form-group">

                                                        <textarea class="form-control" id="description" name="description"></textarea>
                                                    </div>
                                                </div>
                                                <!-- #END# Input -->
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

@section('styles')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
{{--    <link href="{{ asset('custom/summernote/summernote-bs4.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
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

        $('#form_create').submit(function(){
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
            $('#description').summernote({
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
            $('#content2').summernote({
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
            $('#content3').summernote({
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
                maxFileSize: 10240,
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
            minViewMode: 2,
            format: "yyyy"
        });
    </script>
@endsection
