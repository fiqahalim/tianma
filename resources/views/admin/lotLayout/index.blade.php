@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">
            Manage {{ trans('cruds.masterSetting.fields.layout') }}
        </li>
    </ol>
</nav>


<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <button class="btn btn-success" data-toggle="modal" data-target="#addLayoutModal">
            {{ trans('global.add') }} {{ trans('cruds.lotLayout.title_singular') }}
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.lotLayout.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LotLayout">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.lotLayout.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.lotLayout.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layouts as $item)
                        <tr data-entry-id="{{ $item->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $item ->current_page-1 * $item ->per_page + $loop->iteration }}
                            </td>
                            <td>
                                {{ __($item->layout) }}
                            </td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#editModal" data-layout="{{ __($item->layout) }}" class="btn btn-xs btn-info" data-action="{{ route('admin.lot.layouts.update', $item->id) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>

                                <form action="{{ route('admin.lot.layouts.delete', $item->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

{{-- Add Modal --}}
@include('admin.lotLayout.addModal')
@include('admin.lotLayout.editModal')
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        });

        let table = $('.datatable-LotLayout:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>

<script>
    $(function ($) {
        "use strict";

        $(document).on('keypress', 'input[name=layout]', function(e) {
            var layout = $(this).val();
            if(layout != '') {
                if(layout.length > 0 && layout.length <= 1) {
                    $(this).val(`${layout} x `);

                    if(layout.length > 20) {
                        return false;
                    }
                }
            }
        });

        $(document).on('keyup', 'input[name=layout]', function(e) {
            var key = event.keyCode || event.charCode;
            if( key == 8 || key == 46 ) {
                console.log($(this).val());
                $(this).val($(this).val().replace(' x ',''));
            }
        });
    });
</script>
@endsection
