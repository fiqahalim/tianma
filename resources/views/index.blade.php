@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route("user.myCustomers") }}">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Customers
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $customers }}
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route("user.my-orders.index") }}">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Orders (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $myOrders }}
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route('user.myCommission') }}">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Commissions (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    RM {{ $myEarnings }}
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route('user.my-orders.index') }}">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Pay Later's Order
                                </div>
                                @foreach($payLaters as $key => $payLater)
                                @if($payLater->order_status == 'Rejected')
                                @elseif($payLater->payment_option == 'PAY LATER' && $payLater->amount == 0)
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <span id="counter" style="color:blue;font-weight:bold"></span>
                                    </div>
                                @else
                                @endif
                                @endforeach
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transaction Logs --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header font-weight-bold">
                    {{ trans('global.transaction_log') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-Order">
                            <thead>
                                <tr class="table-info">
                                    <th></th>
                                    <th>{{ trans('cruds.order.fields.id') }}</th>
                                    <th>
                                        {{ trans('cruds.order.fields.order_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.ref_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.order_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.approved') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.customer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.commissions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agentComms as $key => $order)
                                    @if($order->mo_overriding_comm > 0)
                                        <tr data-entry-id="{{ $order->id }}">
                                            <td></td>
                                            <td>{{  $order->id }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s') }}
                                            </td>
                                            <td>
                                                #{{ $order->ref_no ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->amount ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->order_status ?? '' }}
                                            </td>
                                            <td>
                                                <span style="display:none">{{ $order->approved ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $order->approved ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                {{ $order->customer->full_name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->mo_overriding_comm ?? '' }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                columnDefs: [{
                    targets: 0,
                },
                {
                    targets: 1,
                    visible: false,
                }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            });

            let table = $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        })
    </script>
    <script>
        <?php
           $dateTime = isset($payLater->expiry_date) ? strtotime($payLater->expiry_date) : null;
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
