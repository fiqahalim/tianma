@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.productManagement.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">
                Promotions
            </li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.promotions.create') }}">
                Add Promotion
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            Promotion {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Promotions">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.addOnProduct.fields.id') }}
                            </th>
                            <th>
                                Promotion Code
                            </th>
                            <th>
                                Promotion Type
                            </th>
                            <th>
                                Promotion Value
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $key => $promotion)
                            <tr data-entry-id="{{ $promotion->id }}">
                                <td></td>
                                <td>
                                    {{ $promotion->id ?? '' }}
                                </td>
                                <td>
                                    {{ $promotion->promo_code ?? '' }}
                                </td>
                                <td>
                                    {{ $promotion->promo_type ?? '' }}
                                </td>
                                <td>
                                    @if(isset($promotion->promo_type) && $promotion->promo_type == 'Percentage')
                                        {{ number_format($promotion->promo_value, 0, '.', ',') ?? '' }}%
                                    @else
                                        RM{{ number_format($promotion->promo_value, 0, '.', ',') ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.promotions.edit', $promotion->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            url: "{{ route('admin.add-on-products.massDestroy') }}",
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

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        });
        let table = $('.datatable-Promotions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
