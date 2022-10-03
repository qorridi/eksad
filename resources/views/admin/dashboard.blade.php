@extends('layouts.admin')

@section('title')
    <title>BACKEND - Dashboard</title>
@endsection

@section('content')

    <!-- Hero -->
    <div class="content">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">
                    Dashboard
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                    Welcome <a class="fw-semibold" href="{{route('admin.adminuser.edit', ['id'=>$admin->id])}}">{{$admin->name}}</a>, everything looks great.
                </h2>
            </div>
        </div>
    </div>
    <!-- END Hero -->


@endsection
@section('scripts')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_pages_dashboard.min.js') }}"></script>
@endsection
