@extends('layouts.admin')

@section('title')
    <title>BACKEND - Add New Admin User</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Add New Admin User
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.adminuser.index') }}">Admin User List</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Add New Admin User
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
                                <form class="space-y-3" id="form_create_admin_user" method="POST" action="{{ route('admin.adminuser.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button id="btn_loading" type="button" class="btn btn-outline-success" style="display: none;">
                                                <i class="spinner-border spinner-border-sm text-green" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </i>
                                            </button>
                                            <input type="submit" id="btn_submit" class="btn btn-outline-success" value="Simpan"/>&nbsp;&nbsp;
                                            <a id="btn_cancel" href="{{ route('admin.adminuser.index') }}" class="btn btn-outline-danger">Batal</a>
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
                                        <div class="col-sm-4">
                                            <input id="name" type="text" class="form-control"
                                                   name="name" value="{{ old('name') }}" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="name">Email</label>
                                        <div class="col-sm-4">
                                            <input id="email" type="email" class="form-control"
                                                   name="email" value="{{ old('email') }}" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="name">Phone</label>
                                        <div class="col-sm-4">
                                            <input id="phone" type="text" class="form-control"
                                                   name="phone" value="{{ old('phone') }}" placeholder="Phone" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="name">Password</label>
                                        <div class="col-sm-4">
                                            <input id="password" type="password" class="form-control"
                                                   name="password" value="{{ old('password') }}" placeholder="Password" required>
                                        </div>
                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <label class="col-sm-3 col-form-label" for="name">Confirm Password</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <input id="confirm_password" type="password" class="form-control"--}}
{{--                                                   name="confirm_password" value="{{old('confirm_password')}}" placeholder="Confirm Password" required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('#form_create_admin_user').submit(function(){
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
@endsection
