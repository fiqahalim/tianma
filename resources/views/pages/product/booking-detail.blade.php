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

    <div style="margin-bottom: 10px;" class="row text-right mr-2">
        <div class="col-lg-12">
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95 print-window" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </div>

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
                            {{-- Purchaser Info --}}
                            @include('pages.product.includes.purchaser-info')

                            {{-- Intended User Details --}}
                            @include('pages.product.includes.intended-info')

                            {{-- Product Info --}}
                            @include('pages.product.includes.product-info')

                            {{-- Reservation Information --}}
                            @include('pages.product.includes.reservation-info')

                            {{-- Payment Information --}}
                            @include('pages.product.includes.payment-info')
                        </div>

                        @if($customer->mode == 'Installment')
                            <a class="btn btn-primary float-right mb-3 mr-3 text-white" id="installment" data-toggle="modal" data-target="#paymentOptionModal">
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

    {{-- include modal for payment option --}}
    @include('pages.includes.payment-option')
@endsection

@section('styles')
@parent
@endsection

@section('scripts')
@parent
<script>
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
