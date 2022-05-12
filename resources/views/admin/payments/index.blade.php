@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Report Management</li>
        <li class="breadcrumb-item active" aria-current="page">Payments Lists</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        Payments {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <div class="my-2">
                <form action="{{ route('admin.payments.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control date" name="start_date" placeholder="From Date">
                        <input type="text" class="form-control date" name="end_date" placeholder="To Date">
                        <button class="btn btn-primary" type="submit">GET</button>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.order.fields.id') }}</th>
                        <th>Doc No</th>
                        <th>Doc Date</th>
                        <th>Debtor Code</th>
                        <th>Description</th>
                        <th>Proj No</th>
                        <th>Dept No</th>
                        <th>Currency Code</th>
                        <th>To Home Rate</th>
                        <th>To Debtor Rate</th>
                        <th>Payment Method</th>
                        <th>Cheque No</th>
                        <th>Payment Amount</th>
                        <th>Bank Charge</th>
                        <th>To Bank Rate</th>
                        <th>Payment By</th>
                        <th>IsRCHQ</th>
                        <th>RCHQ Date</th>
                        <th>Knock Off Doc Type</th>
                        <th>Knock Off Doc No</th>
                        <th>Knock Off Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                        <tr data-entry-id="{{ $payment->id }}">
                            <td>{{ ++$key }}</td>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->doc_no ?? '' }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($payment->doc_date)->format('d/M/Y H:i:s') }}
                            </td>
                            <td>{{ $payment->debtor_code ?? ''}}</td>
                            <td>{{ $payment->description ?? ''}}</td>
                            <td>{{ $payment->proj_no ?? ''}}</td>
                            <td>{{ $payment->dept_no ?? ''}}</td>
                            <td>{{ $payment->currency_code ?? ''}}</td>
                            <td>
                                {{ $payment->to_home_rate ?? ''}}
                            </td>
                            <td>
                                {{ $payment->to_debtor_rate ?? ''}}
                            </td>
                            <td>
                                {{ $payment->payment_method ?? ''}}
                            </td>
                            <td>
                                {{ $payment->cheque_no ?? ''}}
                            </td>
                            <td>
                                {{ $payment->payment_amount ?? '' }}
                            </td>
                            <td>
                                {{ $payment->bank_charge ?? '' }}
                            </td>
                            <td>
                                {{ $payment->to_bank_rate ?? '' }}
                            </td>
                            <td>
                                {{ $payment->payment_by ?? '' }}
                            </td>
                            <td>
                                {{ $payment->isRCHQ ?? '' }}
                            </td>
                            <td>
                                {{ $payment->rchq_date ?? '' }}
                            </td>
                            <td>
                                {{ $payment->knock_off_doc_type ?? '' }}
                            </td>
                            <td>
                                {{ $payment->knock_off_doc_no ?? '' }}
                            </td>
                            <td>
                                {{ $payment->knock_off_amount ?? '' }}
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
  let table = $('.datatable-Payment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
