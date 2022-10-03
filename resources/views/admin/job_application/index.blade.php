@extends('layouts.admin')

@section('title')
    <title>BACKEND - Job Application</title>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Job Application
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Job Application
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        @include('partials._success')
        @include('partials._error')
        <div class="block block-rounded">
            <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                <li class="nav-item">
{{--                    <button href="{{ route('contact.buyer.index') }}" class="nav-link active">Pembeli</button>--}}
                </li>
                <li class="nav-item">
{{--                    <a href="{{ route('contact.supplier.index') }}" class="nav-link">Supplier</a>--}}
                </li>
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane"></div>

                <div class="tab-pane active">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive w-100" >
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="table_blog">
                                    <thead>
                                    <tr>
                                        <th style='width:10%'>Created Date</th>
                                        <th style='width:20%'>Name</th>
                                        <th style='width:20%'>Email</th>
                                        <th style='width:20%'>Job Vacancy</th>
                                        <th style='width:20%'>Division</th>
                                        <th style="width:10%;">Option</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="w-100" style="height: 400px"></div>
                </div>
            </div>
        </div>
    </div>
    @include('partials._delete')
@endsection

@section('styles')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
@endsection

@section('scripts')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script>
        $(function() {
            $('#table_blog').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                responsive: false,
                ajax: {
                    url: '{!! route('admin.job_application.datatable') !!}'
                },
                sWrapper: "dataTables_wrapper dt-bootstrap5",
                sFilterInput: "form-control form-control-sm",
                sLengthSelect: "form-select form-select-sm",
                pagingType: 'full_numbers',
                language: {
                    lengthMenu: "_MENU_",
                    search: "_INPUT_",
                    searchPlaceholder: "Search keyword..",
                    info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
                    paginate: {
                        first: '<i class="fa fa-angle-double-left"></i>',
                        previous: '<i class="fa fa-angle-left"></i>',
                        next: '<i class="fa fa-angle-right"></i>',
                        last: '<i class="fa fa-angle-double-right"></i>'
                    }
                },
                columns: [
                    { data: 'created_at', name: 'created_at', class: 'text-center', orderable: true, searchable: false,
                        render: function ( data, type, row ){
                            if ( type === 'display' || type === 'filter' ){
                                return moment(data).format('DD MMM YYYY');
                            }
                            return data;
                        }
                    },
                    { data: 'name', name: 'name', class: 'text-center'},
                    { data: 'email', name: 'email', class: 'text-center'},
                    { data: 'job_vacancy_name', name: 'job_vacancy_name', class: 'text-center'},
                    { data: 'job_vacancy_division', name: 'job_vacancy_division', class: 'text-center'},
                    { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'}
                ]
            });
        });
        $(document).on('click', '.delete-modal', function(){
            $('#deleteModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#deleted-id').val($(this).data('id'));
        });
    </script>
    @include('partials._deletejs', ['routeUrl' => 'admin.job_application.destroy', 'redirectUrl' => 'admin.job_application.index'])
@endsection
