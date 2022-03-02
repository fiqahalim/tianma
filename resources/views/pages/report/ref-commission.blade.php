@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.reports.myCommission') }}
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.commission.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Commission">
                <thead>
                    <tr class="table-info">
                        <th width="10"></th>
                        <th>
                            {{ trans('global.createdDate') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.comm_per_order') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.increased_commission') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.order') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commissions as $key => $commission)
                    @if(!empty($commission->mo_overriding_comm) && $commission->mo_overriding_comm > 0 && $commission->orders->approved == 1)
                        <tr data-entry-id="{{ $commission->id }}">
                            <td>

                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($commission->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                {{ $commission->mo_overriding_comm ?? '' }}
                            </td>
                            <td>
                                {{ $commission->mo_spin_off ?? 'Not eligible yet' }}
                            </td>
                            <td>
                                #{{ $commission->orders->ref_no ?? '' }}
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
  let table = $('.datatable-Commission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
