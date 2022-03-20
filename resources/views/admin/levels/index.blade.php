@extends('layouts.admin')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.levels.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.level.title_singular') }}
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('cruds.level.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Level">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.level.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.level.fields.level_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.level.fields.building_type') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($levels as $key => $level)
                            <tr data-entry-id="{{ $level->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $level->id ?? '' }}
                                </td>
                                <td>
                                    {{ $level->level_name ?? '' }}
                                </td>
                                <td>
                                    @foreach($level->building_types as $key => $item)
                                        <span class="badge badge-info">{{ $item->building_name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.levels.show', $level->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('admin.levels.edit', $level->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.levels.destroy', $level->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.levels.massDestroy') }}",
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
                        data: { ids: ids, _method: 'DELETE' }}).done(function () { location.reload() })
                }
            }
        }

        dtButtons.push(deleteButton)

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        });
        let table = $('.datatable-Level:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection