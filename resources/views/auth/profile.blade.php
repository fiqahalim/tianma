@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.setting.title') }}</li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('cruds.setting.profile') }}
        </li>
    </ol>
</nav>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        {{-- Profile Image --}}
                        <form method="POST" action="{{ route("profile.updateProfileImage") }}" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex flex-column align-items-center text-center">
                                <img class="rounded-circle" src="{{ asset('/images/profile/' .Auth::user()->avatar) ?? '/images/avatar.png' }}" width="150">
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
                                <input type="file" name="avatar" id="avatar">
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" type="submit">
                                            {{ trans('cruds.user.fields.change_image') }}
                                        </button>
                                    </div>
                                </div>
                                {{-- <input type="file" name="avatar" id="avatar" style="opacity: 0;height:1px;display:none">
                                <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn"><b>Change picture</b></a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Profile Details --}}
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header font-weight-bold">
                        {{ trans('global.profile_information') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route("profile.updateProfile") }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="required" for="name">
                                        {{ trans('cruds.user.fields.name') }}
                                    </label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.product.fields.product_name_helper') }}</span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="username">{{ trans('cruds.user.fields.username') }}</label>
                                    <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', auth()->user()->username) }}" readonly>
                                    @if($errors->has('username'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="contact_no">{{ trans('cruds.user.fields.contact_no') }}</label>
                                    <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="text" name="contact_no" id="username" value="{{ old('contact_no', auth()->user()->contact_no) }}" required>
                                    @if($errors->has('contact_no'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('contact_no') }}
                                        </div>
                                    @endif
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="id_type">{{ trans('cruds.user.fields.id_type') }}</label>
                                    <input class="form-control {{ $errors->has('id_type') ? 'is-invalid' : '' }}" type="text" name="id_type" id="id_type" value="{{ old('id_type', auth()->user()->id_type) }}" required readonly>
                                    @if($errors->has('id_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_type') }}
                                        </div>
                                    @endif
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <label for="id_number">{{ trans('cruds.user.fields.id_number') }}</label>
                                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', auth()->user()->id_number) }}" required readonly>
                                    @if($errors->has('id_number'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_number') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="required" for="address_1">{{ trans('cruds.user.fields.address_1') }}</label>
                                    <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', auth()->user()->address_1) }}" required>
                                    @if($errors->has('address_1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address_1') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="required" for="address_2">{{ trans('cruds.user.fields.address_2') }}</label>
                                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', auth()->user()->address_2) }}" required>
                                    @if($errors->has('address_2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address_2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="required" for="state">{{ trans('cruds.user.fields.state') }}</label>
                                    <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', auth()->user()->state) }}" required>
                                    @if($errors->has('state'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('state') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="required" for="postcode">{{ trans('cruds.user.fields.postcode') }}</label>
                                    <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text" name="postcode" id="postcode" value="{{ old('postcode', auth()->user()->postcode) }}" required>
                                    @if($errors->has('postcode'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('postcode') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="required" for="city">{{ trans('cruds.user.fields.city') }}</label>
                                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', auth()->user()->city) }}" required>
                                    @if($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-danger" type="submit">
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

@section('scripts')
@parent
{{-- <script type="text/javascript" src="{{ mix('/js/profile.js') }}"></script> --}}
@endsection