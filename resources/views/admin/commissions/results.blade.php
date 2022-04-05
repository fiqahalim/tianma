@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.commission.title') }}</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.commission.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">Agent Code</th>
                            <th scope="col">Agent Ranking</th>
                            @if(isset($comms->orders->customer) ?? $comms->orders->customer->mode == 'Installment')
                                <th scope="col">New Point Value (PV)</th>
                            @else
                                <th scope="col">Point Value (PV)</th>
                            @endif
                            <th scope="col">Percentage (%)</th>
                            @if($comms->first_month > 0)
                                <th scope="col">First Month Payment</th>
                            @endif
                            <th scope="col">Commissions (Per Month)</th>
                            @if(isset($comms->orders->customer) ?? $comms->orders->customer->mode == 'Installment')
                                <th scope="col">Installments Period (Months)</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                            <td id="point_value" name="point_value">
                                {{ $comms->point_value }}
                            </td>
                            <td>
                                {{ $comms->percentage }}
                            </td>
                            @if($comms->first_month > 0)
                                <td>Yes</td>
                            @endif
                            <td>
                                RM {{ $comms->mo_overriding_comm }}
                            </td>
                            @if(isset($comms->orders->customer) ?? $comms->orders->customer->mode == 'Installment')
                                <td>
                                    {{ $comms->orders->installments->installment_year }} months
                                </td>
                            @endif
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
                            </tr>
                        </thead>
                        <tbody>
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
