@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li aria-current="page" class="breadcrumb-item active">
            My {{ trans('cruds.customer.title') }}s
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.customer.title')}}s {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Customer">
                <thead>
                    <tr class="table-info">
                        <th width="10"></th>
                         <th>
                            {{ trans('global.createdDate') }}
                        </th>
                        <th>{{ trans('cruds.customer.fields.id') }}</th>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $key => $customer)
                        <tr data-entry-id="{{ $customer->id }}">
                            <td></td>
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
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        });

        let table = $('.datatable-Customer:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
