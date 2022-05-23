@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Report Management</li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('admin.commissionReport.index') }}">Commissions Report</a>
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        Commissions Report {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="mb-5">
            <form action="{{ route('admin.commissionReport.index') }}" method="GET">
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
            <table class="table table-bordered table-striped table-hover datatable-commissionReport">
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
                    {{-- @foreach($commissions as $key => $commission)
                        <tr data-entry-id="{{ $commission->id }}">
                            <td></td>
                            <td>{{ $commission->id }}</td>
                            <td>{{ $commission->doc_no ?? '' }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($commission->doc_date)->format('d/M/Y') }}
                            </td>
                            <td>{{ $commission->debtor_code ?? ''}}</td>
                            <td>{{ $commission->journal_type ?? ''}}</td>
                            <td>{{ $commission->display_term ?? ''}}</td>
                            <td>{{ $commission->orders->createdBy->name ?? '' }}</td>
                            <td>{{ $commission->orders->products->description ?? ''}}</td>
                            <td>{{ $commission->currency_code ?? ''}}</td>
                            <td>{{ $commission->currency_rate ?? ''}}</td>
                            <td>{{ $commission->inclusive_tax ?? ''}}</td>
                            <td>{{ $commission->account_no ?? ''}}</td>
                            <td>{{ $commission->to_account_rate ?? ''}}</td>
                            <td>{{ $commission->proj_no ?? ''}}</td>
                            <td>{{ $commission->dept_no ?? ''}}</td>
                            <td>{{ $commission->tax_type ?? ''}}</td>
                            <td>{{ $commission->taxable_amount ?? ''}}</td>
                            <td>{{ $commission->tax_adjustment ?? ''}}</td>
                            <td>{{ $commission->orders->amount ?? '' }}</td>
                        </tr>
                    @endforeach --}}
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
  let table = $('.datatable-commissionReport:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})

</script>
@endsection
