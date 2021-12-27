@extends('layouts.app')

@section('content')
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-12">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-4 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5">
                                    <h4 class="mb-4">
                                        We are more than just a company
                                    </h4>
                                    <p class="small mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img alt="logo" src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/lotus.png" style="width: 185px;">
                                            <h4 class="mt-1 mb-3 pb-1">We are The TianMa Team</h4>
                                            <p>{{ __('auth.register_label') }}</p>
                                        </img>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-row mt-4">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="agent_code">
                                                    {{ trans('global.register.agent_code') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-user fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control form-select {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id">
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}" {{ old('parent_id') == $user->id ? 'selected' : '' }}>{{ $user->agent_code }}</option>
                                                            @foreach($user->childUsers as $childUser)
                                                                <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>-- {{ $childUser->agent_code }}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="text" name="agent_code" class="form-control{{ $errors->has('agent_code') ? ' is-invalid' : '' }}" required autofocus value="{{ old('agent_code', null) }}">
                                                    @if($errors->has('agent_code'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('agent_code') }}
                                                        </div>
                                                    @endif --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="name">
                                                    {{ trans('global.register.full_name') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-pencil fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus value="{{ old('name', null) }}">
                                                    @if($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="contact_no">
                                                    {{ trans('global.register.contact_no') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-mobile fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="contact_no" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" required autofocus value="{{ old('contact_no', null) }}">
                                                    @if($errors->has('contact_no'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('contact_no') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="email">
                                                    {{ trans('global.login_email') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-envelope fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required value="{{ old('email', null) }}">
                                                    @if($errors->has('email'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="username">
                                                    {{ trans('global.username') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-user fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required autofocus value="{{ old('username', null) }}">
                                                    @if($errors->has('username'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('username') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ID --}}
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="id_type">
                                                    {{ trans('global.register.id_type') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-id-card fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control {{ $errors->has('id_type') ? 'is-invalid' : '' }}" name="id_type" id="id_type">
                                                        <option value disabled {{ old('id_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                        @foreach(App\Models\Customer::ID_TYPE_SELECT as $key => $label)
                                                            <option value="{{ $key }}" {{ old('id_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('id_number'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('id_number') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="id_number">
                                                    {{ trans('global.register.id_number') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-id-card fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="id_number" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" required autofocus value="{{ old('id_number', null) }}">
                                                    @if($errors->has('id_number'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('id_number') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="password">
                                                    {{ trans('global.login_password') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-lock fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                                    @if($errors->has('password'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold required" for="password">
                                                    {{ trans('global.login_password_confirmation') }}
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-lock fa-fw"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" name="password_confirmation" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">
                                                {{ trans('global.register.title') }}
                                            </button>
                                        </div>
                                        
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2 mr-2">
                                                Already have an account?
                                            </p>
                                            <a class="btn btn-outline-primary" href="{{ route('login') }}">
                                                {{ trans('global.login') }}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection