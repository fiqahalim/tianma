@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.documentManagement.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.myDocument.title') }}</li>
    </ol>
</nav>

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
    <div class="card-header font-weight-bold">
        {{ trans('cruds.myDocument.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MyDocument">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>ID</th>
                        <th>
                            {{ trans('global.createdDate') }}
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
                            <td></td>
                            <td>{{ $myDocument->id }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($myDocument->created_at)->format('d/M/Y H:i:s') }}
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
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.my-documents.show', $myDocument->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.my-documents.edit', $myDocument->id) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('admin.my-documents.destroy', $myDocument->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
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
    url: "{{ route('user.my-documents.massDestroy') }}",
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
    // columnDefs: [{
    //         targets: 0,
    //     },
    //     {
    //         targets: 1,
    //         visible: false
    //     }
    // ],
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
