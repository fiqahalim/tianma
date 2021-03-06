@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            My {{ trans('cruds.order.title_singular') }}s
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.order.title_singular') }}s {{ trans('global.list') }}
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
                        <th>Unit No.</th>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <th>Product Price</th>
                        <th>
                            {{ trans('cruds.customer.fields.mode') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myOrders as $key => $order)
                        @php
                            $getUnitNo = isset($order->lotID->seats) ? $order->lotID->seats : '';
                            $unitNo = implode(" ",$getUnitNo);
                            $extractData = explode(",",$unitNo);
                        @endphp
                    @if(!empty($order->approved) && $order->approved == 1)
                        <tr data-entry-id="{{ $order->id }}">
                            <td></td>
                            <td>{{ $order->id }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s') }}
                            </td>
                            <td>
                                #{{ $order->ref_no ?? '' }}
                            </td>
                            <td>{{ $extractData[0] ?? '' }}</td>
                            <td>
                                {{ $order->customer->full_name ?? '' }}
                            </td>
                            <td>RM{{ number_format($order->amount ?? '0') }}</td>
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
                                <a class="btn btn-xs btn-primary" href="{{ route('user.my-orders.show', $order->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
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
@endsection
