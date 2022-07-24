@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">Edit {{ trans('cruds.order.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <h5>Order Details</h5>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="required" for="ref_no">{{ trans('cruds.order.fields.ref_no') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>#</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('ref_no') ? 'is-invalid' : '' }}" type="text" name="ref_no" id="ref_no" value="{{ old('ref_no', $order->ref_no) }}" readonly>
                        @if($errors->has('ref_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ref_no') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.ref_no_helper') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="amount">{{ trans('cruds.order.fields.amount') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $order->amount) }}" step="0.01" readonly>
                        @if($errors->has('amount'))
                            <div class="invalid-feedback">
                                {{ $errors->first('amount') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>{{ trans('cruds.order.fields.order_status') }}</label>
                    <select class="form-control {{ $errors->has('order_status') ? 'is-invalid' : '' }}" name="order_status" id="order_status">
                        <option value disabled {{ old('order_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Order::ORDER_STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('order_status', $order->order_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('order_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('order_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.order.fields.order_status_helper') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="point_value">{{ trans('cruds.product.fields.point_value') }}</label>
                    <input class="form-control" type="text" value="{{ $order->commissions ? $order->commissions->point_value : '' }}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label>{{ trans('cruds.commission.fields.comm_per_order') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $order->commissions ? $order->commissions->mo_overriding_comm : '' }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>Agent Code</label>
                    <input class="form-control" type="text" value="{{ $order->createdBy ? $order->createdBy->agent_code : '' }}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label>{{ trans('cruds.order.fields.order_date') }}</label>
                    <input class="form-control" type="text" value="{{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s') }}" readonly>
                </div>
            </div>
            <hr>

            {{-- Product Details --}}
            <h5>Product Details</h5>
            @php
                $getUnitNo = isset($order->lotID) ? $order->lotID->seats : '';
                $unitNo = implode(" ",$getUnitNo);
            @endphp
            <div class="form-row mt-3 mb-3">
                <div class="form-group col-md-4">
                    <label for="product_code">{{ trans('cruds.product.fields.product_code') }}</label>
                    <input class="form-control" type="text" value="{{ $unitNo ? $unitNo : '' }}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="selling">Selling {{ trans('cruds.product.fields.price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $order->lotID ? $order->lotID->selling : '' }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="maintenance_price">{{ trans('cruds.product.fields.maintenance_price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $order->lotID ? $order->lotID->maintenance : '' }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="promotion_price">{{ trans('cruds.product.fields.promotion_price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $order->lotID ? $order->lotID->promo : '' }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="price">Product Price (After Promo)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $order->lotID ? $order->lotID->price : '' }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="point_value">Point Value</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>PV</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $order->lotID ? $order->lotID->point_value : '' }}" readonly>
                    </div>
                </div>
                @if(isset($order->customer->promotions) && $order->customer->promotions != null)
                    <div class="form-group col-md-3">
                        <label for="promotion_price">Promotion Code</label>
                        <input class="form-control" type="text" value="{{ $order->customer->promotions ? $order->customer->promotions->promo_code : '' }}" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="promotion_price">Promotion Code Discount</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i>RM</i>
                                </span>
                            </div>
                            <input class="form-control" type="text" value="{{ $order->discount_price ? $order->discount_price : '' }}">
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group pl-2">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $order->approved || old('approved', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label pl-2" for="approved">{{ trans('cruds.order.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.approved_helper') }}</span>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
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
