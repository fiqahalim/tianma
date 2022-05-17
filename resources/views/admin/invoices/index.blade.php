@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Report Management</li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('admin.invoices.index') }}">Invoices Lists</a>
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        Invoices {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="mb-5">
            <form action="{{ route('admin.invoices.index') }}" method="GET">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info text-white" id="basic-addon1">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control date" name="start_date" id="start_date" placeholder="From Date">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info text-white" id="basic-addon1">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control date" name="end_date" id="end_date" placeholder="To Date">

                    <button class="btn btn-primary" type="submit">FILTER</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable-Invoice">
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
                                {{ Carbon\Carbon::parse($invoice->doc_date)->format('d/M/Y') }}
                            </td>
                            <td>{{ $invoice->debtor_code ?? ''}}</td>
                            <td>{{ $invoice->journal_type ?? ''}}</td>
                            <td>{{ $invoice->display_term ?? ''}}</td>
                            <td>{{ $invoice->orders->createdBy->name ?? '' }}</td>
                            <td>{{ $invoice->orders->products->description ?? ''}}</td>
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
                            <td>{{ $invoice->orders->amount ?? '' }}</td>
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

        $.extend(true, $.fn.dataTable.defaults, {
    columnDefs: [{
            targets: 0,
        },
        {
            targets: 1,
            visible: true
        }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Invoice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})

</script>
@endsection
