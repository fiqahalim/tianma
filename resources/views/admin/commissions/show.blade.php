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
            {{-- <div class="my-2">
                <form action="{{ route('admin.commissions.show', $order->id) }}" method="GET">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-info text-white" id="basic-addon1">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="agency_code" id="agency_code" placeholder="Agency Code">
                        <button class="btn btn-primary" type="submit">FILTER</button>
                    </div>
                </form>
            </div> --}}
            {{-- First Payout --}}
            <div class="form-group">
                <h5>First Payment</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">Agent Code</th>
                            <th scope="col">Agent Ranking</th>
                            <th scope="col">Agency Code</th>
                            @if(isset($order->customer) ?? $order->customer->mode == 'Installment')
                                <th scope="col">New Point Value (PV)</th>
                            @else
                                <th scope="col">Point Value (PV)</th>
                            @endif
                            <th scope="col">Percentage (%)</th>
                            @if(isset($order->commissions->first_month) && $order->commissions->first_month > 0)
                                <th scope="col">First Month Payment</th>
                            @endif
                            <th scope="col">Commissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ $order->createdBy->agent_code }}
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
                            <td>{{ $order->createdBy->agency_code ?? 'No Agency Code Yet' }}</td>
                            <td id="point_value" name="point_value">
                                {{ isset($firstPayout->point_value) ? $firstPayout->point_value : '' }}
                            </td>
                            <td>
                                {{ isset($firstPayout->percentage) ? $firstPayout->percentage : '' }}
                            </td>
                            @if(isset($order->commissions->first_month) && $order->commissions->first_month > 0)
                                <td>Yes</td>
                            @endif
                            <td>
                                RM{{ isset($firstPayout->mo_overriding_comm) ? $firstPayout->mo_overriding_comm : '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Installment Payment --}}
            @if(isset($order->customer))
                @if($order->customer->mode == 'Installment')
                    <div class="form-group mt-5">
                        <h5>Installment Payment (<i>{{ isset($order->installments->installment_year) ? $order->installments->installment_year : '' }} months</i>)</h5>
                        <table class="table table-light table-bordered datatable datatable-installments">
                            <thead>
                                @if(isset($order->commissions) && $order->commissions->mo_overriding_comm != "0")
                                    <tr class="table-info">
                                        <th></th>
                                        <th>ID</th>
                                        <th scope="col">Commissions (Per Month)</th>
                                        <th>Agent Code</th>
                                        <th>Agent Commission Percentage (%)</th>
                                        <th scope="col">Point Value (PV)</th>
                                        <th>Commission Received Date </th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                {{-- @foreach($allCommissions as $key => $allCommission)
                                    @if($allCommission->mo_overriding_comm != "0")
                                        <tr data-entry-id="{{ $allCommission->id }}">
                                            <td></td>
                                            <td>{{ $allCommission->id }}</td>
                                            <td>RM{{ $allCommission->mo_overriding_comm }}</td>
                                            <td></td>
                                            <td>%</td>
                                            <td>
                                                First PV: {{ $allCommission->point_value }}<br>
                                                Balance PV: {{ $allCommission->balance_pv }}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($allCommission->created_at)->format('d/M/Y H:i:s') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach --}}

                                @foreach($users as $key => $data)
                                    @if($data->mo_overriding_comm != "0")
                                        <tr data-entry-id="{{ $data->id }}">
                                            <td></td>
                                            <td>{{ $data->id }}</td>
                                            <td>RM{{ $data->mo_overriding_comm }}</td>
                                            <td>{{ $data->user->agent_code }}</td>
                                            <td>
                                                @if($data->user->ranking_id == 1)
                                                    16%
                                                @elseif($data->user->ranking_id == 2 && $data->user->ranking_id == 4)
                                                    4%
                                                @elseif($data->user->ranking_id == 3)
                                                    2%
                                                @else
                                                    5%
                                                @endif
                                            </td>
                                            <td>
                                                First PV: {{ $data->point_value }}<br>
                                                Balance PV: {{ $data->balance_pv }}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($data->created_at)->format('d/M/Y H:i:s') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif

            {{-- Upperline Info --}}
            @if(isset($order->createdBy->parent) ?? !empty($order->createdBy->parent))
                <div class="form-group mt-5">
                    <h5>Upperline Informations</h5>
                    <table class="table table-light table-bordered datatable datatable-upperline">
                        <thead>
                            <tr class="table-primary">
                                <th></th>
                                <th scope="col">Upperline Agent Code</th>
                                <th scope="col">Upperline Agency Code</th>
                                <th scope="col">Upperline Agent Ranking</th>
                                <th scope="col">Upperline Total Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 1st Parent --}}
                            <tr>
                                <td></td>
                                <td>
                                    {{ $order->createdBy->parent->agent_code }}
                                </td>
                                <td>
                                    {{ $order->createdBy->parent->agency_code ?? 'No Agency Code Yet' }}
                                </td>
                                <td>
                                    @if($order->createdBy->parent->ranking_id == 1)
                                        SD
                                    @elseif($order->createdBy->parent->ranking_id == 2)
                                        DSD
                                    @elseif($order->createdBy->parent->ranking_id == 3)
                                        BDD A
                                    @elseif($order->createdBy->parent->ranking_id == 4)
                                        BDD B
                                    @else
                                        CBDD
                                    @endif
                                </td>
                                <td>
                                    RM{{ $order->createdBy->parent->commissions()->sum('mo_overriding_comm') ?? '' }}
                                </td>
                            </tr>

                            @if(isset($order->createdBy->parent->parent) && !empty($order->createdBy->parent->parent))
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->agent_code) ? $order->createdBy->parent->parent->agent_code : '' }}
                                    </td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->agency_code) ? $order->createdBy->parent->parent->agency_code : 'No Agency Code Yet' }}
                                    </td>
                                    <td>
                                        @if(isset($order->createdBy->parent->parent->ranking_id))
                                            @if($order->createdBy->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($order->createdBy->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($order->createdBy->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($order->createdBy->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ isset($order->createdBy->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->commissions()->sum('mo_overriding_comm') : '' }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 3rd Parent --}}
                            @if(isset($order->createdBy->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent))
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->agent_code : '' }}
                                    </td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->agency_code : 'No Agency Code Yet' }}
                                    </td>
                                    <td>
                                        @if(isset($order->createdBy->parent->parent->parent->ranking_id))
                                            @if($order->createdBy->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($order->createdBy->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($order->createdBy->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($order->createdBy->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ isset($order->createdBy->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '' }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 4th Parent --}}
                            @if(isset($order->createdBy->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent))
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->agent_code : '' }}
                                    </td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->agency_code : 'No Agency Code Yet' }}
                                    </td>
                                    <td>
                                        @if(isset($order->createdBy->parent->parent->parent->parent->ranking_id))
                                            @if($order->createdBy->parent->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ isset($order->createdBy->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '' }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 5th Parent --}}
                            @if(isset($order->createdBy->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent))
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->agent_code : '' }}
                                    </td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->agency_code : 'No Agency Code Yet' }}
                                    </td>
                                    <td>
                                        @if(isset($order->createdBy->parent->parent->parent->parent->parent->ranking_id))
                                            @if($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ isset($order->createdBy->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '' }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 6th Parent --}}
                            @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent->parent))
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->agent_code : '' }}
                                    </td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->agency_code : 'No Agency Code Yet' }}
                                    </td>
                                    <td>
                                        @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id))
                                            @if($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '' }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 7th Parent --}}
                            @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent->parent->parent))
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->agent_code : '' }}
                                    </td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->agency_code : 'No Agency Code Yet' }}
                                    </td>
                                    <td>
                                        @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id))
                                            @if($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '' }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 8th Parent --}}
                            @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent))
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agent_code : '' }}
                                    </td>
                                    <td>
                                        {{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agency_code : 'No Agency Code Yet' }}
                                    </td>
                                    <td>
                                        @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id))
                                            @if($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '' }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
