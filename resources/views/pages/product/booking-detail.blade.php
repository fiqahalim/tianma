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
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <h4 class="mt-5 text-center">Review Order</h4>
                <form method="POST" action="{{ route('user.order.details.store', [$product->categories->first()->parentCategory->name,
                        $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="my-3">Customer Information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="full_name">{{ trans('cruds.customer.fields.full_name') }}</label>
                                <input class="form-control" id="full_name" type="name" value="{{ old('full_name', $customer->full_name) }}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="id_type">{{ trans('cruds.customer.fields.id_type') }}</label>
                                <input class="form-control" id="id_type" type="text" value="{{ old('id_type', $customer->id_type) }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_number">{{ trans('cruds.customer.fields.id_number') }}</label>
                                <input class="form-control" id="id_number" type="text" value="{{ old('id_number', $customer->id_number) }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="contact_person_name">{{ trans('cruds.customer.fields.contact_person_name') }}</label>
                                <input class="form-control" id="contact_person_name" type="text" value="{{ old('contact_person_name', $customer->contact_person_name) }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact_person_no">{{ trans('cruds.customer.fields.contact_person_no') }}</label>
                                <input class="form-control" id="contact_person_no" type="text" value="{{ old('contact_person_no', $customer->contact_person_no) }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">{{ trans('cruds.customer.fields.email') }}</label>
                                <input class="form-control" id="email" type="text" value="{{ old('email', $customer->email) }}" readonly>
                            </div>
                        </div>
                        <hr>

                        {{-- Product Info --}}
                        <h5 class="my-3">Product Information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="product_name">{{ trans('cruds.product.fields.product_name') }}</label>
                                <input class="form-control" id="product_name" type="text" value="{{ $product->product_name }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_code">{{ trans('cruds.product.fields.product_code') }}</label>
                                <input class="form-control" id="product_code" type="text" value="{{ $product->product_code }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="price">{{ trans('cruds.product.fields.price') }}</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    RM
                                </div>
                                <input class="form-control" id="price" type="text" value="{{ $product->price }}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="maintenance_price">{{ trans('cruds.product.fields.maintenance_price') }}</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    RM
                                </div>
                                <input class="form-control" id="maintenance_price" type="text" value="{{ $product->maintenance_price }}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="point_value">{{ trans('cruds.product.fields.point_value') }}</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <input class="form-control" id="point_value" type="text" value="{{ $product->point_value }}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="total_cost">{{ trans('cruds.product.fields.total_cost') }}</label>
                                <div class="input-group">
                                <div class="input-group-text">
                                    RM
                                </div>
                                <input class="form-control" id="total_cost" type="text" value="{{ $product->total_cost }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>

                        {{-- Billing Info --}}
                        <h5 class="my-3">Billing Information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address_1">{{ trans('cruds.customer.fields.address_1') }}</label>
                                <input class="form-control" id="address_1" type="text" value="{{ old('address_1', $customer->address_1) }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address_2">{{ trans('cruds.customer.fields.address_2') }}</label>
                                <input class="form-control" id="address_2" type="text" value="{{ old('address_2', $customer->address_2) }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="city">{{ trans('cruds.customer.fields.city') }}</label>
                                <input class="form-control" id="city" type="text" value="{{ old('city', $customer->city) }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">{{ trans('cruds.customer.fields.state') }}</label>
                                <input class="form-control" id="state" type="text" value="{{ old('state', $customer->state) }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="postcode">{{ trans('cruds.customer.fields.postcode') }}</label>
                                <input class="form-control" id="postcode" type="text" value="{{ old('postcode', $customer->postcode) }}" readonly>
                            </div>
                        </div>
                        <hr>

                        {{-- Payment Info --}}
                        <h5 class="my-3">Payment Information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="mode">{{ trans('cruds.customer.fields.mode') }}</label>
                                <input class="form-control" id="mode" type="text" value="{{ old('mode', $customer->mode) }}" readonly>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label class="font-weight-bold required" for="agent_code">
                                    Referral {{ trans('global.register.agent_code') }}
                                </label>
                                @foreach($users as $user)
                                    <input class="form-control" id="created_by" type="text" value="{{ $users->agent_code }}" readonly>
                                @endforeach
                            </div> --}}
                        </div>
                    </div>

                    <button class="btn btn-primary float-right mb-3 mr-3" type="submit">
                        {{ trans('global.confirmBooking') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
