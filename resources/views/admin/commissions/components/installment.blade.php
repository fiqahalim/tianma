<div class="page-content container" style="background: white;">
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

    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle text-600 text-90">Customer Name:</span>
                            <span class="text-600 text-110 text-blue align-middle">
                                {{ $order->customer->full_name }}
                            </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    {{ trans('cruds.customer.fields.id_number') }}:
                                </span>
                                <span class="text-600 text-110 text-blue align-middle text-600 text-90">
                                    {{ $order->customer->id_number }}
                                </span>
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    Mobile:
                                </span>
                                <span class="text-600 text-110 text-blue align-middle text-600 text-90">
                                    <b class="text-600">{{ $order->customer->contact_person_no }}</b>
                                </span>
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    Intended User Name:
                                </span>
                                @foreach($order->customer->contactPersons as $intendedUser)
                                    <span class="text-600 text-110 text-blue align-middle">
                                        {{ $intendedUser->cperson_name ?? 'Not Available' }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    Intended User NRIC/Passport No.:
                                </span>
                                @foreach($order->customer->contactPersons as $intendedUser)
                                    <span class="text-600 text-110 text-blue align-middle">
                                        {{ $intendedUser->cid_number ?? 'Not Available' }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    Relationship:
                                </span>
                                @foreach($order->customer->contactPersons as $intendedUser)
                                    <span class="text-600 text-110 text-blue align-middle">
                                        {{ $intendedUser->relationships ?? 'Not Available' }}
                                    </span>
                                @endforeach
                            </div>
                            <br>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    Representative Name:
                                </span>
                                <span class="text-500 text-90 align-middle">
                                    <strong>{{ $order->customer->contact_person_name ?? '' }}</strong>
                                </span>
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    Representative NRIC No.:
                                </span>
                                <span class="text-500 text-90 align-middle">
                                    <strong>{{ $order->customer->cperson_id_number ?? '' }}</strong>
                                </span>
                            </div>
                            <div class="my-1">
                                <span class="text-sm text-grey-m2 align-middle text-600 text-90">
                                    {{ trans('cruds.user.fields.agent_code') }}:
                                </span>
                                <span class="text-500 text-90 align-middle">
                                    <strong>{{ $order->createdBy->agent_code ?? '' }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- order details --}}
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
                                    <th>Installment Period</th>
                                    <th width="140">Amount</th>
                                </tr>
                            </thead>

                            <tbody class="text-95 text-secondary-d3">
                                <tr>
                                    <td>
                                        {{ trans('cruds.product.fields.product_name') }} -
                                        <i>{{ $order->products->product_name ?? '' }}</i>
                                    </td>
                                    <td>
                                        {{ $order->products->product_id_number ?? '' }}
                                    </td>
                                    <td>
                                        {{ $order->products->product_code ?? '' }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ trans('cruds.product.fields.selling_price') }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->products->selling_price ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ trans('cruds.product.fields.maintenance_price') }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->products->maintenance_price ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ trans('cruds.product.fields.promotion_price') }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->products->promotion_price ?? '' }}
                                    </td>
                                </tr>
                                {{-- Installment Details --}}
                                <tr>
                                    <td>
                                        Monthly Installment Payment
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        RM {{ $order->installments->monthly_installment ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="center">
                                        <i>{{ $order->installments->installment_year ?? '' }} month(s)</i>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-8 text-grey-d2 text-95 mt-2 mt-lg-0">
                        </div>

                        <div class="col-12 col-sm-4 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-5 text-right">
                                    SubTotal
                                </div>
                                <div class="col-7">
                                    <span class="text-120 text-secondary-d1">RM {{ $order->products->total_cost ?? '' }}</span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-5 text-right">
                                    Downpayment
                                </div>
                                <div class="col-7">
                                    <span class="text-110 text-secondary-d1">RM {{ $order->installments->downpayment ?? '' }}</span>
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-5 text-right">
                                    Outstanding Amount
                                </div>
                                <div class="col-7">
                                    <span class="text-150 text-success-d3 opacity-2">
                                        <b>RM {{ $order->installments->outstanding_balance ?? '' }}</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small>This is a computer generated statement. No signature is required.</small>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
