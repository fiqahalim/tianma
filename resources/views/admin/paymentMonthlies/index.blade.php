@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item">{{ trans('cruds.order.fields.orderList') }}</li>
            <li class="breadcrumb-item active" aria-current="page">Transaction List</li>
        </ol>
    </nav>

    <div class="container mb-3">
        @if(isset($order->commissions) && !empty($order->commissions))
            <div class="row mt-3 justify-content-end">
                <a class="btn btn-info" href="{{ route('admin.transaction.index', [$order->id]) }}" data-toggle="modal" data-target="#invoiceDetailsModal">
                    Update Payment
                </a>
            </div>
        @else
        @endif
    </div>

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
                <h5><strong><u>TRANSACTION DETAILS</u></strong></h5>
            </div>
            <div class="col"></div>
        </div>

        <div class="page-header text-blue-d2 justify-content-end">
            {{-- <h5 class="text-secondary-d1 ml-3">
                Transaction No: <strong></strong>
            </h5> --}}
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95 print-window" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row ml-3">
                        <div class="col-sm-6">
                            <div class="text-dark-m2">
                                <div class="my-1">
                                    <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;">
                                        {{ Str::upper($order->customer->full_name) }} <br>
                                        {{ $order->customer->id_number }} <br>
                                        {{ Str::upper($order->customer->address_1) }} <br>
                                        @if(isset($order->customer->address_2) && !empty($order->customer->address_2))
                                            {{ Str::upper($order->customer->address_2) }} <br>
                                        @endif
                                        {{ Str::upper($order->customer->postcode) }}
                                        {{ Str::upper($order->customer->city) }}
                                        {{ Str::upper($order->customer->state) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- order details --}}
                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-dark-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Order Details
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Ref No:</span> #{{ $order->ref_no }}</div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{ trans('cruds.order.fields.order_date') }}:</span> {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-PaymentMonthly">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr class="table-dark">
                                        <th></th>
                                        <th>Transaction Date</th>
                                        <th>Paid Amount (RM)</th>
                                        <th>Status</th>
                                        <th>Remaining Installment (months)</th>
                                        <th>Outstanding Balance</th>
                                    </tr>
                                </thead>
                                <tbody class="text-95 text-secondary-d3">
                                    @foreach($transactions as $transaction)
                                        <tr data-entry-id="{{ $transaction->id }}" id="query">
                                            <td></td>
                                            <td>
                                                {{ Carbon\Carbon::parse($transaction->transaction_date)->format('d/M/Y') }}
                                            </td>
                                            <td>
                                                @if($transaction->amount == 0)

                                                @else
                                                    RM{{ $transaction->amount ?? '' }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $transaction->status ?? '' }}
                                            </td>
                                            <td>
                                                {{ $transaction->installment_balance ?? '' }}
                                            </td>
                                            <td>
                                                RM {{ $transaction->balance ?? '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <small>This is a computer generated statement. No signature is required.</small>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-3">
            <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>

    {{-- modal --}}
    @include('admin.paymentMonthlies.components.invoice-modal')

@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/invoice.css') }}"  media="screen,projection"/>
    <link href="{{ mix('/css/pages/invoice.css') }}" rel="stylesheet" media="print" type="text/css">
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        $.extend(true, $.fn.dataTable.defaults, {
            // orderCellsTop: true,
            order: [[ 1, 'asc' ]],
            pageLength: 10,
        });

        let table = $('.datatable-PaymentMonthly:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>

<script>
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
