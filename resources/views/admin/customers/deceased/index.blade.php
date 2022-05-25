@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
            <li class="breadcrumb-item active" aria-current="page">All Deceased Person</li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.decease-people.create') }}">
                {{ trans('global.add') }} Deceased Person Information
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            Deceased Person Information {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Deceased">
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>
                                {{ trans('cruds.customer.fields.id') }}
                            </th>
                            <th>
                                Deceased Name
                            </th>
                            <th>
                                Deceased New NRIC/Passport No
                            </th>
                            <th>
                                Born Date
                            </th>
                            <th>
                                Bury Certificate No
                            </th>
                            <th>
                                Death's Date
                            </th>
                            <th>
                                Bury/Exercise Date
                            </th>
                            <th>
                                Lot ID Number
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($deceases as $key => $data)
                            <tr data-entry-id="{{ $customer->id }}">
                                <td>

                                </td>
                                <td>{{ $customer->id }}</td>
                                <td>
                                    {{ Carbon\Carbon::parse($customer->created_at)->format('d/M/Y H:i:s') }}
                                </td>
                                <td>
                                    {{ $customer->full_name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Customer::ID_TYPE_SELECT[$customer->id_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $customer->id_number ?? '' }}
                                </td>
                                <td>
                                    {{ $customer->email ?? '' }}
                                </td>
                                <td>
                                    {{ $customer->contact_person_name ?? '' }}
                                </td>
                                <td>
                                    {{ $customer->contact_person_no ?? '' }}
                                </td>
                                <td>
                                    @can('customer_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.customers.show', $customer->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can('customer_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.customers.edit', $customer->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    @endcan

                                    @can('customer_delete')
                                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
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
@can('customer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.customers.massDestroy') }}",
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
  let table = $('.datatable-Customer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
