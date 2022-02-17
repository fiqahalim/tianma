@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{ trans('global.products.title') }}
        </li>
        <li class="breadcrumb-item">
            {{ trans('global.products.title') }}
        </li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.products.title') }}
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
                            </div>

                            <button class="btn btn-outline-info btn-block order-button">
                                <i class="fas fa-home-alt"></i> Go to Dashboard
                            </button>

                        </div>
                    </div>
                    <div class="col-md-6 background-muted">
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-calendar-check"></i>
                                    {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                </span>
                                <span>
                                    <i class="fa fa-clock-o text-muted">
                                    </i>
                                    {{ Carbon\Carbon::parse($order->created_at)->format('h:i:s') }}
                                </span>
                            </div>
                            <div class="mt-3">
                                <h6 class="mb-0">
                                    Order Reference Number: #{{ $order->ref_no }}
                                </h6>
                                <span class="d-block mb-0">
                                    Includes: Sketch, PSD, PNG, SVG, AI
                                </span>
                                <small>
                                    Order Status: {{ $order->ref_no }}
                                </small>
                                <div class="d-flex flex-column mt-3">
                                    <small>
                                        <i class="fa fa-check text-muted">
                                        </i>
                                        Agent Code:
                                    </small>
                                    <small>
                                        <i class="fa fa-check text-muted">
                                        </i>
                                        Payment Method: {{ $customer->mode }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6 border-right">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <span>
                                        x3
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <span>
                                        $20 per unit
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <span>
                                        Subtotal
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <span>
                                        $60
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <span>
                                        Processing fees
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <span>
                                        $1.80
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
                                        $61.80
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/order.css') }}"  media="screen,projection"/>
@endsection
