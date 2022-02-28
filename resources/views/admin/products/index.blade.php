@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.productManagement.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.product.title') }}</li>
    </ol>
</nav>

@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
            </a>
            <button class="btn btn-dark" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_excelImport') }}
            </button>
            @include('import.modal')
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Product">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        {{-- <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.product.fields.product_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.product_id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.product_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.selling_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.maintenance_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.list_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.promotion_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.point_value') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.quantity_per_unit') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.total_cost') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th> --}}
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td>

                            </td>
                            {{-- <td>
                                {{ $product->id ?? '' }}
                            </td> --}}
                            <td>
                                {{ $product->product_name ?? '' }}
                            </td>
                            <td>
                                {{ $product->product_id_number ?? '' }}
                            </td>
                            <td>
                                {{ $product->product_code ?? '' }}
                            </td>
                            <td>
                                {{ $product->description ?? '' }}
                            </td>
                            <td>
                                {{ $product->price ?? '' }}
                            </td>
                            <td>
                                {{ $product->selling_price ?? '' }}
                            </td>
                            <td>
                                {{ $product->maintenance_price ?? '' }}
                            </td>
                            <td>
                                {{ $product->list_price ?? '' }}
                            </td>
                            <td>
                                {{ $product->promotion_price ?? '' }}
                            </td>
                            <td>
                                {{ $product->point_value ?? '' }}
                            </td>
                            <td>
                                {{ $product->quantity_per_unit ?? '' }}
                            </td>
                            <td>
                                {{ $product->total_cost ?? '' }}
                            </td>
                            {{-- <td>
                                @foreach($product->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td> --}}
                            {{-- <td>
                                @foreach($product->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td> --}}
                            <td>
                                @can('product_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.products.show', $product->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan

                                @can('product_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.products.edit', $product->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan

                                @can('product_delete')
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
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
  let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
