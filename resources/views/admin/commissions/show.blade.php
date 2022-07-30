@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.commission.title') }}</li>
            <li class="breadcrumb-item">{{ $order->id }}</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.commission.title') }}
        </div>

        <div class="card-body">
            {{-- Purchaser Information --}}
            <div class="form-group mb-5">
                <h5>Purchaser Information</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th>Order Created</th>
                            <th>Reservation Lot Number</th>
                            <th>Purchaser Name</th>
                            <th>Purchaser ID/Passport Number</th>
                            <th>Agent Name</th>
                            <th>Product Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $getUnitNo = isset($order->lotID->seats) ? $order->lotID->seats : '';
                            $unitNo = implode(" ",$getUnitNo);
                            $extractData = explode(",",$unitNo);
                        @endphp
                        <tr>
                            <td>{{ strtoupper(Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s')) }}</td>
                            <td>{{ strtoupper($extractData[0]) ?? 'No Information' }}</td>
                            <td>{{ strtoupper($order->customer->full_name ?? 'No Information') }}</td>
                            <td>{{ strtoupper($order->customer->id_number ?? 'No Information') }}</td>
                            <td>{{ strtoupper($order->createdBy->name ?? 'No Information') }}</td>
                            <td>RM{{ number_format($extractData[1] ?? '') }}.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- First Payout --}}
            <div class="form-group mb-5">
                <h5>First Payment</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th>Commission Received Date</th>
                            <th scope="col">Agent Code</th>
                            <th scope="col">Agent Ranking</th>
                            <th scope="col">Agency Code</th>
                            @if(isset($order->customer) ?? $order->customer->mode == 'Installment')
                                <th scope="col">First Point Value (PV)</th>
                            @else
                                <th scope="col">Point Value (PV)</th>
                            @endif
                            <th scope="col">Percentage (%)</th>
                            @if(isset($order->commissions->first_month) && $order->commissions->first_month > 0)
                                <th scope="col">First Month Payment</th>
                            @endif
                            <th scope="col">First Month Commissions Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dates = isset($order->commissions->created_at) ? $order->commissions->created_at : '';
                        @endphp
                        <tr>
                            <td>
                                {{ strtoupper(Carbon\Carbon::parse($dates)->format('d/M/Y H:i:s')) }}
                            </td>
                            <td>
                                {{ strtoupper($order->createdBy->agent_code ?? 'No Information') }}
                            </td>
                            <td>
                                @if($order->createdBy->ranking_id == 1)
                                    SD
                                @elseif($order->createdBy->ranking_id == 2)
                                    DSD
                                @elseif($order->createdBy->ranking_id == 3)
                                    BDD A
                                @elseif($order->createdBy->ranking_id == 4)
                                    BDD B
                                @else
                                    CBDD
                                @endif
                            </td>
                            <td>{{ strtoupper($order->createdBy->agency_code ?? 'No Information') }}</td>
                            <td id="point_value" name="point_value">
                                {{ number_format(isset($firstPayout->point_value) ? $firstPayout->point_value : '') }}
                            </td>
                            <td>
                                {{ isset($firstPayout->percentage) ? $firstPayout->percentage : '' }}
                            </td>
                            @if(isset($order->commissions->first_month) && $order->commissions->first_month > 0)
                                <td>YES, {{ $firstPayout->first_month }}</td>
                            @endif
                            <td>
                                RM{{ number_format(isset($firstPayout->mo_overriding_comm) ? $firstPayout->mo_overriding_comm : '') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Installment Payment --}}
            @if(isset($order->customer))
                @if($order->customer->mode == 'Installment')
                    <div class="form-group mb-5">
                        <h5>Installment Payment (<i>{{ isset($order->installments->installment_year) ? $order->installments->installment_year : '' }} months</i>)</h5>
                        <table class="table table-light table-bordered datatable datatable-installments">
                            <thead>
                                @if(isset($order->commissions) && $order->commissions->mo_overriding_comm != "0")
                                    <tr class="table-info">
                                        <th></th>
                                        <th>ID</th>
                                        <th>Commission Received Date</th>
                                        <th>Agent Ranking</th>
                                        <th>Agent Name</th>
                                        <th>Agent Code</th>
                                        <th>Commissions Received <i>(per Installment)</i></th>
                                        <th>Agent Commission Percentage (%)</th>
                                        <th>Point Value (PV) Claimed</th>
                                        <th>Installment Balance Point Value (PV)</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach($users as $key => $data)
                                    @if($data->mo_overriding_comm != "0")
                                        <tr data-entry-id="{{ $data->id }}">
                                            <td></td>
                                            <td>{{ $data->id }}</td>
                                            <td>
                                                {{ strtoupper(Carbon\Carbon::parse($data->created_at)->format('d/M/Y H:i:s')) }}
                                            </td>
                                            <td>{{ strtoupper($data->user->name ?? 'No Information') }}</td>
                                            <td>{{ strtoupper($data->user->agent_code ?? 'No Information') }}</td>
                                            <td>
                                                @if($data->user->ranking_id == 1)
                                                    SD
                                                @elseif($data->user->ranking_id == 2)
                                                    DSD
                                                @elseif($data->user->ranking_id == 3)
                                                    BDD A
                                                @elseif($data->user->ranking_id == 4)
                                                    BDD B
                                                @else
                                                    CBDD
                                                @endif
                                            </td>
                                            <td>RM{{ number_format($data->mo_overriding_comm ?? '') }}</td>
                                            <td>
                                                @if($data->user->ranking_id == 1)
                                                    16%
                                                @elseif($data->user->ranking_id == 2)
                                                    4%
                                                @elseif($data->user->ranking_id == 3)
                                                    4%
                                                @elseif($data->user->ranking_id == 4)
                                                    2%
                                                @else
                                                    0.5%
                                                @endif
                                            </td>
                                            <td>{{ number_format($data->balance_pv) }}</td>
                                            <td>{{ number_format($data->installment_pv) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif

            {{-- Agent Information --}}
            <div class="form-group mb-5">
                <h5>Agent Information</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th>Joined Date</th>
                            <th>Agent Name</th>
                            <th>Agent Code</th>
                            <th>Agent Ranking</th>
                            <th>Agent Previous Ranking</th>
                            <th>Agency Name</th>
                            <th>Total Point Value (PV) Claimed</th>
                            <th>Total Commission Received</th>
                            <th>Monthly Spin Off Overriding</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ strtoupper(Carbon\Carbon::parse($order->createdBy->created_at)->format('d/F/Y')) }}</td>
                            <td>{{ strtoupper($order->createdBy->name ?? 'No Information') }}</td>
                            <td>{{ strtoupper($order->createdBy->agent_code ?? 'No Information') }}</td>
                            <td>
                                @if($order->createdBy->ranking_id == 1)
                                    SD
                                @elseif($order->createdBy->ranking_id == 2)
                                    DSD
                                @elseif($order->createdBy->ranking_id == 3)
                                    BDD A
                                @elseif($order->createdBy->ranking_id == 4)
                                    BDD B
                                @else
                                    CBDD
                                @endif
                            </td>
                            <td></td>
                            <td>{{ strtoupper($order->createdBy->agency_code ?? 'No Information') }}</td>
                            <td>PV Total</td>
                            <td>RM{{ number_format(isset($order->commissions) ? $order->commissions()->sum('mo_overriding_comm') : '0') }}</td>
                            <td>
                                RM{{ number_format(isset($order->commissions) ? $order->commissions->mo_spin_off : '0') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Upperline Info --}}
            @if(isset($order->createdBy->parent) ?? !empty($order->createdBy->parent))
                <div class="form-group mt-5">
                    <h5>Upperline Information</h5>
                    @include('admin.commissions.components.upperline-information')
                </div>
            @endif
        </div>
    </div>

    <div class="form-group">
        <a class="btn btn-default" href="{{ route('admin.commissions.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
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
        order: [[ 1, 'asc' ]],
        pageLength: 10,
      });

        let table = $('.datatable-installments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })

    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
            columnDefs: [{
                targets: 0,
            },
            {
                targets: 1,
                visible: true,
            }
        ],
        "language": {
            searchPlaceholder: 'Filter Agency Code'
        },
        orderCellsTop: true,
        order: [[ 1, 'asc' ]],
        pageLength: 5,
      });

        let table = $('.datatable-upperline:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
