@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.customer.title') }}</li>
    </ol>
</nav>

@can('customer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.customers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.customer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.customer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Customer">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.full_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.id_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.contact_person_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.contact_person_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.created_by') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $key => $customer)
                        <tr data-entry-id="{{ $customer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $customer->id ?? '' }}
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
                                {{ $customer->createdBy->agent_code ?? '' }}
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
