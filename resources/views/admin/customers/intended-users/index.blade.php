@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
            <li class="breadcrumb-item active" aria-current="page">Intended Users</li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.contact-people.create') }}">
                {{ trans('global.add') }} Intended Users
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            Intended User {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Customer">
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>
                                {{ trans('cruds.customer.fields.id') }}
                            </th>
                             <th>
                                {{ trans('global.createdDate') }}
                            </th>
                            <th>
                                {{ trans('cruds.customer.fields.full_name') }}
                            </th>
                            <th>
                                Contact Number
                            </th>
                            <th>
                                Customer Name
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($intendedUsers))
                            @foreach($intendedUsers as $key => $intendedUser)
                                <tr data-entry-id="{{ $intendedUser->id }}">
                                    <td>

                                    </td>
                                    <td>{{ $intendedUser->id }}</td>
                                    <td>
                                        {{ Carbon\Carbon::parse($intendedUser->created_at)->format('d/M/Y H:i:s') }}
                                    </td>
                                    <td>
                                        {{ $intendedUser->cperson_name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $intendedUser->cperson_no ?? '' }}
                                    </td>
                                    <td>
                                        {{ $intendedUser->customers->full_name ?? '' }}
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.contact-people.show', $intendedUser->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a class="btn btn-xs btn-info" href="{{ route('admin.contact-people.edit', $intendedUser->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('admin.contact-people.destroy', $intendedUser->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
