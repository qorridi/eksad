@extends('layouts.admin')

@section('title')
    <title>BACKEND - Detil Blog</title>
@endsection

@section('content')
    <header class="blue accent-3 relative nav-sticky" >
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4> <i class="fa fa-table"></i> Blog {{ $blog->title }}</h4>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid my-3">
        <div class="row mb-3">
            <div class="col-12 text-right">
                <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}" class="btn btn-primary">UBAH</a>
                @if($blog->status_id === 3)
                    <a href="{{ route('admin.blog.publish', ['id' => $blog->id]) }}" class="btn btn-warning">PUBLISH</a>
                @else
                    <a href="{{ route('admin.blog.unpublish', ['id' => $blog->id]) }}" class="btn btn-warning">UNPUBLISH</a>
                @endif

                <a class="btn btn-danger" style="cursor: pointer;" onclick="modalDelete();">HAPUS</a>
            </div>
        </div>
        <form class="form-material">

            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body b-b">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-12">
                                            <div role="alert" class="alert alert-success">
                                                {{ \Illuminate\Support\Facades\Session::get('message') }}
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
                        <div class="card-body b-b">

                            <!-- Input -->
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label class="form-control">Judul Blog</label>
                                                <input type="text" class="form-control" value="{{ $blog->title }}" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label class="form-control">Sub Judul Blog</label>
                                                <input type="text" class="form-control" value="{{ $blog->subtitle ?? "-" }}" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label class="form-control">Tanggal Dibuat</label>
                                                <input type="text" class="form-control" value="{{ $blog->created_at_formatted }}" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label class="form-control">Status</label>
                                                <input type="text" class="form-control font-weight-bold" style="color: {{ $blog->status_id === 3 ? 'red' : 'green' }};" value="{{ $blog->status->description }}" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label class="form-control">Gambar Utama</label>
                                                <img src="{{ asset($blog->img_path) }}" alt="article-image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                            <!-- #END# Input -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body b-b">
                            <!-- Input -->
                            <div class="body">
                                <div class="form-group">
                                    <label for="content" class="form-control">Konten Berita</label>
                                    <div>{!! $blog->description !!}</div>
                                </div>
                            </div>
                            <!-- #END# Input -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete Blog Modal -->
    <div class="modal" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(['route'=>['admin.blog.destroy'],'method' => 'post','id' => 'general-form', 'novalidate']) }}
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus blog ini?
                        <input type="hidden" name="deleted-blog-id" value="{{ $blog->id }}"/>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                        <input type="submit" class="btn btn-success" value="Ya" />
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script>
        function modalDelete(){
            $('#modal-delete').modal('show');
        }
    </script>
@endsection
