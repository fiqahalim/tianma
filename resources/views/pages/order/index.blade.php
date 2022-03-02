@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{ trans('cruds.order.title') }}
        </li>
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
                    <tr class="table-info">
                        <th></th>
                        <th>
                            {{ trans('cruds.order.fields.order_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.ref_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
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
                    @if(!empty($order->approved) && $order->approved == 1)
                        <tr data-entry-id="{{ $order->id }}">
                            <td></td>
                            <td>
                                {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                #{{ $order->ref_no ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer->full_name ?? '' }}
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
