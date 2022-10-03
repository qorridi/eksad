@extends('layouts.admin-login')

@section('title')
    <title>BACKEND - Testing Send Notification </title>
@endsection

@section('content')

    <div class="content">
        <form action="{{route('admin.company.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Testing Send Notification</h3>
                    <div class="block-options">
                        <button type="submit" class="btn btn-sm btn-alt-primary">
                            SUBMIT
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-lg-10 col-xl-10">
                            @include('partials.admin._messages')
{{--                            <div class="form-floating mb-4">--}}
{{--                                <select class="form-select" id="type" name="type" aria-label="Type">--}}
{{--                                    <option value="-1" selected>Select an option</option>--}}
{{--                                    <option value="101">101</option>--}}
{{--                                    <option value="102">102</option>--}}
{{--                                    <option value="201">201</option>--}}
{{--                                </select>--}}
{{--                                <label for="type">Notif Type (ex: 101 / 102 / 201 etc)</label>--}}
{{--                            </div>--}}
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="type" name="type" placeholder=""
                                       value="{{old('type')}}">
                                <label for="name">Notif Type (ex: 101 / 102 / 201 etc)</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder=""
                                       value="{{old('phone')}}">
                                <label for="name">User Registered Phone</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="title" name="title" placeholder=""
                                       value="{{old('title')}}">
                                <label for="code">Title</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="message" name="message" placeholder=""
                                       value="{{old('message')}}">
                                <label for="code">Message</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
