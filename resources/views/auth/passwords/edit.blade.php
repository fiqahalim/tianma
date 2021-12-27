@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.setting.title') }}</li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('cruds.setting.change_password') }}
        </li>
    </ol>
</nav>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img class="rounded-circle" src="{{ asset('/storage/images/'.Auth::user()->avatar) ?? 'https://bootdey.com/img/Content/avatar/avatar7.png' }}" width="150">
                                <div class="mt-3">
                                    <h4>
                                        {{ Auth::user()->name }}
                                    </h4>
                                    <p class="text-secondary mb-1">
                                        {{ Auth::user()->email }}
                                    </p>
                                    <p class="text-muted font-size-sm">
                                        {{ Auth::user()->username }}
                                    </p>
                                </div>
                            </img>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header font-weight-bold">
                        {{ trans('global.change_password') }}
                    </div>
                    <div class="card-body">
                        <form id="change_password" method="POST" action="{{ route("profile.password.update") }}">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="required" for="title">New {{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="required" for="title">Repeat New {{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-danger" type="submit" onclick="changePassword('change_password')">
                                        {{ trans('global.save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("script")
    <script type="text/javascript" src="{{ mix('/js/pages/profile.js') }}"></script>
@endpush