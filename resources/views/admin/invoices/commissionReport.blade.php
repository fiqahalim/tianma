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
            <table class=" table table-bordered table-striped table-hover datatable datatable-CommissionReport">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>Agent Name</th>
                        <th>
                            Agent Code
                        </th>
                        <th>
                            Total Commissions (RM)
                        </th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($commissions as $key => $data)
                            @if($data->commissions()->sum('mo_overriding_comm') > 0)
                                <tr data-entry-id="{{ $data->id }}">
                                    <td></td>
                                    <td> {{ $data->name }}</td>
                                    <td>
                                        {{ $data->agent_code }}
                                    </td>
                                    <td>
                                        {{ $data->commissions()->sum('mo_overriding_comm') ?? '' }}
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
    let table = $('.datatable-CommissionReport:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})

</script>
@endsection
