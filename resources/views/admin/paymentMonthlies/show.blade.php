@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.order.title') }}</li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row text-right">
        <div class="col-lg-12">
            <div class="page-tools">
                <div class="action-buttons">
                    {{-- <a class="btn btn-primary mx-1px text-95" href="#">
                        Tax Invoice
                    </a> --}}
                    <a class="btn bg-white btn-light mx-1px text-95 print-window" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                {{-- {{ dd($transactions) }} --}}
                <div class="page-content container" style="background: white;">
                    <div class="row">
                        <div class="col-4 text-center">
                            <figure class="figure">
                                <img src="{{ '/images/tianma_logo_op-01a.png' }}" class="figure-img img-fluid rounded mt-2" style="height: 125px; width: 13rem;">
                            </figure>
                        </div>
                        <div class="col-8 mt-4">
                            <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;">
                                <strong>TIANMA MEMORIAL HOLDINGS BERHAD</strong>
                                <small><b>202101043182 (1443482 A)</b></small><br>
                                Corporate Tower, Level 5, Jalan Pahat L 15/L, Section 15,<br>
                                40200 Shah Alam , Selangor<br>
                                Tel : 010-951 3688 &nbsp;&nbsp; Website : www.tianma.my
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-6 text-center">
                            <h4><strong><u>INSTALLMENT RECEIPT</u></strong></h4>
                        </div>
                        <div class="col"></div>
                    </div>

                    <div class="container">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-12">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="text-dark-m2">
                                            <div class="my-1">
                                                <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;">
                                                    {{ Str::upper($transaction->customer->full_name) }} <br>
                                                    {{ $transaction->customer->id_number }} <br>
                                                    {{ Str::upper($transaction->customer->address_1) }} <br>
                                                    @if(isset($transaction->customer->address_2) && !empty($transaction->customer->address_2))
                                                        {{ Str::upper($transaction->customer->address_2) }} <br>
                                                    @endif
                                                    {{ Str::upper($transaction->customer->postcode) }}
                                                    {{ Str::upper($transaction->customer->city) }}
                                                    {{ Str::upper($transaction->customer->state) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 justify-content-end">
                                        <div class="text-dark">
                                            <div>
                                                @php
                                                    $getUnitNo = isset($transaction->orders->bookLocations) ? $transaction->orders->bookLocations : '';
                                                    foreach($getUnitNo as $unit) {
                                                        $bookLots = $unit->lotBookings->seats;
                                                        $unitNo = implode(", ", $bookLots);
                                                    }
                                                @endphp
                                                <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;" class="alignMe">
                                                    <b>RECEIPT NO</b><br>
                                                    <b>ORDER ID</b> #{{ $transaction->orders->ref_no ?? '' }} <br>
                                                    <b>INVOICE NO</b> <br>
                                                    <b>UNIT NUMBER</b> {{ $unitNo }}<br>
                                                    <b>DATE</b> {{ Carbon\Carbon::parse($transaction->orders->created_at)->format('d/m/Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-0 border-b-2 brc-default-l1">
                                            <thead class="bg-none bgc-default-tp1">
                                                <tr class="text-white">
                                                    <th>Item</th>
                                                    <th>Description 1</th>
                                                    <th>Description 2</th>
                                                    <th>Payment Mode</th>
                                                    <th>Payment</th>
                                                    <th>Balance</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $payments = isset($transaction->orders->customer->payments) ? $transaction->orders->customer->payments : '';
                                                foreach($payments as $pay) {
                                                    $payName = $pay->payment_name;
                                                    $payment_name = implode(", ", $payName);
                                                }
                                            @endphp
                                            <tbody class="text-95 text-secondary-d3">
                                                <tr >
                                                    <td>1</td>
                                                    <td>
                                                        {{ Str::upper($transaction->orders->products->product_name) }}
                                                    </td>
                                                    <td>
                                                        {{ Str::upper($transaction->customer->mode) }}
                                                    </td>
                                                    <td>
                                                        {{ Str::upper($payment_name ?? '') }}
                                                    </td>
                                                    <td>
                                                        @if($transaction->amount == 0)
                                                            {{ $transaction->installments->downpayment }}
                                                        @else
                                                            {{ $transaction->amount ?? '' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $transaction->balance ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                        @if($transaction->amount == 0)
                                                            RINGGIT MALAYSIA {{ Str::upper($amountFormat) }} ONLY
                                                        @else
                                                            RINGGIT MALAYSIA {{ Str::upper($amountFormat) }} ONLY
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-5">
                                        <p>
                                            This Official Receipt is valid upon clearance of the cheque/credit card/debit card/MPOS payment.<br>This is a system generated document. No signature is required.
                                        </p>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-2">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/invoice.css') }}"  media="screen,projection"/>
    <link href="{{ mix('/css/pages/invoice.css') }}" rel="stylesheet" media="print" type="text/css">
@endsection

@section('scripts')
<script>
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
