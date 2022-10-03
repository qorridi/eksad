@extends('layouts.admin-login')

@section('title')
    <title>BACKEND - Testing Save Token </title>
@endsection

@section('content')

    <div class="content">
        <form method="POST" action="{{ route('test.notif.saveToken') }}">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Testing Save Token</h3>
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
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Name"
                                       value="{{old('phone')}}">
                                <label for="phone">User Registered Phone</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="fcm_token" name="fcm_token" placeholder="Code"
                                       value="{{old('fcm_token')}}">
                                <label for="fcm_token">FCM Token</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
