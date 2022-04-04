@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item">{{ trans('cruds.order.fields.orderList') }}</li>
            <li class="breadcrumb-item active" aria-current="page">Transaction List</li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row text-right">
        <div class="col-lg-12">
            <a class="btn btn-info" href="{{ route('admin.transaction.index', [$order->id]) }}" data-toggle="modal" data-target="#invoiceDetailsModal">
                Update Payment
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            Payment {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-PaymentMonthly">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            {{-- <th>
                                {{ trans('cruds.paymentMonthly.fields.id') }}
                            </th> --}}
                            <th>
                                Payment Date
                            </th>
                            <th>
                                Paid Amount (RM)
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Balance (RM)
                            </th>
                            {{-- <th>
                                &nbsp;
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr data-entry-id="{{ $transaction->id }}">
                                <td>
                                </td>
                                {{-- <td>
                                    {{ $transaction->id ?? '' }}
                                </td> --}}
                                <td>
                                    {{ Carbon\Carbon::parse($transaction->transaction_date)->format('d/M/Y') }}
                                </td>
                                <td>
                                    RM{{ $transaction->amount ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->status ?? '' }}
                                </td>
                                <td>
                                    RM {{ $transaction->balance ?? '' }}
                                </td>
                                {{-- <td>
                                    @can('payment_monthly_show')
                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.payment-monthlies.show', $transaction->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('payment_monthly_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.payment-monthlies.edit', $transaction->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('payment_monthly_delete')
                                        <form action="{{ route('admin.payment-monthlies.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    @include('admin.paymentMonthlies.components.invoice-modal')

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('payment_monthly_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.payment-monthlies.massDestroy') }}",
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
  let table = $('.datatable-PaymentMonthly:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
