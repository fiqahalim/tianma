@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">
                Pay Later Calculator
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
                        <input class="form-control" id="point_value" type="text" value="{{ $order->lotID->point_value }}" readonly>
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
            Installment Calculator
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.calculatePayLater', $order->id) }}" enctype="multipart/form-data" id="installment-form">
                @csrf
                <input type="hidden" id="monthly_installment" name="monthly_installment" value="{{ old('monthly_installment', '') }}" />
                <input type="hidden" id="outstanding_balance" name="outstanding_balance" value="{{ old('outstanding_balance', '') }}" />
                <input type="hidden" id="last_month_payment" name="last_month_payment" value="{{ old('last_month_payment', '') }}" />

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="amount">Product Price</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i>RM</i>
                                </span>
                            </div>
                            <input class="form-control" type="text" name="amount" id="amount" value="{{ old('amount', isset($order) ?? $order->amount) }}" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="downpayment">Downpayment</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i>RM</i>
                                </span>
                            </div>
                            <input class="form-control" type="text" name="downpayment" id="downpayment" value="{{ old('downpayment', isset($installments) ?? $installments->downpayment) }}" required>
                            @if($errors->has('downpayment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('downpayment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="installment_year">Installment Period</label>
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="installment_year" id="installment_year" value="{{ old('installment_year', isset($installments) ?? $installments->installment_year) }}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Month(s)
                                </span>
                            </div>
                            @if($errors->has('downpayment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('downpayment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                        <span class="help-block">{{ trans('cruds.order.fields.ref_no_helper') }}</span>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" id="calculateBtn" class="btn btn-danger btn-lg" style="width: 100%;">Calculate</button>
                </div>

                <div class="row justify-content-around">
                    <div class="col-sm-4 col-md-5 col-lg-4 mt-2 mb-2">
                        <div class="card-1">
                            <p id="monthly_installment" name="monthly_installment" style="font-size:180%;">
                                RM {{ isset($installments) ?? $installments->monthly_installment }}
                            </p>
                            <h>Monthly Installments</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-5 col-lg-4 mt-2 mb-2">
                        <div class="card-2">
                            <p id="last_month_payment" name="last_month_payment" style="font-size:180%;">
                                RM {{ isset($installments) ?? $installments->last_month_payment }}
                            </p>
                            <h>Last Month Installments</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-5 col-lg-4 mt-2">
                        <div class="card-3">
                            <p id="outstanding_balance" name="outstanding_balance" style="font-size:180%;">
                                RM {{ isset($installments) ?? $installments->outstanding_balance }}
                            </p>
                            <p>Outstanding Payments</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row ml-2">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ mix('/css/pages/installment.css') }}" media="screen,projection" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/installment.js') }}"></script>
@endsection
