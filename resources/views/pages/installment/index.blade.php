@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.new-order.index') }}">
                    {{ trans('global.products.title') }}
                </a>
            </li>
            <li class="breadcrumb-item">
                {{ trans('global.products_view') }}
            </li>
            <li class="breadcrumb-item">
                {{ $products->product_name }}
            </li>
            <li aria-current="page" class="breadcrumb-item active">
                Installment Calculator
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            Installment Calculator
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.installment.store', [$products->categories->first()->parentCategory->name, $products->categories->first()->parentCategory->name, $products->categories->first()->name, $products]) }}" enctype="multipart/form-data" id="installment-form">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="amount">Product Price</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i>RM</i>
                                </span>
                            </div>
                            <input class="form-control" type="text" name="amount" id="amount" value="{{ old('amount', '') }}" required>
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
                            <input class="form-control" type="text" name="downpayment" id="downpayment" value="{{ old('downpayment', '') }}" required>
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
                            <input class="form-control" type="text" name="installment_year" id="installment_year" value="{{ old('installment_year', '') }}" required>
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
                    <button type="submit" class="btn btn-danger btn-lg calculate-btn" style="width: 100%;">Calculate</button>
                </div>

                <div class="row justify-content-around">
                    <div class="col-sm-6 col-md-5 col-lg-6 mt-2 mb-2">
                        <div class="card-1">
                            <p id="monthly_installment" name="monthly_installment">RM</p>
                            <input id="monthly_installment" name="monthly_installment" type="hidden" value="{{ old('monthly_installment') }}">
                            <h>Monthly Installments</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-6 mt-2">
                        <div class="card-3">
                            <p id="outstanding_balance" name="outstanding_balance">RM</p>
                            <input id="outstanding_balance" name="outstanding_balance" type="hidden" value="{{ old('outstanding_balance') }}">
                            <p>Outstanding Payments</p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-group float-right">
                        <a class="btn btn-primary btn-sm mt-4 mb-2 mr-3" href="{{ route('admin.order', [$products->categories->first()->parentCategory->name, $products->categories->first()->parentCategory->name, $products->categories->first()->name, $products]) }}">
                            {{ trans('global.proceed') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ mix('/css/pages/installment.css') }}" media="screen,projection" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/installment.js') }}"></script>
@endsection
