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
            Commission Installment Calculator
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.commissions.store", [$order->id]) }}" enctype="multipart/form-data" id="commissionInstallment-form">
                @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="point_value">Point Value</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="point_value" id="point_value" value="{{ old('point_value', $order->commissions->point_value)}}" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i>PV</i>
                                    </span>
                                </div>
                                @if($errors->has('point_value'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('point_value') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="installment_year">Monthly Installment</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" name="installment_year" id="installment_year" value="{{ old('installment_year', $order->installments->installment_year) }}" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i>months</i>
                                    </span>
                                </div>
                                @if($errors->has('installment_year'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('installment_year') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-danger btn-lg" style="width: 100%;">Calculate</button>
                    </div>
            </form>
        </div>
    </div>

    <div class="form-group">
        <a class="btn btn-secondary" href="{{ route('admin.commissions.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
@endsection

@section('styles')
    <link href="{{ mix('/css/pages/installment.css') }}" media="screen,projection" rel="stylesheet" type="text/css"/>
@endsection
