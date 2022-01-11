@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.userManagement.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.user.title') }}</li>
    </ol>
</nav>

@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.username') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.contact_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.agent_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.passport_issue_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.passport_expiry_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.address_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.postcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.nationality') }}
                        </th> --}}
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $user->id ?? '' }}
                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\User::ID_TYPE_SELECT[$user->id_type] ?? '' }}
                            </td>
                            <td>
                                {{ $user->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                {{ $user->username ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $user->approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $user->verified ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $user->contact_no ?? '' }}
                            </td>
                            <td>
                                {{ $user->agent_code ?? '' }}
                            </td>
                            <td>
                                @foreach($user->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            {{-- <td>
                                {{ $user->email_verified_at ?? '' }}
                            </td>
                            <td>
                                {{ $user->passport_issue_date ?? '' }}
                            </td>
                            <td>
                                {{ $user->passport_expiry_date ?? '' }}
                            </td>
                            <td>
                                {{ $user->address_1 ?? '' }}
                            </td>
                            <td>
                                {{ $user->address_2 ?? '' }}
                            </td>
                            <td>
                                {{ $user->postcode ?? '' }}
                            </td>
                            <td>
                                {{ $user->state ?? '' }}
                            </td>
                            <td>
                                {{ $user->city ?? '' }}
                            </td>
                            <td>
                                {{ $user->country ?? '' }}
                            </td>
                            <td>
                                {{ $user->nationality ?? '' }}
                            </td> --}}
                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection