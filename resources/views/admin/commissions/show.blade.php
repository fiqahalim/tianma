@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.commission.title') }}</li>
    </ol>
</nav>

<div class="card">
    {{-- <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.commission.title') }}
    </div> --}}

    <div class="card-body">
        <div class="form-group">
            @if($commission->orders->customer->mode == 'Installment')
                <div class="page-content container">
                    <div class="page-header text-blue-d2">
                        <h1 class="page-title text-secondary-d1">
                            Reference No: #{{ $commission->orders->ref_no ?? '' }}
                        </h1>
                        <div class="page-tools">
                            <div class="action-buttons">
                                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                                    Print
                                </a>
                                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                                    Export
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="container px-0">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <span class="text-sm text-grey-m2 align-middle">Customer Name:</span>
                                            <span class="text-600 text-110 text-blue align-middle">
                                                {{ $commission->orders->customer->full_name }}
                                            </span>
                                        </div>
                                        <div class="text-grey-m2">
                                            <div class="my-1">
                                                <span class="text-sm text-grey-m2 align-middle">
                                                    {{ trans('cruds.customer.fields.id_number') }}:
                                                </span>
                                                <span class="text-500 text-90 align-middle">
                                                    {{ $commission->orders->customer->id_number }}
                                                </span>
                                            </div>
                                            <div class="my-1">
                                                <span class="text-sm text-grey-m2 align-middle">
                                                    {{ trans('cruds.customer.fields.contact_person_name') }}:
                                                </span>
                                                <span class="text-500 text-90 align-middle">
                                                    {{ $commission->orders->customer->contact_person_name}}
                                                </span>
                                            </div>
                                            <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ $commission->orders->customer->contact_person_no }}</b></div>
                                        </div>
                                    </div>

                                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                        <hr class="d-sm-none" />
                                        <div class="text-grey-m2">
                                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                                Order Details
                                            </div>

                                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Ref No:</span> #{{ $commission->orders->ref_no ?? '' }}</div>

                                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{ trans('cruds.order.fields.order_date') }}:</span> {{ Carbon\Carbon::parse($commission->orders->created_at)->format('d/m/Y') }}</div>


                                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{ trans('cruds.order.fields.order_status') }}:</span> <span class="badge badge-warning badge-pill px-25">{{ $commission->orders->order_status ?? '' }}</span></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                            <thead class="bg-none bgc-default-tp1">
                                                <tr class="text-white">
                                                    <th class="opacity-2">#</th>
                                                    <th>Description</th>
                                                    <th>Qty</th>
                                                    <th>Unit Price</th>
                                                    <th width="140">Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-95 text-secondary-d3">
                                                <tr></tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Domain registration</td>
                                                    <td>2</td>
                                                    <td class="text-95">$10</td>
                                                    <td class="text-secondary-d2">$20</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row border-b-2 brc-default-l2"></div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                            Extra note such as company or payment information...
                                        </div>

                                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    SubTotal
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-120 text-secondary-d1">$2,250</span>
                                                </div>
                                            </div>

                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    Downpayment (20%)
                                                </div>
                                                <div class="col-5">
                                                    {{ dd($commission->orders->customer) }}
                                                    <span class="text-110 text-secondary-d1">RM {{ $commission->orders->installments ?? '' }}</span>
                                                </div>
                                            </div>

                                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                                <div class="col-7 text-right">
                                                    Total Amount
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-150 text-success-d3 opacity-2">RM {{ $commission->orders->amount ?? '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.commission.fields.commission') }}
                            </th>
                            <td>
                                RM {{ $commission->mo_overriding_comm }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.commission.fields.increased_commission') }}
                            </th>
                            <td>
                                {{ $commission->mo_spin_off ?? 'Not eligible yet' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.commission.fields.user') }}
                            </th>
                            <td>
                                {{ $commission->user->agent_code ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.commission.fields.order') }}
                            </th>
                            <td>
                                #{{ $commission->orders->ref_no ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/invoice.css') }}"  media="screen,projection"/>
@endsection
