@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Customers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $customers }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Orders (Monthly)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $myOrders }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                My Earnings (Monthly)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                RM {{ $myEarnings }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300">
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
                                <tr>
                                    <th></th>
                                    <th>
                                        {{ trans('cruds.order.fields.id') }}
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
                                        {{ trans('cruds.order.fields.order_date') }}
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
                                    <tr data-entry-id="{{ $order->id }}">
                                        <td></td>
                                        <td>
                                            {{ $key+1 }}
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
                                            {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $order->approved ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $order->approved ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $order->customer->full_name ?? '' }}
                                        </td>
                                        <td>
                                            @if($order->approved == 1)
                                                {{ $order->mo_overriding_comm ?? '' }}
                                            @else
                                                Only display when order approved
                                            @endif
                                        </td>
                                    </tr>
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
