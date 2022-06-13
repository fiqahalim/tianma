<div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Reference No: <strong>#{{ $order->ref_no ?? '' }}</strong>
        </h1>
        <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95 print-window" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
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
                                {{ $order->customer->full_name }}
                            </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle">
                                    {{ trans('cruds.customer.fields.id_number') }}:
                                </span>
                                <span class="text-500 text-90 align-middle">
                                    {{ $order->customer->id_number }}
                                </span>
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle">
                                    {{ trans('cruds.customer.fields.contact_person_name') }}:
                                </span>
                                <span class="text-500 text-90 align-middle">
                                    {{ $order->customer->contact_person_name}}
                                </span>
                            </div>
                            <div class="my-1">
                                <i class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                                <b class="text-600">{{ $order->customer->contact_person_no }}</b>
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle">
                                    {{ trans('cruds.user.fields.agent_code') }}:
                                </span>
                                <span class="text-500 text-90 align-middle">
                                    <strong>{{ $order->createdBy->agent_code ?? '' }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Order Details
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Ref No:</span> #{{ $order->ref_no ?? '' }}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{ trans('cruds.order.fields.order_date') }}:</span> {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</div>


                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{ trans('cruds.order.fields.order_status') }}:</span>
                                @if($order->order_status == 'In Progress' && $order->order_status == 'Pending')
                                    <span class="badge badge-warning badge-pill px-25">
                                        {{ $order->order_status ?? '' }}
                                    </span>
                                @elseif($order->order_status == 'Completed')
                                    <span class="badge badge-success badge-pill px-25">
                                        {{ $order->order_status ?? '' }}
                                    </span>
                                @elseif($order->order_status == 'Rejected')
                                    <span class="badge badge-danger badge-pill px-25">
                                        {{ $order->order_status ?? '' }}
                                    </span>
                                @else
                                    <span class="badge badge-primary badge-pill px-25">
                                        {{ $order->order_status ?? '' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 mt-2">
                        <h5>Next Payment Date: {{ Carbon\Carbon::parse($date)->format('d-M-Y') }}</h5>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                            <thead class="bg-none bgc-default-tp1">
                                <tr class="text-white">
                                    <th>Description</th>
                                    <th>Product ID Number</th>
                                    <th>Product Code</th>
                                    <th width="140">Amount</th>
                                </tr>
                            </thead>

                            @php
                                $getUnitNo = isset($order->lotID) ? $order->lotID->seats : '';
                                $unitNo = implode(" ",$getUnitNo);
                                $locations = isset($order->bookLocations) ? $order->bookLocations : '';
                                foreach ($locations as $details) {
                                    $place = $details->location;
                                    $type = $details->product_type;
                                    $building = $details->building_types;
                                    $level = $details->level;
                                    $category = $details->category;
                                }
                            @endphp

                            <tbody class="text-95 text-secondary-d3">
                                <tr>
                                    <td>
                                        <i> {{ $place }}, {{ $type }} {{ $building }} {{ $level }} {{ $category }}</i>
                                    </td>
                                    <td>
                                        {{ $unitNo ?? '' }}
                                    </td>
                                    <td>
                                        {{ $unitNo ?? '' }}
                                    </td>
                                    <td></td>
                                </tr>
                                {{-- <tr>
                                    <td>
                                        {{ trans('cruds.product.fields.selling_price') }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->lotID->selling_price ?? '' }}
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>
                                        {{ trans('cruds.product.fields.maintenance_price') }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->lotID->maintenance ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ trans('cruds.product.fields.promotion_price') }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->lotID->promo ?? '' }}
                                    </td>
                                </tr>
                                {{-- Installment Details --}}
                                <tr>
                                    <td>
                                        Monthly Installment <i>(11 months)</i>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->installments->monthly_installment ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Installment Balance <i>(last month)</i>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->installments->last_month_payment ?? '0.00' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1">RM {{ $order->lotID->price ?? '' }}</span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Downpayment (20%)
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1">RM {{ $order->installments->downpayment ?? '' }}</span>
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Outstanding Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2">RM {{ $order->installments->outstanding_balance ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
