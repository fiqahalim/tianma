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
                                        <i class="fa fa-check text-muted">
                                        </i>
                                        Payment Option:
                                        <span class="badge bg-warning text-white" style="font-size:8pt;">
                                            {{ strtoupper($order->payment_option) }}
                                        </span>
                                    </small>
                                    <small class="mt-2">
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
                                        Please make your payment before
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    {{ Carbon\Carbon::parse($order->expiry_date)->format('d/M/Y g:i A') }}
                                    <span id="counter" style="color:blue;font-weight:bold"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span class="font-weight-bold">
                                            Product Selling Price
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 d-flex justify-content-center align-items-center">
                                        <span>
                                            RM {{ $reservedLot->selling ?? '' }}
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
                                        <span>
                                            RM {{ $reservedLot->maintenance ?? '' }}
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
                                        <span>
                                            RM {{ $reservedLot->promo ?? '' }}
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
                                            RM {{ $reservedLot->price ?? '' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{session()->forget('customer')}}
{{session()->forget('products')}}
{{session()->forget('reservedLot')}}
{{session()->forget('order')}}
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/order.css') }}"  media="screen,projection"/>
@endsection

@section('scripts')
    <script>
        <?php
           $dateTime = strtotime($order->expiry_date);
           $getDateTime = date("F d, Y H:i:s", $dateTime);
        ?>
        var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            var now = new Date().getTime();
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="counter"11
            document.getElementById("counter").innerHTML = days + "Day : " + hours + "h " +
            minutes + "m " + seconds + "s ";
            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("counter").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endsection
