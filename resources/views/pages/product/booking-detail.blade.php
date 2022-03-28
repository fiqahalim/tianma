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
            {{ $product->product_name }}
        </li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.bookingDetails') }}
        </li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <h4 class="mt-5 text-center">Review Order</h4>

                @if($customer->mode == 'Installment')
                <form method="POST" action="{{ route('admin.installment.store', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}" enctype="multipart/form-data" id="review-order">
                @else
                <form method="POST" action="{{ route('admin.order.details.store', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}" enctype="multipart/form-data" id="review-order">
                @endif
                @csrf
                    <div class="card-body">
                        <h5 class="my-3">Purchaser Information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="full_name">{{ trans('cruds.customer.fields.full_name') }} as in NRIC/Passport</label>
                                <input class="form-control" id="full_name" type="name" value="{{ old('full_name', $customer->full_name) }}" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="id_number">{{ trans('cruds.customer.fields.id_number') }}</label>
                                <input class="form-control" id="id_number" type="text" value="{{ old('id_number', $customer->id_number) }}" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="gender">Gender</label>
                                <input class="form-control" id="gender" type="text" value="{{ old('gender', $customer->gender) }}" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="contact_person_no">Mobile</label>
                                <input class="form-control" id="contact_person_no" type="text" value="{{ old('contact_person_no', $customer->contact_person_no) }}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" type="text" value="{{ old('email', $customer->email) }}" readonly>
                            </div>
                        </div>
                        @if(isset($cust_details))
                            <div class="form-row row-cols-2">
                                <div class="col">
                                    <label><strong>Permanent Address</strong></label>
                                    <textarea class="form-control bg-white" readonly>{{Str::upper($cust_details['per_address']) ?? 'Not Available'}}</textarea>
                                </div>
                                <div class="col">
                                    <label><strong>Correspondence Address</strong></label>
                                    <textarea class="form-control bg-white" readonly>{{Str::upper($cust_details['cor_address']) ?? 'Not Available'}}</textarea>
                                </div>
                            </div>
                        @endif
                        <hr>

                        {{-- Intended User Details --}}
                        <h5 class="my-3">Intended User Information</h5>
                        <div class="form-row">
                            @if(isset($corAddr))
                                @forelse($corAddr as $v => $contactPerson)
                                    @forelse($contactPerson->contactPersons as $cp)
                                        <div class="form-group col-md-4">
                                            <label for="cperson_name">{{ trans('cruds.customer.fields.full_name') }}</label>
                                            <input class="form-control" id="cperson_name" type="name" value="{{ old('cperson_name', $cp->cperson_name) }}" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="cid_number">{{ trans('cruds.customer.fields.id_number') }}</label>
                                            <input class="form-control" id="cid_number" type="text" value="{{ old('cid_number', $cp->cid_number) }}" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="relationships">Relationships</label>
                                            <input class="form-control" id="relationships" type="text" value="{{ old('relationships', $cp->relationships) }}" readonly>
                                        </div>
                                    @empty
                                        <div class="form-group col-md-4">
                                            <span>
                                                <i>No information available</i>
                                            </span>
                                        </div>
                                    @endforelse
                                @empty
                                    <div class="form-group col-md-4">
                                        <span>
                                            <i>No information available</i>
                                        </span>
                                    </div>
                                @endforelse
                            @endif
                        </div>
                        <hr>

                        {{-- Product Info --}}
                        <h5 class="my-3">Purchase Price Information</h5>
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

                        {{-- Payment Information --}}
                        <div class="row">
                            <div class="col">
                                <h5 class="my-3">Payment Information</h5>
                            </div>
                            <div class="col">
                                <h5 class="my-3">Certificate Collection Information</h5>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <div class="form-row">
                                    @if(isset($corAddr))
                                        @foreach($corAddr as $items)
                                            @foreach($items->payments as $payment)
                                                <div class="form-group col-md-6">
                                                    <label for="mode">Payment Mode Type</label>
                                                    <input class="form-control" id="mode" type="text" value="{{ old('payment_name', $payment->payment_name['0']) }}" readonly>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @endif
                                    <div class="form-group col-md-6">
                                        <label for="mode">{{ trans('cruds.customer.fields.mode') }}</label>
                                        <input class="form-control" id="mode" type="text" value="{{ old('mode', $customer->mode) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="contact_person_name">Representative Name</label>
                                        <input class="form-control" id="contact_person_name" type="text" value="{{ old('contact_person_name', $customer->contact_person_name) }}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cperson_id_number">NRIC/Passport No.</label>
                                        <input class="form-control" id="cperson_id_number" type="text" value="{{ old('cperson_id_number', $customer->cperson_id_number) }}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mode">Contact No.</label>
                                        <input class="form-control" id="mode" type="text" value="{{ old('mode', $customer->contact_person_no) }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($customer->mode == 'Installment')
                        <a class="btn btn-primary float-right mb-3 mr-3" id="installment" href="{{ route('admin.installment.index', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}">
                            {{ trans('global.confirmBooking') }}
                        </a>
                    @else
                        <button class="btn btn-primary float-right mb-3 mr-3" type="submit" id="confirmBooking">
                            {{ trans('global.confirmBooking') }}
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
@parent
@endsection

@section('scripts')
@parent
@endsection
