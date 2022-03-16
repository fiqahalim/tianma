@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                {{ trans('global.products.title') }}
            </li>
            <li class="breadcrumb-item">
                {{ trans('global.products.bookingLot') }}
            </li>
            <li aria-current="page" class="breadcrumb-item active">
                {{ trans('global.customerDetails') }}
            </li>
        </ol>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('admin.searchCustomer', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                  <label class="sr-only" for="inlineFormInputGroup"></label>
                                  <div class="input-group mb-2 mb-sm-0">
                                    <input type="search" class="form-control" id="inlineFormInputGroup" placeholder="Please enter last 4 digits purchaser ID / Passport number" name="query">
                                  </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <button type="submit" class="btn btn-primary">Search Purchaser</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
