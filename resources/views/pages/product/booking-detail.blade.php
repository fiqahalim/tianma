@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('user.products.index') }}">
                {{ trans('global.products.title') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            {{ trans('global.products_view') }}
        </li>
        <li class="breadcrumb-item">
            {{ $product->product_name }}
        </li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.bookingDetails') }}
        </li>
    </ol>
</nav>

<div class="container-fluid">
    <form method="POST" action="{{ route('user.order.details.store', [$product->categories->first()->parentCategory->parentCategory->slug,
            $product->categories->first()->parentCategory->slug, $product->categories->first()->slug, $product->slug, $product]) }}" enctype="multipart/form-data">
        @csrf
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne" data-target="#collapseOne" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseOne" aria-expanded="true" class="btn" data-target="#collapseOne" data-toggle="collapse" type="button">
                            <strong>{{ trans('global.customerDetails') }}</strong>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionExample" id="collapseOne">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="full_name">Full Name</label>
                                <input class="form-control" id="full_name" type="name" value="{{ $customer->full_name }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_number">Id Number / Passport</label>
                                <input class="form-control" id="id_number" type="text" value="{{ $customer->id_number }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contact_person_name">Contact Person Name</label>
                                <input class="form-control" id="contact_person_name" type="text" value="{{ $customer->contact_person_name }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact_person_no">Contact Person Number</label>
                                <input class="form-control" id="contact_person_no" type="text" value="{{ $customer->contact_person_no }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address_1">Address 1</label>
                                <input class="form-control" id="address_1" type="text" value="{{ $customer->address_1 }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address_2">Address 2</label>
                                <input class="form-control" id="address_2" type="text" value="{{ $customer->address_2 }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="city">City</label>
                                <input class="form-control" id="city" type="text" value="{{ $customer->city }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">State</label>
                                <input class="form-control" id="state" type="text" value="{{ $customer->state }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="postcode">Postcode</label>
                                <input class="form-control" id="postcode" type="text" value="{{ $customer->postcode }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo" data-target="#collapseTwo" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseTwo" aria-expanded="false" class="btn collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">
                            <strong>{{ trans('global.products.productDetails') }}</strong>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="product_name">Product</label>
                                <input class="form-control" id="product_name" type="text" value="{{ $product->product_name }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_code">Product Code</label>
                                <input class="form-control" id="product_code" type="text" value="{{ $product->product_code }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="price">Product Price</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    RM
                                </div>
                                <input class="form-control" id="price" type="text" value="{{ $product->price }}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="maintenance_price">Maintenance Price</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    RM
                                </div>
                                <input class="form-control" id="maintenance_price" type="text" value="{{ $product->maintenance_price }}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="point_value">Point Value</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <input class="form-control" id="point_value" type="text" value="{{ $product->point_value }}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="total_cost">Total Product Cost</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    RM
                                </div>
                                <input class="form-control" id="total_cost" type="text" value="{{ $product->total_cost }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary text-right" type="submit">
            {{ trans('global.confirmBooking') }}
        </button>
    </form>
</div>
@endsection
