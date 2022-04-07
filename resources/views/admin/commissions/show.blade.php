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
            {{-- First Payout --}}
            <div class="form-group">
                <h5>First Payment</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">Agent Code</th>
                            <th scope="col">Agent Ranking</th>
                            @if(isset($order->customer) ?? $order->customer->mode == 'Installment')
                                <th scope="col">New Point Value (PV)</th>
                            @else
                                <th scope="col">Point Value (PV)</th>
                            @endif
                            <th scope="col">Percentage (%)</th>
                            @if($order->commissions->first_month > 0)
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
                            <td id="point_value" name="point_value">
                                {{ $firstPayout->point_value }}
                            </td>
                            <td>
                                {{ $firstPayout->percentage }}
                            </td>
                            @if($order->commissions->first_month > 0)
                                <td>Yes</td>
                            @endif
                            <td>
                                RM {{ $firstPayout->mo_overriding_comm }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Installment Payment --}}
            @if(isset($order->customer) ?? $order->customer->mode == 'Installment')
                <div class="form-group mt-5">
                    <h5>Installment Payment (<i>{{ $order->installments->installment_year }} months</i>)</h5>
                    <table class="table table-light table-bordered datatable datatable-installments">
                        <thead>
                            @if($order->commissions->mo_overriding_comm != "0")
                                <tr class="table-info">
                                    <th></th>
                                    <th>ID</th>
                                    <th scope="col">Commissions (Per Month)</th>
                                </tr>
                            @endif
                        </thead>
                        <tbody>
                            @foreach($allCommissions as $key => $allCommission)
                                @if($allCommission->mo_overriding_comm != "0")
                                    <tr data-entry-id="{{ $allCommission->id }}">
                                        <td></td>
                                        <td>{{ $allCommission->id }}</td>
                                        <td>{{ $allCommission->mo_overriding_comm }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Upperline Info --}}
            @if(isset($order->createdBy->parent) ?? !empty($order->createdBy->parent))
                <div class="form-group mt-5">
                    <table class="table table-light table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">Upperline Agent Code</th>
                                <th scope="col">Upperline Agent Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $order->createdBy->parent->agent_code }}
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
                            </tr>
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
</script>
@endsection
