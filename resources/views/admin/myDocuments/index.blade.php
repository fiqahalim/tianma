@extends('layouts.admin')
@section('content')
@can('my_document_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.my-documents.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.myDocument.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.myDocument.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MyDocument">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.myDocument.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.myDocument.fields.document_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.myDocument.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.myDocument.fields.document_file') }}
                        </th>
                        <th>
                            {{ trans('cruds.myDocument.fields.agents') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myDocuments as $key => $myDocument)
                        <tr data-entry-id="{{ $myDocument->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $myDocument->id ?? '' }}
                            </td>
                            <td>
                                {{ $myDocument->document_name ?? '' }}
                            </td>
                            <td>
                                {{ $myDocument->description ?? '' }}
                            </td>
                            <td>
                                @foreach($myDocument->document_file as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $myDocument->agents->name ?? '' }}
                            </td>
                            <td>
                                {{ $myDocument->agents->name ?? '' }}
                            </td>
                            <td>
                                @can('my_document_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.my-documents.show', $myDocument->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('my_document_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.my-documents.edit', $myDocument->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('my_document_delete')
                                    <form action="{{ route('admin.my-documents.destroy', $myDocument->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
@can('my_document_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.my-documents.massDestroy') }}",
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
  let table = $('.datatable-MyDocument:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection