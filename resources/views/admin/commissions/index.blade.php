@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.commission.title') }}</li>
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
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.commission.fields.id') }}</th>
                        <th>
                            {{ trans('global.createdDate') }}
                        </th>
                        <th>Unit ID</th>
                        <th>
                            Order Ref. No
                        </th>
                        <th>
                            Total {{ trans('cruds.commission.fields.comm_per_order') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.increased_commission') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.user') }}
                        </th>
                        <th>
                            Agency Code
                        </th>
                        <th>
                            Payment Mode
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                    {{-- @if(!empty($order->commissions->mo_overriding_comm) && $order->commissions->mo_overriding_comm > 0) --}}
                        @php
                            $getUnitNo = isset($order->bookLocations) ? $order->bookLocations : '';
                            foreach($getUnitNo as $unit) {
                                $bookLots = $unit->lotBookings->seats;
                                $unitNo = implode(", ", $bookLots);
                            }
                        @endphp
                        <tr data-entry-id="{{ $order->id }}">
                            <td></td>
                            <td>{{ $order->id }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s') }}
                            </td>
                            <td>
                                {{ $unitNo ?? '' }}
                            </td>
                            <td>
                                #{{ $order->ref_no ?? '' }}
                            </td>
                            <td>
                                {{round($order->commissions()->sum('mo_overriding_comm') ?? '')}}.00
                            </td>
                            <td>
                                {{ round($order->commissions()->sum('mo_spin_off')) ?? 'Target was not achieved' }}.00
                            </td>
                            <td>
                                {{ $order->createdBy->agent_code ?? '' }}
                            </td>
                            <td>{{ $order->createdBy->agency_code ?? '' }}</td>
                            <td>
                                @if($order->customer->mode == 'Installment')
                                    <span class="badge bg-success text-white">
                                        {{ $order->customer->mode ?? '' }}
                                    </span>
                                    @else
                                    <span class="badge bg-primary text-white">
                                        {{ $order->customer->mode ?? '' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route("admin.commissions.show", $order->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- <a class="btn btn-xs btn-warning text-white" href="{{ route('admin.commissions.edit', $order->id) }}">
                                    <i class="fas fa-money"></i>
                                </a> --}}
                            </td>
                            @if($order->order_status != 'Rejected' && empty($order->commissions->mo_overriding_comm))
                                <td>
                                    <a class="btn btn-xs btn-dark" href="{{ route('admin.commissions.calculator', $order->id) }}">
                                        <i class="fas fa-calculator"></i>
                                    </a>
                                </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    {{-- @endif --}}
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
@can('commission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.commissions.massDestroy') }}",
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
            visible: false,
        }
    ],
    orderCellsTop: true,
    order: [[1, 'desc']],
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
