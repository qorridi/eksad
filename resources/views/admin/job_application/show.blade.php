@extends('layouts.admin')

@section('title')
    <title>BACKEND - Job Application Detail</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Show Job Application
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.solution.index') }}">Job Application List</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Show Job Application
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
                <!-- User Info -->
                <div class="block block-rounded">
                    <div class="block-content text-center">
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="{{ route('admin.job_application.index') }}" id="btn_edit" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <div class="py-4">
{{--                            <div class="mb-3">--}}
{{--                                <img class="img-avatar" src="assets/media/avatars/avatar13.jpg" alt="">--}}
{{--                            </div>--}}
                            <h1 class="fs-lg mb-0">
                                <span>{{$data->name}}</span>
                            </h1>
                            <p class="fs-lg fw-medium text-muted">{{$data->job_vacancy->name}}</p>
                        </div>
                    </div>
                    <div class="block-content bg-body-light text-center">
                        <div class="row items-push text-uppercase">
                            <div class="col-6 col-md-3">
                                <div class="fw-semibold text-dark mb-1">Division / Departmen</div>
                                <a class="link-fx text-primary" href="javascript:void(0)">{{$data->job_vacancy->job_vacancy_department->description}}</a>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="fw-semibold text-dark mb-1">Email</div>
                                <a class="link-fx text-primary" href="javascript:void(0)">{{$data->email}}</a>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="fw-semibold text-dark mb-1">Phone</div>
                                <a class="link-fx text-primary" href="javascript:void(0)">{{$data->phone}}</a>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="fw-semibold text-dark mb-1">Gender</div>
                                <a class="link-fx text-primary" href="javascript:void(0)">{{$data->gender}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END User Info -->


                <div class="row">
                    <div class="col-6">
                        <!-- Addresses -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Addresses</h3>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Address -->
                                        <div class="block block-rounded block-bordered">
                                            <div class="block-header border-bottom">
                                                <h3 class="block-title">Address</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="fs-4 mb-1">{{$data->address}}</div>
                                                <address class="fs-sm">
                                                    {{$data->district}}, {{$data->city}}, {{$data->province}}<br>
                                                    {{$data->country}}<br>
                                                </address>
                                            </div>
                                        </div>
                                        <!-- END Address -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Addresses -->
                    </div>
                    <div class="col-6">
                        <!-- certificate -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Certificate</h3>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Address -->
                                        <div class="block block-rounded block-bordered">
                                            <div class="block-header border-bottom">
                                                <h3 class="block-title">List Certificate</h3>
                                            </div>
                                            <div class="block-content">
                                                @foreach($data->job_application_certificates as $certificate)
                                                    <p class="fs-md">
                                                        <a href="{{route('admin.job_application.download', ['filename' => $certificate->filename])}}" >
                                                            {{$certificate->filename}}
                                                        </a>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- END Address -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END certificate -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <!-- CV & PORTFOLIO -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Online Portfolio</h3>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Address -->
                                        <div class="block block-rounded block-bordered">
                                            <div class="block-header border-bottom">
                                                <h3 class="block-title">Online Portfolio</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="fs-4 mb-1">Online Portfolio 1</div>
                                                @if (!empty($data->online_porto_1))
                                                    <p class="fs-md">
                                                        {{$data->online_porto_1}}
                                                    </p>
                                                @else
                                                    <p class="fs-md text-muted">-</p>
                                                @endif

                                                <div class="fs-4 mb-1">Online Portfolio 2</div>
                                                @if (!empty($data->online_porto_1))
                                                    <p class="fs-md">
                                                        {{$data->online_porto_1}}
                                                    </p>
                                                @else
                                                    <p class="fs-md text-muted">-</p>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- END Address -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END CV & PORTFOLIO -->
                    </div>
                    <div class="col-6">
                        <!-- CV & PORTFOLIO -->
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">CV & Portfolio</h3>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Address -->
                                        <div class="block block-rounded block-bordered">
                                            <div class="block-header border-bottom">
                                                <h3 class="block-title">CV & Portfolio</h3>
                                            </div>
                                            <div class="block-content">
                                                @foreach($data->job_application_portfolios as $portfolio)
                                                    <p class="fs-md">
                                                        <a href="{{route('admin.job_application.download', ['filename' => $portfolio->filename])}}" >
                                                            {{$portfolio->filename}}
                                                        </a>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- END Address -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END CV & PORTFOLIO -->
                    </div>
                </div>

                <!-- Social Media -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Social Media</h3>
                    </div>
                    <div class="block-content">
                        <div class="row items-push">
                            <div class="col-md-3">
                                <!-- Referred User -->
                                <div class="block block-rounded block-bordered block-link-shadow h-100 mb-0" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="fw-semibold mb-1">Sosmed 1</div>
                                            @if (!empty($data->sosmed1))
                                                <a href="{{$data->sosmed1}}">
                                                    <div class="fs-sm text-muted">{{$data->sosmed1}}</div>
                                                </a>
                                            @else
                                                <div class="fs-sm text-muted">-</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- END Referred User -->
                            </div>
                            <div class="col-md-3">
                                <!-- Referred User -->
                                <div class="block block-rounded block-bordered block-link-shadow h-100 mb-0" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="fw-semibold mb-1">Sosmed 2</div>
                                            @if (!empty($data->sosmed2))
                                                <a href="{{$data->sosmed2}}">
                                                    <div class="fs-sm text-muted">{{$data->sosmed2}}</div>
                                                </a>
                                            @else
                                                <div class="fs-sm text-muted">-</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- END Referred User -->
                            </div>
                            <div class="col-md-3">
                                <!-- Referred User -->
                                <div class="block block-rounded block-bordered block-link-shadow h-100 mb-0" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="fw-semibold mb-1">Sosmed 3</div>
                                            @if (!empty($data->sosmed3))
                                                <a href="{{$data->sosmed3}}">
                                                    <div class="fs-sm text-muted">{{$data->sosmed3}}</div>
                                                </a>
                                            @else
                                                <div class="fs-sm text-muted">-</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- END Referred User -->
                            </div>
                            <div class="col-md-3">
                                <!-- Referred User -->
                                <div class="block block-rounded block-bordered block-link-shadow h-100 mb-0" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="fw-semibold mb-1">Sosmed 4</div>
                                            @if (!empty($data->sosmed4))
                                                <a href="{{$data->sosmed4}}">
                                                    <div class="fs-sm text-muted">{{$data->sosmed4}}</div>
                                                </a>
                                            @else
                                                <div class="fs-sm text-muted">-</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- END Referred User -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Social Media -->

                <!-- Education -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Education</h3>
                    </div>
                    <div class="block-content pb-5">
                        @foreach($data->job_application_educations as $education)
                            <div class="row py-3">
                                <div class="col-md-3 text-end">{{$education->start_year}} - {{$education->end_year}}</div>
                                <div class="col-md-9">
                                    {{$education->degree}} <br>
                                    {{$education->instution}} {{$education->location}}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <!-- END Education -->

                <!-- Experience -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Experience</h3>
                    </div>
                    <div class="block-content pb-5">
                        @foreach($data->job_application_experiences as $experience)
                            <div class="row py-3">
                                @if($experience->is_still_working == 1)
                                    <div class="col-md-3 text-end">{{$experience->start_month}} {{$experience->start_year}} - Present</div>
                                @else
                                    <div class="col-md-3 text-end">{{$experience->start_month}} {{$experience->start_year}} - {{$experience->end_month}} {{$experience->end_year}}</div>
                                @endif
                                <div class="col-md-9">
                                    {{$experience->title}} <br>
                                    {{$experience->company}} {{$experience->type}}
                                    <hr>
                                    {{$experience->description}}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <!-- END Experience -->
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link href="{{ asset('custom/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">

@endsection

@section('scripts')
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('custom/summernote/summernote-bs4.min.js') }}"></script>
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

        $('#form_create_blog').submit(function(){
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
            $("#featured-image").fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                overwriteInitial: false,
                maxFileSize: 2048,
                showUpload: false,
            });
            $('#long_description').summernote({
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
            $('#long_description').summernote('disable');
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
