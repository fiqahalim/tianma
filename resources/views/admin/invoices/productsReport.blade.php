@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Report Management</li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('admin.product-report.index') }}">Product Status Listing</a>
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        Product Status Listing {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="mb-5">
            <form action="{{ route('admin.product-report.index') }}" method="GET">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info text-white" id="basic-addon1">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control date" name="start_date" id="start_date" placeholder="From Date">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info text-white" id="basic-addon1">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control date" name="end_date" id="end_date" placeholder="To Date">

                    <button class="btn btn-primary" type="submit">FILTER</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductReport">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>Order Date</th>
                        <th>Ref No</th>
                        <th>
                            Reservation Lot ID
                        </th>
                        <th>
                            Product Price (RM)
                        </th>
                        <th>
                            Availability
                        </th>
                        <th>
                            Order Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $key => $reserve)
                        @php
                            $getUnitNo = isset($reserve->seats) ? $reserve->seats : '';
                            $unitNo = implode(" ",$getUnitNo);
                        @endphp
                        <tr data-entry-id="{{ $reserve->id }}">
                            <td></td>
                            <td>
                                {{ Carbon\Carbon::parse(isset($reserve->orders->created_at) ? $reserve->orders->created_at : '')->format('d/M/Y H:i:s') }}
                            </td>
                            <td>#{{ $reserve->orders->ref_no ?? '' }}</td>
                            <td>
                                {{ $unitNo }}
                            </td>
                            <td>
                                {{ $reserve->price ?? '' }}
                            </td>
                            <td>
                                @if($reserve->available == '0')
                                    <span class="badge badge-danger px-25">
                                        RESERVED
                                    </span>
                                @else
                                    <span class="badge badge-primary px-25">
                                        AVAILABLE
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ strtoupper(isset($reserve->orders->order_status) ? $reserve->orders->order_status :'') }}
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
                    visible: true
                }
            ],
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
        pageLength: 10,
    });
    let table = $('.datatable-ProductReport:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})

</script>
@endsection
