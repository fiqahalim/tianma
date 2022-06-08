@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{ trans('global.products.title') }}
        </li>
        <li class="breadcrumb-item">
            {{ trans('global.order.orderReview') }}
        </li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.order.orderConfirmation') }}
        </li>
    </ol>
</nav>

<div class="container mt-4 mb-4">
    <div class="row d-flex cart align-items-center justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="d-flex justify-content-center border-bottom">
                    <div class="p-3">
                        <div class="progresses">
                            <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                            <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                            <div class="steps"> <span class="font-weight-bold">3</span> </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-6 border-right p-5">
                        <div class="text-center order-details">
                            <div class="d-flex justify-content-center mb-5 flex-column align-items-center">
                                <span class="check1">
                                    <i class="fa fa-check">
                                    </i>
                                </span>
                                <span class="font-weight-bold">
                                    You have place the order successfully!
                                </span>
                                <small class="mt-2">
                                    Your order has been processed
                                </small>
                                {{-- <a href="{{ route('user.invoice') }}" target="_blank" class="text-decoration-none invoice-link">
                                    View Invoices
                                </a> --}}
                            </div>

                            <a href="{{ route("home.index") }}" class="btn btn-outline-info btn-block order-button">
                                <i class="fa fa-home"></i> Go to Dashboard
                            </a>

                        </div>
                    </div>
                    <div class="col-md-6 background-muted">
                        @php
                            $customer = session('customer');
                            $order = session('order');
                            $paymentInfo = session('paymentInfo');
                            $products = session('products');
                        @endphp
                        @if ($customer->mode == 'Full Payment')
                            <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-calendar-check"></i>
                                    {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y') }}
                                </span>
                                <span>
                                    <i class="fa fa-clock-o text-muted">
                                    </i>
                                    {{ Carbon\Carbon::parse($order->created_at)->format('H:i:s') }}
                                </span>
                            </div>
                            <div class="mt-3">
                                <h6 class="mb-0">
                                    Order Reference Number: #{{ $order->ref_no }}
                                </h6>
                                <span class="d-block mb-0">
                                    Customer Name: {{ Str::upper($customer->full_name) }}
                                </span>
                                <small>
                                    {{ trans('global.order.order_status') }}: {{ $order->order_status }}
                                </small>
                                <div class="d-flex flex-column mt-3">
                                    {{-- <small>
                                        <i class="fa fa-check text-muted">
                                        </i>
                                        Agent Code: {{ Auth::user()->agent_code }}
                                    </small> --}}
                                    <small>
                                        <i class="fa fa-check text-muted">
                                        </i>
                                        Payment Method: {{ Str::upper($customer->mode) }}
                                    </small>
                                </div>
                            </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            Product Price
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            RM
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            Maintenance Fees
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            RM
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            Promotion Price
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            RM
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            Total
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            RM
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fas fa-calendar-check"></i>
                                        {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y') }}
                                    </span>
                                    <span>
                                        <i class="fa fa-clock-o text-muted">
                                        </i>
                                        {{ Carbon\Carbon::parse($order->created_at)->format('H:i:s') }}
                                    </span>
                                </div>
                                <div class="mt-3">
                                    <h6 class="mb-0">
                                        Order Reference Number: #{{ $order->ref_no }}
                                    </h6>
                                    <span class="d-block mb-0">
                                        Customer Name: {{ Str::upper($customer->full_name) }}
                                    </span>
                                    <small>
                                        {{ trans('global.order.order_status') }}: {{ $order->order_status }}
                                    </small>
                                    <div class="d-flex flex-column mt-3">
                                        <small>
                                            <i class="fa fa-check text-muted"></i>
                                            Payment Option:
                                            <span class="badge bg-primary text-white" style="font-size:8pt;">
                                                {{ strtoupper($order->payment_option) }}
                                            </span>
                                        </small>
                                        <small>
                                            <i class="fa fa-check text-muted">
                                            </i>
                                            Payment Method: <b>{{ Str::upper($customer->mode) }}</b>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-0 border-bottom">
                                <div class="col-md-6 border-right">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            Total
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            RM {{ $order->amount }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 border-bottom">
                                <div class="col-md-6 border-right">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            Downpayment
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            RM {{ $paymentInfo->downpayment }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 border-bottom">
                                <div class="col-md-6 border-right">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            Installment Period
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            {{ $paymentInfo->installment_year }} <i>month(s)</i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 border-bottom">
                                <div class="col-md-6 border-right">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            Monthly Installment
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            RM {{ $paymentInfo->monthly_installment }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 border-bottom">
                                <div class="col-md-6 border-right">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            Last Month Installment
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            RM {{ $paymentInfo->last_month_payment }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            Outstanding Balance
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            RM {{ $paymentInfo->outstanding_balance }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{session()->forget('customer')}}
{{session()->forget('products')}}
{{session()->forget('paymentInfo')}}
{{session()->forget('order')}}
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/order.css') }}"  media="screen,projection"/>
@endsection
