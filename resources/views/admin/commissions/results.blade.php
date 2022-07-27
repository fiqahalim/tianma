@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.commission.title') }}</li>
        </ol>
    </nav>

    {{-- Product Details --}}
    <div class="card">
        <div class="card-header font-weight-bold">
            Product Details
        </div>

        @php
            $getUnitNo = isset($orders->lotID->seats) ? $orders->lotID->seats : '';
            $unitNo = implode(" ",$getUnitNo);
            $extractData = explode(",",$unitNo);
        @endphp

        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="seats">Reservation Lot</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-home"></i>
                            </span>
                        </div>
                        <input class="form-control" id="seats" type="text" value="{{ $extractData[0] }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="promo">Promotion Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" id="promo" type="text" value="{{ $extractData[2] }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="maintenance">Maintenance Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" id="maintenance" type="text" value="{{ $extractData[3] }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="price">Product Price (After Promo)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" id="price" type="text" value="{{ $extractData[1] }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="point_value">Point Value</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>PV</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $extractData[4] }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.commission.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th>Commission Received Date</th>
                            <th scope="col">Agent Code</th>
                            <th scope="col">Agent Ranking</th>
                            <th scope="col">Agency Code</th>
                            @if(isset($comms->orders->customer) ?? $comms->orders->customer->mode == 'Installment')
                                <th scope="col">Point Value (PV) Claimed</th>
                            @else
                                <th scope="col">Point Value (PV) Claimed</th>
                            @endif
                            <th scope="col">Percentage (%)</th>
                            @if($comms->first_month > 0)
                                <th scope="col">First Month Payment</th>
                            @endif
                            <th scope="col">First Month Commissions Received</th>
                            {{-- @if(isset($comms->orders->customer) ?? $comms->orders->customer->mode == 'Installment')
                                <th scope="col">Installments Period (Months)</th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ Carbon\Carbon::parse($comms->created_at)->format('d/M/Y H:i:s') }}
                            </td>
                            <td>
                                {{ $comms->user->agent_code }}
                            </td>
                            <td>
                                @if($comms->user->ranking_id == 1)
                                    SD
                                @elseif($comms->user->ranking_id == 2)
                                    DSD
                                @elseif($comms->user->ranking_id == 3)
                                    BDD A
                                @elseif($comms->user->ranking_id == 4)
                                    BDD B
                                @else
                                    CBDD
                                @endif
                            </td>
                            <td>{{ $order->createdBy->agency_code ?? 'No Agency Code Yet' }}</td>
                            <td id="point_value" name="point_value">
                                {{ $comms->balance_pv }}
                            </td>
                            <td>
                                {{ $comms->percentage }}
                            </td>
                            @if($comms->first_month > 0)
                                <td>Yes, {{ $comms->first_month }}</td>
                            @endif
                            <td>
                                RM {{ $comms->mo_overriding_comm }}
                            </td>
                            {{-- @if(isset($comms->orders->customer) ?? $comms->orders->customer->mode == 'Installment')
                                <td>
                                    {{ isset($comms->orders->installments->installment_year) ? $comms->orders->installments->installment_year : ''}} months
                                </td>
                            @endif --}}
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Upperline Info --}}
            @if(isset($comms->user->parent) && !empty($comms->user->parent))
                <div class="form-group mt-5">
                    <table class="table table-light table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">Upperline Agent Code</th>
                                <th scope="col">Upperline Agent Ranking</th>
                                <th scope="col">Upperline Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 1st Parent --}}
                            <tr>
                                <td>
                                    {{ isset($comms->user->parent->agent_code) ? $comms->user->parent->agent_code: 'No Upperline' }}
                                </td>
                                <td>
                                    @if($comms->user->parent->ranking_id == 1)
                                        SD
                                    @elseif($comms->user->parent->ranking_id == 2)
                                        DSD
                                    @elseif($comms->user->parent->ranking_id == 3)
                                        BDD A
                                    @elseif($comms->user->parent->ranking_id == 4)
                                        BDD B
                                    @else
                                        CBDD
                                    @endif
                                </td>
                                <td>
                                    RM{{ $comms->user->parent->commissions->mo_overriding_comm }}
                                </td>
                            </tr>

                            {{-- 2nd Parent --}}
                            @if(isset($comms->user->parent->parent) && !empty($comms->user->parent->parent))
                                <tr>
                                    <td>
                                        {{ isset($comms->user->parent->parent->agent_code) ? $comms->user->parent->parent->agent_code: 'No Upperline' }}
                                    </td>
                                    <td>
                                        @if($comms->user->parent->parent->ranking_id)
                                            @if($comms->user->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($comms->user->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($comms->user->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($comms->user->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ $comms->user->parent->parent->commissions->mo_overriding_comm }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 3rd Parent --}}
                            @if(isset($comms->user->parent->parent->parent) && !empty($comms->user->parent->parent->parent))
                                <tr>
                                    <td>
                                        {{ isset($comms->user->parent->parent->parent->agent_code) ? $comms->user->parent->parent->parent->agent_code: 'No Upperline' }}
                                    </td>
                                    <td>
                                        @if($comms->user->parent->parent->parent->ranking_id)
                                            @if($comms->user->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($comms->user->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($comms->user->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($comms->user->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ $comms->user->parent->parent->parent->commissions->mo_overriding_comm }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 4th parent --}}
                            @if(isset($comms->user->parent->parent->parent->parent) && !empty($comms->user->parent->parent->parent->parent))
                                <tr>
                                    <td>
                                        {{ isset($comms->user->parent->parent->parent->parent->agent_code) ? $comms->user->parent->parent->parent->parent->agent_code: 'No Upperline' }}
                                    </td>
                                    <td>
                                        @if($comms->user->parent->parent->parent->parent->ranking_id)
                                            @if($comms->user->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($comms->user->parent->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($comms->user->parent->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($comms->user->parent->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ $comms->user->parent->parent->parent->parent->commissions->mo_overriding_comm }}
                                    </td>
                                </tr>
                            @endif

                            {{-- 5th parent --}}
                            @if(isset($comms->user->parent->parent->parent->parent->parent) && !empty($comms->user->parent->parent->parent->parent->parent))
                                <tr>
                                    <td>
                                        {{ isset($comms->user->parent->parent->parent->parent->parent->agent_code) ? $comms->user->parent->parent->parent->parent->parent->agent_code: 'No Upperline' }}
                                    </td>
                                    <td>
                                        @if($comms->user->parent->parent->parent->parent->parent->ranking_id)
                                            @if($comms->user->parent->parent->parent->parent->ranking_id == 1)
                                                SD
                                            @elseif($comms->user->parent->parent->parent->parent->parent->ranking_id == 2)
                                                DSD
                                            @elseif($comms->user->parent->parent->parent->parent->parent->ranking_id == 3)
                                                BDD A
                                            @elseif($comms->user->parent->parent->parent->parent->parent->ranking_id == 4)
                                                BDD B
                                            @else
                                                CBDD
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        RM{{ $comms->user->parent->parent->parent->parent->parent->commissions->mo_overriding_comm }}
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
