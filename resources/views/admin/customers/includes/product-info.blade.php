<h5 class="my-3 mt-4">PRODUCT PRICE INFORMATION</h5>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="product_name">{{ trans('cruds.product.fields.product_name') }}</label>
        <input class="form-control" id="product_name" type="text" value="{{ $order->products->product_name }}" readonly>
    </div>
    <div class="form-group col-md-6">
        <label for="product_code">{{ trans('cruds.product.fields.product_code') }}</label>
        <input class="form-control" id="product_code" type="text" value="{{ $order->products->product_code }}" readonly>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="price">{{ trans('cruds.product.fields.price') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                RM
            </div>
            <input class="form-control" id="price" type="text" value="{{ $order->products->price }}" readonly>
        </div>
    </div>
    <div class="form-group col-md-2">
        <label for="maintenance_price">{{ trans('cruds.product.fields.maintenance_price') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                RM
            </div>
            <input class="form-control" id="maintenance_price" type="text" value="{{ $order->products->maintenance_price }}" readonly>
        </div>
    </div>
    <div class="form-group col-md-2">
        <label for="point_value">{{ trans('cruds.product.fields.point_value') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                <i class="fas fa-calculator"></i>
            </div>
            <input class="form-control" id="point_value" type="text" value="{{ $order->products->point_value }}" readonly>
        </div>
    </div>
    <div class="form-group col-md-2">
        <label for="promotion_price">{{ trans('cruds.product.fields.promotion_price') }}</label>
        <div class="input-group">
            <div class="input-group-text">
                RM
            </div>
            <input class="form-control" id="promotion_price" type="text" value="{{ $order->products->promotion_price }}" readonly>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="total_cost">{{ trans('cruds.product.fields.total_cost') }}</label>
        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="includes maintenance fees, etc"></i>
        <div class="input-group">
            <div class="input-group-text">
                RM
            </div>
            <input class="form-control" id="total_cost" type="text" value="{{ $order->products->total_cost }}" readonly>
        </div>
    </div>
</div>
<hr>
