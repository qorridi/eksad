@extends('layouts.admin')

@section('title')
    <title>BACKEND - Detil Portfolio</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Show Portfolio
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
                            Show Portfolio {{ $portfolio->client_name }}
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
                                <form class="form-material space-y-3">
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <a href="{{ route('admin.portfolio.edit', ['id' => $portfolio->id]) }}" id="btn_edit" class="btn btn-outline-primary">Edit</a>&nbsp;&nbsp;
                                            @if($portfolio->status_id ===2 )
                                                <button type="button" id="btn_publish" class="btn btn-outline-success" onclick="modalStatus({{ $portfolio->id }}, 'publish')">Publish</button>&nbsp;&nbsp;
                                            @else
                                                <button type="button" id="btn_unpublish" class="btn btn-outline-danger" onclick="modalStatus({{ $portfolio->id }}, 'unpublish')">Unpublish</button>
                                            @endif
                                            <button type="button" id="btn_delete" class="btn btn-outline-danger" onclick="modalDelete({{ $portfolio->id }}, '{{ $portfolio->client_name }}')">Delete</button>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @include('partials._success')
                                            @include('partials._error')
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="status">Status</label>
                                        <div class="col-sm-4">
                                            <input type="text" id="status" name="status" class="form-control fw-bold" placeholder="Nama Klien" value="{{ $status }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="client_name">Client Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Nama Klien" value="{{ $portfolio->client_name }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="project_year">Project Year </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input id="project_year" name="project_year" type="text" class="form-control" value="{{ $portfolio->year ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <span style="font-weight: 500">Included Solutions :</span>
                                                </div>
                                                <div class="col-sm-8">
                                                    @if($portfolio->solutions->count() > 0)
                                                        <ul>
                                                            @foreach($portfolio->solutions as $solution)
                                                                <li>{{ $solution->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        No Solution Linked
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div class="col-sm-6 col-12">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-sm-4">--}}
{{--                                                    <span style="font-weight: 500">Included Products :</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-8">--}}
{{--                                                    @if($portfolio->products->count() > 0)--}}
{{--                                                        <ul>--}}
{{--                                                            @foreach($portfolio->products as $product)--}}
{{--                                                                <li>{{ $product->sku. ' - '. $product->name }}</li>--}}
{{--                                                            @endforeach--}}
{{--                                                        </ul>--}}
{{--                                                    @else--}}
{{--                                                        No Product Linked--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="description">Title</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="description" name="description" class="form-control" placeholder="Description" value="{{ $portfolio->description ?? '' }}" readonly/>
{{--                                            <textarea id="description" name="description" class="form-control" rows="4" readonly> {{ $portfolio->description ?? '' }}</textarea>--}}
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="logo_image">Client Logo</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <img style="width: 100px; height: auto;" src="{{ asset('storage/portfolio_images/'. $portfolio->img_logo) }}">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="primary_image">Primary Picture</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <img style="width: 100px; height: auto;" src="{{ asset('storage/portfolio_images/'. $portfolio->img_primary) }}">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="other_images">Other Pictures</label>
                                        </div>
                                        <div class="col-sm-9">
                                            @if($otherImages->count() > 0)
                                                <div class="row">
                                                    @foreach($otherImages as $otherImage)
                                                        <div class="col-sm-4 col-12">
                                                            <img style="width: 100px; height: auto;" src="{{ asset('storage/portfolio_images/'. $otherImage->img_path) }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                No Picture
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="description_3" class="col-form-label">Description</label>
                                            <div class="card">
                                                <div class="card-body b-b">
                                                    <!-- Input -->
                                                    <div class="body">
                                                        <div class="form-group">
                                                            {!! $portfolio->description_2 ?? '-' !!}
                                                        </div>
                                                    </div>
                                                    <!-- #END# Input -->
                                                </div>
                                            </div>
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
                                                            {!! $portfolio->description_3 ?? '-' !!}
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
                                                        {!! $portfolio->description_4 ?? '-' !!}
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
                                                        {!! $portfolio->description_5 ?? '-' !!}
                                                    </div>
                                                    <!-- #END# Input -->
                                                </div>
                                            </div>
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

    <!-- Modal for confirm delete -->
    <div class="modal fade" id="modal_confirm_status" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-slideup">
            <div class="modal-content">
                <div class="block-content">
                    <div class="row">
                        <div class="col-12 text-center">
                            <span>Are you sure you want to </span>
                            <span id="status_update"></span>
                            <span> this Portfolio?</span>
                            <input type="hidden" id="updated_portfolio_id">
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-center bg-body">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                    <button type="button" id="btn_submit_status" class="btn btn-success" onclick="confirmStatus()">Yes</button>
                    <button type="button" id="btn_loading_status" class="btn btn-success" style="display: none;">
                        <i class="spinner-border spinner-border-sm text-green" role="status">
                            <span class="visually-hidden">Please wait...</span>
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for confirm delete -->
    <div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-slideup">
            <div class="modal-content">
                <div class="block-content">
                    <div class="row">
                        <div class="col-12 text-center">
                            <span>Are you sure you want to delete Portfolio </span>
                            <span id="deleted_portfolio_client_name"></span>
                            <span> ?</span>
                            <input type="hidden" id="deleted_portfolio_id">
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-center bg-body">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                    <button type="button" id="btn_submit_delete" class="btn btn-danger" onclick="confirmDelete()">Yes</button>
                    <button type="button" id="btn_loading_delete" class="btn btn-danger" style="display: none;">
                        <i class="spinner-border spinner-border-sm text-green" role="status">
                            <span class="visually-hidden">Please wait...</span>
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Page JS Plugins CSS -->
@endsection

@section('scripts')
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script>
        var modalConfirmStatus = new bootstrap.Modal(document.getElementById('modal_confirm_status'), {'backdrop': 'static', 'keyboard' :false });
        var modalConfirmDelete = new bootstrap.Modal(document.getElementById('modal_confirm_delete'), {'backdrop': 'static', 'keyboard' :false });

        function modalStatus(id, status){
            $('#status_update').html(status);
            $('#updated_portfolio_id').val(id);

            modalConfirmStatus.show();
        }

        function modalDelete(id, name){
            $('#deleted_portfolio_id').val(id);
            $('#deleted_portfolio_client_name').html(name);

            modalConfirmDelete.show();
        }

        function confirmStatus(){
            let id = $('#updated_portfolio_id').val();
            let status = $('#status_update').html();

            $('#btn_loading_status').show(100);
            $('#btn_submit_status').hide();

            $.ajax({
                type:'POST',
                url:'{{ route('admin.portfolio.status.update') }}',
                data:{
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'status': status
                },
                success:function(data){
                    let error = data['error'];
                    if(error === 'none'){
                        One.helpers('jq-notify', {type: 'success', icon: 'fa fa-info-circle me-1', timer: 2000, message: 'Portfolio has been successfully ' + status + 'ed!'});
                        window.setTimeout( redirectShow, 2000 );
                    }
                    else{
                        $('#btn_submit_status').show(100);
                        $('#btn_loading_status').hide();
                        One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-info-circle me-1', timer: 2000, message: 'BAD REQUEST!'});
                    }
                },
                error:function(data){
                    $('#btn_submit_status').show(100);
                    $('#btn_loading_status').hide();
                    One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-info-circle me-1', timer: 2000, message: 'Internal server error!'});
                }
            });
        }

        function confirmDelete(){
            let id = $('#deleted_portfolio_id').val();
            let name = $('#deleted_portfolio_client_name').html();

            $('#btn_loading_delete').show(100);
            $('#btn_submit_delete').hide();

            $.ajax({
                type:'POST',
                url:'{{ route('admin.portfolio.delete') }}',
                data:{
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success:function(data){
                    let error = data['error'];
                    if(error === 'none'){
                        One.helpers('jq-notify', {type: 'success', icon: 'fa fa-info-circle me-1', timer: 2000, message: 'Portfolio ' + name + ' has been successfully deleted!'});
                        window.setTimeout( redirect, 2000 );
                    }
                    else if(error === 'data_in_usage'){
                        $('#btn_submit_delete').show(100);
                        $('#btn_loading_delete').hide();
                        One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-info-circle me-1', timer: 300, message: 'Portfolio data is in usage and cannot be deleted!'});
                    }
                    else{
                        $('#btn_submit_delete').show(100);
                        $('#btn_loading_delete').hide();
                        One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-info-circle me-1', timer: 2000, message: 'BAD REQUEST!'});
                    }
                },
                error:function(data){
                    $('#btn_submit_delete').show(100);
                    $('#btn_loading_delete').hide();
                    One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-info-circle me-1', timer: 2000, message: 'Internal server error!'});
                }
            });
        }

        function redirectShow(){
            location.reload();
        }

        function redirect(){
            window.location.href = '{{ route('admin.portfolio.index') }}';
        }

    </script>
@endsection
