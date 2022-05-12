@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Report Management</li>
        <li class="breadcrumb-item active" aria-current="page">Invoices Lists</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        Invoices {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="my-2 mb-3">
            <form action="{{ route('admin.invoices.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control date" name="start_date" placeholder="From Date">
                    <input type="text" class="form-control date" name="end_date" placeholder="To Date">
                    <button class="btn btn-primary" type="submit">GET</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.order.fields.id') }}</th>
                        <th>Doc No</th>
                        <th>Doc Date</th>
                        <th>Debtor Code</th>
                        <th>Journal Type</th>
                        <th>Display Term</th>
                        <th>Sales Agent</th>
                        <th>Description</th>
                        <th>Currency Code</th>
                        <th>Currency Rate</th>
                        <th>Inclusive Tax</th>
                        <th>Account No</th>
                        <th>To Account Rate</th>
                        <th>Proj No</th>
                        <th>Dept No</th>
                        <th>Tax type</th>
                        <th>Taxable Amount</th>
                        <th>Tax Adjustment</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $key => $invoice)
                        <tr data-entry-id="{{ $invoice->id }}">
                            <td></td>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->doc_no ?? '' }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($invoice->doc_date)->format('d/M/Y H:i:s') }}
                            </td>
                            <td>{{ $invoice->debtor_code ?? ''}}</td>
                            <td>{{ $invoice->journal_type ?? ''}}</td>
                            <td>{{ $invoice->display_term ?? ''}}</td>
                            <td>{{ $invoice->sales_agent ?? '' }}</td>
                            <td>{{ $invoice->description ?? ''}}</td>
                            <td>{{ $invoice->currency_code ?? ''}}</td>
                            <td>{{ $invoice->currency_rate ?? ''}}</td>
                            <td>{{ $invoice->inclusive_tax ?? ''}}</td>
                            <td>{{ $invoice->account_no ?? ''}}</td>
                            <td>{{ $invoice->to_account_rate ?? ''}}</td>
                            <td>{{ $invoice->proj_no ?? ''}}</td>
                            <td>{{ $invoice->dept_no ?? ''}}</td>
                            <td>{{ $invoice->tax_type ?? ''}}</td>
                            <td>{{ $invoice->taxable_amount ?? ''}}</td>
                            <td>{{ $invoice->tax_adjustment ?? ''}}</td>
                            <td>{{ $invoice->amount ?? '' }}</td>
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
          data: { ids: ids, _method: 'DELETE' }})
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
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
