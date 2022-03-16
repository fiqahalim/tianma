@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item">{{ trans('cruds.order.fields.createOrder') }}</li>
            <li aria-current="page" class="breadcrumb-item active">
                {{ trans('global.customerDetails') }}
            </li>
        </ol>
    </nav>

    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.customer-details.update', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product, $searchCust[0]->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            @if(isset($searchCust))
                @foreach($searchCust as $customer)
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-target="#collapseOne" data-toggle="collapse">
                                <h2 class="mb-0">
                                    <button aria-controls="collapseOne" aria-expanded="true" class="btn" data-target="#collapseOne" data-toggle="collapse" type="button">
                                        <strong>PARTICULARS OF PURCHASER</strong>
                                    </button>
                                    <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
                                </h2>
                            </div>
                            <div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionExample" id="collapseOne">
                                <div class="card-body">
                                    @include('pages.customer.existing.purchaser')
                                    <hr>
                                    {{-- Address Details --}}
                                    @include('pages.customer.existing.address')
                                </div>
                            </div>
                        </div>

                        {{-- Intended User Details --}}
                        @include('pages.customer.existing.intended-user')

                        {{-- Payment Mode --}}
                        @include('pages.customer.existing.payment-mode')

                        {{-- Certificate Collection --}}
                        @include('pages.customer.existing.collection')
                    </div>
                @endforeach
            @endif

            <div class="form-group float-right">
                <a class="btn btn-default" href="{{ route('admin.search', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}">
                    {{ trans('global.back') }}
                </a>
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.proceed') }}
                </button>
            </div>
        </form>
    </div>
@endsection
