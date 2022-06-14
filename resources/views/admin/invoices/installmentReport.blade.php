@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Report Management</li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('admin.installment-report.index') }}">Monthly Installment Due Reminder</a>
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        Monthly Installment Due Reminder {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="mb-5">
            <form action="{{ route('admin.installment-report.index') }}" method="GET">
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
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductReport">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>
                            {{ trans('cruds.order.fields.order_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.ref_no') }}
                        </th>
                        <th>
                            Downpayment
                        </th>
                        <th>
                            Monthly Installment (11 months)
                        </th>
                        <th>
                            Last Month Installment
                        </th>
                        <th>
                            Monthly Reminder
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($installments as $key => $installment)
                        @if($installment->customer->mode == 'Installment')
                            <tr data-entry-id="{{ $installment->id }}">
                                <td></td>
                                <td>
                                    {{ Carbon\Carbon::parse($installment->created_at)->format('d/M/Y H:i:s') }}
                                </td>
                                <td>
                                    #{{ $installment->ref_no ?? '' }}
                                </td>
                                <td>
                                    {{ $installment->installments->downpayment ?? '' }}
                                </td>
                                <td>
                                    {{ $installment->installments->monthly_installment ?? '' }}
                                </td>
                                <td>
                                    {{ $installment->installments->last_month_payment ?? '' }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($date)->format('d/M/Y') }}
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
                    visible: true
                }
            ],
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
        pageLength: 10,
    });
    let table = $('.datatable-ProductReport:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})

</script>
@endsection
