@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">Create {{ trans('cruds.commission.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.create') }} {{ trans('cruds.commission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.commissions.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="commission">{{ trans('cruds.commission.fields.commission') }}</label>
                    <input class="form-control {{ $errors->has('commission') ? 'is-invalid' : '' }}" type="number" name="commission" id="commission" value="{{ old('commission', '') }}" step="0.01">
                    @if($errors->has('commission'))
                        <div class="invalid-feedback">
                            {{ $errors->first('commission') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.commission.fields.commission_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="increased_commission">{{ trans('cruds.commission.fields.increased_commission') }}</label>
                    <input class="form-control {{ $errors->has('increased_commission') ? 'is-invalid' : '' }}" type="number" name="increased_commission" id="increased_commission" value="{{ old('increased_commission', '') }}" step="0.01">
                    @if($errors->has('increased_commission'))
                        <div class="invalid-feedback">
                            {{ $errors->first('increased_commission') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.commission.fields.increased_commission_helper') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user_id">{{ trans('cruds.commission.fields.user') }}</label>
                    <select class="form-control form-select {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.commission.fields.user_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="order_id">{{ trans('cruds.commission.fields.order') }}</label>
                    <select class="form-control form-select {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                        @foreach($orders as $id => $entry)
                            <option value="{{ $id }}" {{ old('order_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('order'))
                        <div class="invalid-feedback">
                            {{ $errors->first('order') }}
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