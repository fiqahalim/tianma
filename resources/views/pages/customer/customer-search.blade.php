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
        <form action="{{ route('admin.searchCustomer', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}" method="POST">
            @csrf
            <div class="form-row align-items-center mb-4">
                <div class="col-md-6">
                  <label class="sr-only" for="inlineFormInputGroup"></label>
                  <div class="input-group mb-2 mb-sm-0">
                    <input type="search" class="form-control" id="inlineFormInputGroup" placeholder="Please enter ID / Passport number" name="query">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-2 mb-sm-0">
                        <button type="submit" class="btn btn-primary">Search Customer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
