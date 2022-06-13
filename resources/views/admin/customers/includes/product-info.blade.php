@php
    $getUnitNo = isset($order->lotID) ? $order->lotID->seats : '';
    $unitNo = implode(" ",$getUnitNo);
@endphp

<h5 class="my-3 mt-4">PRODUCT PRICE INFORMATION</h5>
<div class="form-row">
    <div class="form-group col-md-2">
        <label for="product_code">{{ trans('cruds.product.fields.product_code') }}</label>
        <input class="form-control" id="product_code" type="text" value="{{ $unitNo }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="price">{{ trans('cruds.product.fields.price') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                RM
            </div>
            <input class="form-control" id="price" type="text" value="{{ $order->lotID->price }}" readonly>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="maintenance_price">{{ trans('cruds.product.fields.maintenance_price') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                RM
            </div>
            <input class="form-control" id="maintenance_price" type="text" value="{{ $order->lotID->maintenance }}" readonly>
        </div>
    </div>
    <div class="form-group col-md-2">
        <label for="promotion_price">{{ trans('cruds.product.fields.promotion_price') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                RM
            </div>
            <input class="form-control" id="promotion_price" type="text" value="{{ $order->lotID->promo }}" readonly>
        </div>
    </div>
    <div class="form-group col-md-2">
        <label for="point_value">{{ trans('cruds.product.fields.point_value') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                <i class="fas fa-calculator"></i>
            </div>
            <input class="form-control" id="point_value" type="text" value="{{ $order->lotID->point_value }}" readonly>
        </div>
    </div>
</div>
<hr>
