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
                        <th>
                            {{ trans('cruds.commission.fields.comm_per_order') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.increased_commission') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.commission.fields.order') }}
                        </th>
                        <th>
                            Payment Mode
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                    {{-- @if(!empty($order->commissions->mo_overriding_comm) && $order->commissions->mo_overriding_comm > 0) --}}
                        <tr data-entry-id="{{ $order->id }}">
                            <td></td>
                            <td>{{ $order->id }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s') }}
                            </td>
                            <td>
                                {{ $order->commissions->mo_overriding_comm ?? '' }}
                            </td>
                            <td>
                                {{ $order->commissions->mo_spin_off ?? 'Not eligible yet' }}
                            </td>
                            <td>
                                {{ $order->createdBy->agent_code ?? '' }}
                            </td>
                            <td>
                                #{{ $order->ref_no ?? '' }}
                            </td>
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

                                {{-- @can('commission_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.commissions.edit', $commission->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan --}}
                                <a class="btn btn-xs btn-dark" href="{{ route('admin.commissions.calculator', $order->id) }}">
                                    <i class="fas fa-calculator"></i>
                                </a>

                                @can('commission_delete')
                                    <form action="{{ route('admin.commissions.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
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
            visible: false
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
