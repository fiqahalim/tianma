@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route('admin.users.index') }}">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pending Agents Approval
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $agents }}
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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{ route("admin.orders.index") }}">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Order Approval
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $orders }}
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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
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

    {{-- Next Row --}}
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
                                    <th width="10">

                                    </th>
                                    {{-- <th>
                                        {{ trans('cruds.order.fields.id') }}
                                    </th> --}}
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
                                        {{ trans('cruds.order.fields.created_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.commissions') }} Per Order
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allOrders as $key => $order)
                                    @if(!empty($order->commissions) && $order->commissions->mo_overriding_comm > 0)
                                        <tr data-entry-id="{{ $order->id }}">
                                            <td>

                                            </td>
                                            {{-- <td>
                                                {{ $order->id ?? '' }}
                                            </td> --}}
                                            <td>
                                                {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') }}
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
                                                {{ $order->createdBy->agent_code ?? '' }}
                                            </td>
                                            <td>
                                                RM {{ $order->commissions->mo_overriding_comm ?? '' }}
                                            </td>
                                            <td>
                                                @can('order_edit')
                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                                        {{-- {{ trans('global.edit') }} --}}
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endcan
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
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

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
