@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.order.fields.orderList') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>{{ trans('cruds.order.fields.id') }}</th>
                        <th>
                            {{ trans('cruds.order.fields.order_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.ref_no') }}
                        </th>
                        <th>
                            Product {{ trans('cruds.order.fields.amount') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.order.fields.order_status') }}
                        </th> --}}
                        {{-- <th>
                            Payment Option
                        </th> --}}
                        <th>
                            {{ trans('cruds.order.fields.approved') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.created_by') }}
                        </th>
                        <th>
                            Payment Mode
                        </th>
                        <th>
                            Time Left to Pay
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                        <tr data-entry-id="{{ $order->id }}">
                            <td></td>
                            <td>{{ $order->id }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s') }}
                            </td>
                            <td>
                                #{{ $order->ref_no ?? '' }}
                            </td>
                            <td>
                                {{ $order->amount ?? '' }}
                            </td>
                            {{-- <td>
                                {{ $order->order_status ?? '' }}
                            </td> --}}
                            {{-- <td>
                                {{ strtoupper($order->payment_option ?? '') }}
                            </td> --}}
                            <td>
                                <span style="display:none">{{ $order->approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $order->approved ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $order->customer->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $order->createdBy->agent_code ?? '' }}
                            </td>
                            <td>
                                @if($order->customer->mode == 'Installment')
                                    <span class="badge bg-success text-white">
                                        {{ $order->customer->mode ?? '' }}
                                    </span>
                                @else
                                    <span class="badge bg-primary text-white">
                                        {{ $order->customer->mode ?? '' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($order->customer->mode == 'Installment')
                                    @if($order->order_status == 'Rejected')
                                        <span class="badge bg-warning">
                                            Rejected Order
                                        </span>
                                    @elseif($order->payment_option == 'PAY LATER' && $order->amount == 0)
                                        <span id="counter" style="color:blue;font-weight:bold"></span><br>
                                        {{ Carbon\Carbon::parse($order->expiry_date)->format('d/M/Y H:i:s') }}
                                    @else
                                    @endif
                                @endif
                            </td>
                            <td>
                                @can('order_show')
                                    @if($order->amount > 0 || $order->customer->mode == 'Full Payment')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                @endcan

                                @can('order_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan

                                @can('order_delete')
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                            <td>
                                @if($order->customer->mode == 'Installment')
                                    @if($order->order_status == 'Rejected')
                                    @elseif($order->payment_option == 'PAY LATER' && $order->amount == 0)
                                        <a class="btn btn-warning text-white" href="{{ route('admin.orders.showCalculator', $order->id) }}">
                                            <small>PAY NOW</small>
                                        </a>
                                    @else
                                        @if($order->order_status != 'Rejected')
                                            <a class="btn btn-dark" href="{{ route('admin.transaction.index', $order->id) }}">
                                                <small>Update<br>Installment</small>
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('order_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.orders.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }
                        })
                        .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            columnDefs: [{
                targets: 0,
            },
            {
                targets: 1,
                visible: false
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
            $order = date('Y-m-d',strtotime("31-07-2016"));
            $dateTime = strtotime(isset($order)) ?? $order->expiry_date;
            $getDateTime = date("F d, Y H:i:s", $dateTime);
        ?>
        var payLater = {!! $order !!}
        console.log(payLater);
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
                document.getElementById("counter").innerHTML = "";
            }
        }, 1000);
    </script>
@endsection
