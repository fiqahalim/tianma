@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">Edit {{ trans('cruds.commission.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.edit') }} {{ trans('cruds.commission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.commissions.update", [$commission->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="mo_overriding_comm">{{ trans('cruds.commission.fields.commission') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('mo_overriding_comm') ? 'is-invalid' : '' }}" type="number" name="commission" id="mo_overriding_comm" value="{{ old('mo_overriding_comm', $commission->mo_overriding_comm) }}" step="0.01" readonly>
                        @if($errors->has('mo_overriding_comm'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mo_overriding_comm') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.commission.fields.commission_helper') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="mo_spin_off">{{ trans('cruds.commission.fields.increased_commission') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('mo_spin_off') ? 'is-invalid' : '' }}" type="number" name="mo_spin_off" id="mo_spin_off" value="{{ old('mo_spin_off', $commission->mo_spin_off) }}" step="0.01" readonly>
                        @if($errors->has('mo_spin_off'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mo_spin_off') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.commission.fields.increased_commission_helper') }}</span>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user_id">{{ trans('cruds.commission.fields.user') }}</label>
                    <input class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ $commission->user->agent_code }}" readonly>
                    @if($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.commission.fields.user_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="order_id">{{ trans('cruds.commission.fields.order') }}</label>
                    <input class="form-control {{ $errors->has('orders') ? 'is-invalid' : '' }}" type="text" name="order_id" id="order_id" value="#{{ $commission->orders->ref_no }}" readonly>
                    @if($errors->has('orders'))
                        <div class="invalid-feedback">
                            {{ $errors->first('orders') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.commission.fields.order_helper') }}</span>
                </div>
            </div>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
