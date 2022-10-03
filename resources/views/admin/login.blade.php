@extends('layouts.admin-login')

@section('title')
    <title>Eksad - Backend Login</title>
@endsection

@section('content')

    <main id="main-container">

        <!-- Page Content -->
        <div class="hero-static d-flex align-items-center">
            <div class="w-100">
                <!-- Sign In Section -->
                <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="row g-0 justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
                                <!-- Header -->
                                <div class="text-center">
                                    <p class="mb-2">
                                        <img src="{{asset('images/eksad/logo-eksad.png')}}" alt="">
                                    </p>
                                    <h1 class="h4 mb-1">
                                        Sign In
                                    </h1>
                                    <h2 class="fw-medium text-muted mb-3">
                                        Eksad <br>Admin Login
                                    </h2>
                                </div>
                                <!-- END Header -->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation (.js') }}-validation-signin class is initialized in js/pages/op_auth_signin.min.js') }} which was auto compiled from _js/pages/op_auth_signin.js') }}) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
{{--                                <form method="POST" action="{{ route('admin.login.submit') }}">--}}

                                @foreach($errors->all() as $error)
                                    <span class="help-block">
                                        <strong style="color: #ff3d00;"> {{ $error }} </strong>
                                    </span>
                                @endforeach

                                <form method="POST" action="{{ route('admin.login.submit') }}">
                                    @csrf
                                    <div class="py-3">
                                        <div class="mb-4">
                                            <input type="text" class="form-control form-control-lg form-control-alt"
                                                   id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                        </div>
                                        <div class="mb-4">
                                            <input type="password" class="form-control form-control-lg form-control-alt"
                                                   id="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="mb-4">
                                            <div class="d-md-flex align-items-md-center justify-content-md-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="login-remember" name="login-remember">
                                                    <label class="form-check-label" for="login-remember">Remember Me</label>
                                                </div>
{{--                                                <div class="py-2">--}}
{{--                                                    <a class="fs-sm fw-medium" href="op_auth_reminder2.html">Forgot Password?</a>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 col-xxl-5">
                                            <button type="submit" class="btn w-100 btn-alt-primary" onclick="this.form.submit(); this.disabled=true;">
                                                <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Sign In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Sign In Section -->

                <!-- Footer -->
                <div class="fs-sm text-center text-muted py-3">
                    <strong>PT. Tiga Daya Digital Indonesia </strong> &copy; <span data-toggle="year-copy"></span>
                </div>
                <!-- END Footer -->
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection
