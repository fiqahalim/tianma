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
                Installment
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
                            <input class="form-control" type="text" name="amount" id="amount" required>
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
                            <input class="form-control" type="text" name="downpayment" id="downpayment" value="" required>
                            @if($errors->has('downpayment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('downpayment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="period">Installment Period (Years)</label>
                        <input class="form-control" type="text" name="period" id="period" value="" required>
                        @if($errors->has('period'))
                            <div class="invalid-feedback">
                                {{ $errors->first('period') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.ref_no_helper') }}</span>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-danger btn-lg calculate-btn" style="width: 100%;">Calculate</button>
                </div>

                <div class="results mt-5">
                    <div class="card-1">
                        <p id="installment" name="installment">RM</p>
                        <p class="indicators">Monthly Installments</p>
                    </div>

                    <div class="card-3">
                        <p id="balance" name="balance">RM</p>
                        <p class="indicators">Outstanding Payments</p>
                    </div>
                </div>

                <div class="text-center">
                <div class="form-group float-right">
                    <a class="btn btn-primary btn-sm mb-3 mr-3" href="{{ route('admin.order', [$products->categories->first()->parentCategory->name, $products->categories->first()->parentCategory->name, $products->categories->first()->name, $products]) }}">
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