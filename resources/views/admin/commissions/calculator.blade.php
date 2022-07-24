@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
            <li class="breadcrumb-item">{{ $order->id }}</li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ trans('cruds.commission.title') }} Calculator
            </li>
        </ol>
    </nav>

    {{-- Product Details --}}
    <div class="card">
        <div class="card-header font-weight-bold">
            Product Details
        </div>

        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="selling">Selling Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" id="selling" type="text" value="{{ $order->lotID->selling }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="promo">Promotion Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" id="promo" type="text" value="{{ $order->lotID->promo }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="maintenance">Maintenance Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" id="maintenance" type="text" value="{{ $order->lotID->maintenance }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="price">Product Price (After Promo)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" id="price" type="text" value="{{ $order->lotID->price }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="point_value">Point Value</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>PV</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $order->lotID->point_value }}" readonly>
                    </div>
                </div>
                @php
                    $getUnitNo = isset($order->lotID->seats) ? $order->lotID->seats : '';
                    $unitNo = implode(" ",$getUnitNo);
                @endphp
                <div class="form-group col-md-4">
                    <label for="seats">Reservation Lot</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-home"></i>
                            </span>
                        </div>
                        <input class="form-control" id="seats" type="text" value="{{ $unitNo }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('cruds.commission.title') }} Calculator
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.commissions.calculatorStore", $order->id) }}" enctype="multipart/form-data" id="commission-form">
                @csrf

                <input type="hidden" id="point_value" name="point_value" value="{{ old('point_value', '') }}" />

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="pv">Point Value</label>
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="pv" id="pv" value="{{ old('pv', '')}}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i>PV</i>
                                </span>
                            </div>
                            @if($errors->has('pv'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pv') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="percentage">Percentage</label>
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="percentage" id="percentage" value="{{ old('percentage', '') }}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i>%</i>
                                </span>
                            </div>
                            @if($errors->has('percentage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('percentage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="first_month">1st Payment</label>
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="first_month" id="first_month" value="{{ old('first_month', '') }}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    only first month
                                </span>
                            </div>
                            @if($errors->has('first_month'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_month') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" id="calculateBtn" class="btn btn-danger btn-lg" style="width: 100%;">Calculate</button>
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

@section('scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/commission.js') }}"></script>
@endsection
