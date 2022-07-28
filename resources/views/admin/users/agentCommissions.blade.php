@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.userManagement.title') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ trans('cruds.user.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Agent's Commission</li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row text-right">
        <div class="col-lg-12">
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" data-title="Print" onClick="printReport()">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card" id="agentCommissionPrint">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} Agent's {{ trans('cruds.commission.title') }}
        </div>

        <div class="card-body">
            {{-- Agent Information --}}
            <div class="form-group mb-5">
                <h5>Agent Information</h5>
                <table class="table table-bordered table-light">
                    <thead>
                        <tr class="table-success">
                            <th>Joined Date</th>
                            <th>Agent Name</th>
                            <th>Agent ID/Passport Number</th>
                            <th>Agent Contact No.</th>
                            <th>Agent Code</th>
                            <th>Agent Ranking</th>
                            <th>Agency Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ strtoupper(Carbon\Carbon::parse($user->created_at)->format('d F Y')) }}</td>
                            <td>{{ strtoupper($user->name) }}</td>
                            <td>{{ strtoupper($user->id_number) }}</td>
                            <td>{{ strtoupper($user->contact_no) }}</td>
                            <td>{{ strtoupper($user->agent_code) }}</td>
                            <td>{{ strtoupper($user->rankings->category) }}</td>
                            <td>{{ strtoupper($user->agency_code ?? 'No Information') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Order's Information --}}
            <div class="form-group mb-5">
                <h5>Agent's Order Information</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th>Order Created</th>
                            <th>Reservation Lot Number</th>
                            <th>Purchaser Name</th>
                            <th>Purchaser ID/Passport Number</th>
                            <th>Product Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $getUnitNo = isset($user->order) && is_array($user->order->lotID->seats) ? $user->order->lotID->seats : [];
                            $orderDate = isset($user->order->created_at) ? $user->order->created_at : '';
                            $unitNo = implode(" ", $getUnitNo);
                            $extractData = explode(",", $unitNo);
                        @endphp
                        <tr>
                            <td>{{ Carbon\Carbon::parse($orderDate)->format('d/M/Y H:i:s') }}</td>
                            <td>{{ $extractData[0] ?? 'No Information' }}</td>
                            <td>{{ $user->order->customer->full_name ?? 'No Information' }}</td>
                            <td>{{ $user->order->customer->id_number ?? 'No Information' }}</td>
                            <td>RM{{ $extractData[1] ?? '0' }}.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Commission's Information --}}
            <div class="form-group mb-5">
                <h5>Agent's Commissions Information</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th>Commission Received Month</th>
                            <th>Agent Ranking</th>
                            <th>Commission Received <i>(per Installment)</i></th>
                            <th>Agent Commission Percentage(%)</th>
                            <th>Point Value (PV) Claimed</th>
                            <th>Installment Balance Point Value (PV)</th>
                            <th>Monthly Total Commissions Received</th>
                            <th>Monthly Spin Off Overriding</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Upperline Information --}}
            <div class="form-group">
                <h5>Upperline's Commissions Information</h5>
                <table class="table table-light table-bordered">
                    <thead>
                        <tr class="table-warning">
                            <th>Commission Received Month</th>
                            <th>Upperline Agent Ranking</th>
                            <th>Upperline Agent Name</th>
                            <th>Upperline Agent Code</th>
                            <th>Upperline Agency Code</th>
                            <th>Point Value (PV) Claimed</th>
                            <th>Upperline Commission Percentage(%)</th>
                            <th>Upperline First Month Commissions Received</th>
                            <th>Upperline Monthly Total Commission</th>
                            <th>Upperline Monthly Spin Off Overriding</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="form-group">
        <a class="btn btn-default" href="{{ route('admin.users.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/invoice.css') }}"  media="screen,projection"/>
    <link href="{{ mix('/css/pages/invoice.css') }}" rel="stylesheet" media="print" type="text/css">
@endsection

@section('scripts')
<script type="text/javascript">
    function printReport()
    {
        var prtContent = document.getElementById("agentCommissionPrint");
        var WinPrint = window.open();
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }

    function printItem()
    {
        var prtItem = document.getElementById("itemPrint");
        var WinPrint = window.open();
        WinPrint.document.write(prtItem.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
</script>
@endsection
