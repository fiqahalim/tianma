@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h3 class="text-center">
                    <img alt="logo" src="{{ asset('/images/tianma_logo_op-02.png') }}" style="width: 185px;">
                </h3>
                <h2 class="text-center">
                    {{ __('passwords.forgot_title') }}
                </h2>
                <p class="text-muted text-center">{{ __('passwords.forgot_label') }}</p>

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user fa-fw"></i>
                                </span>
                            </div>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-flat btn-block">
                                {{ trans('global.send_password') }}
                            </button>
                        </div>
                    </div>
                    <p class="text-sm text-center mt-4">
                        Don't have an account yet?
                        <a href="{{ route('register') }}">
                            Sign up
                        </a>
                    </p>
                    <p class="text-center">
                        or
                        <a href="{{ route('login') }}">
                            {{ __('login') }}
                        </a>
                        here
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection