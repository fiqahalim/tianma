@extends('layouts.app')

@section('content')
<section class="h-100 gradient-form">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img alt="logo" src="{{ asset('/images/tianma_logo_op-02.png') }}" style="width: 185px;">
                                        <h4 class="mt-1 mb-3 pb-1">We are The TianMa Team</h4>
                                        <p>{{ trans('auth.login_title') }}</p>
                                </div>

                                @if(session('message'))
                                    <div class="alert alert-info" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-outline mb-4 mt-4">
                                        <label class="form-label font-weight-bold required" for="email">
                                            {{ trans('global.username') }}
                                        </label>
                                        <input id="username" name="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required autocomplete="username" autofocus value="{{ old('username', null) }}">
                                        @if($errors->has('username'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('username') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label font-weight-bold required" for="password">
                                            {{ trans('global.login_password') }}
                                        </label>
                                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">
                                            {{ trans('global.login') }}
                                        </button>
                                        @if(Route::has('password.request'))
                                            <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                {{ trans('global.forgot_password') }}
                                            </a>
                                        @endif
                                    </div>
                                    
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2 mr-2">
                                            Don't have an account?
                                        </p>
                                        <a class="btn btn-outline-primary" href="{{ route('register') }}">
                                            {{ trans('global.register.title') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">
                                    We are more than just a company
                                </h4>
                                <p class="small mb-0">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
