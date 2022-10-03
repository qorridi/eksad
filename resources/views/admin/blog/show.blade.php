@extends('layouts.admin')

@section('title')
    <title>BACKEND - Detil Blog</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Blog "{{ $blog->title }}"
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
                            Show Blog
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
                                        <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}" class="btn btn-primary">UBAH</a>
                                        @if($blog->status_id === 9)
                                            <a href="{{ route('admin.blog.publish', ['id' => $blog->id]) }}" class="btn btn-warning">PUBLISH</a>
                                        @else
                                            <a href="{{ route('admin.blog.unpublish', ['id' => $blog->id]) }}" class="btn btn-warning">UNPUBLISH</a>
                                        @endif

                                        <a class="btn btn-danger" style="cursor: pointer;" onclick="modalDelete();">HAPUS</a>
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
                                    <div class="col-sm-6">
                                        <select id="status_id" name="status_id" class="custom-select form-control" disabled>
                                            <option value="-1">- Pilih Status -</option>
                                            <option value="9" @if($blog->status_id == 9) selected @endif >UNPUBLISH</option>
                                            <option value="10" @if($blog->status_id == 10) selected @endif >PUBLISH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label" for="name">Blog Title *</label>
                                    <div class="col-sm-6">
                                        <input id="title" type="text" class="form-control"
                                               name="title" value="{{ $blog->title }}" placeholder="Blog Title" readonly> </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="category">Category *</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="category" name="category" class="custom-select form-control" disabled>
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
                                    </div>
                                    <div class="col-sm-6">
                                        @if($blog->status_id === 2)
                                            <img src="{{ asset('images/eksad/empty.png') }}" style="height:300px" alt="article-image">
                                        @else
                                            <img src="{{ asset($blog->img_path) }}" style="height:300px" alt="article-image">
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="subtitle">Short Description</label>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $blog->subtitle }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="total_manday">Publish At </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="start_date" name="start_date" type="text" class="form-control" autocomplete="off" value="{{ $blog->published_at->format('d M Y') }}" readonly>

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
                                                        <div class="form-control">{!! $blog->description_1 !!}</div>
                                                    </div>
                                                </div>
                                                <!-- #END# Input -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="container-fluid my-3 space-y-3">--}}
{{--        <form class="form-material">--}}

{{--            <div class="row mb-3">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body b-b">--}}

{{--                            <!-- Input -->--}}
{{--                            <div class="body">--}}
{{--                                <div class="row clearfix">--}}
{{--                                    <div class="col-md-3"></div>--}}
{{--                                    <div class="col-md-6 col-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Judul Blog</label>--}}
{{--                                                <input type="text" class="form-control" value="{{ $blog->title }}" readonly />--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Sub Judul Blog</label>--}}
{{--                                                <input type="text" class="form-control" value="{{ $blog->subtitle ?? "-" }}" readonly />--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Tanggal Dibuat</label>--}}
{{--                                                <input type="text" class="form-control" value="{{ $blog->created_at }}" readonly />--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Status</label>--}}
{{--                                                <input type="text" class="form-control font-weight-bold" style="color: {{ $blog->status_id === 3 ? 'red' : 'green' }};" value="{{ $blog->status->description }}" readonly />--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="form-line">--}}
{{--                                                <label class="form-control">Gambar Utama</label>--}}
{{--                                                <img src="{{ asset($blog->img_path) }}" style="height:300px" alt="article-image">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- #END# Input -->--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mb-3">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body b-b">--}}
{{--                            <!-- Input -->--}}
{{--                            <div class="body">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="content" class=" col-form-label">Konten Berita</label>--}}
{{--                                    <div class="form-control">{!! $blog->description_1 !!}</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- #END# Input -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

    <!-- Delete Blog Modal -->
    <div class="modal" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(['route'=>['admin.blog.destroy'],'method' => 'post','id' => 'general-form', 'novalidate']) }}
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus blog ini?
                        <input type="hidden" name="id" value="{{ $blog->id }}"/>
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
    @include('partials._delete')
@endsection

@section('styles')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
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
    <script>
        function modalDelete(){
            $('#modal-delete').modal('show');
        }
    </script>
{{--    @include('partials._deleteJs', ['routeUrl' => 'admin.blog.destroy', 'redirectUrl' => 'admin.blog.index'])--}}
@endsection

