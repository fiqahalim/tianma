@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
        <li class="breadcrumb-item">{{ trans('cruds.customer.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.customer.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.customer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group ml-3">
            <div class="page-content container" style="background: white;">
                <div class="row">
                    <div class="col-4 text-center">
                        <figure class="figure">
                            <img src="{{ '/images/tianma_logo_op-01a.png' }}" class="figure-img img-fluid rounded mt-2" style="height: 125px; width: 13rem;">
                        </figure>
                    </div>
                    <div class="col-8 mt-4">
                        <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;">
                            <strong>TIANMA MEMORIAL HOLDINGS BERHAD</strong>
                            <small><b>202101043182 (1443482 A)</b></small><br>
                            Corporate Tower, Level 5, Jalan Pahat L 15/L, Section 15,<br>
                            40200 Shah Alam , Selangor<br>
                            Tel : 010-951 3688 &nbsp;&nbsp; Website : www.tianma.my
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-6 text-center">
                        <h4><strong><u>CUSTOMER DETAILS</u></strong></h4>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="text-dark-m2">
                            <div class="my-1">
                                <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;">
                                    {{ Str::upper($customer->full_name) }} <br>
                                    {{ $customer->id_number }} <br>
                                    {{ Str::upper($customer->address_1) }} <br>
                                    @if(isset($customer->address_2) && !empty($customer->address_2))
                                        {{ Str::upper($customer->address_2) }} <br>
                                    @endif
                                    {{ Str::upper($customer->postcode) }}
                                    {{ Str::upper($customer->city) }}
                                    {{ Str::upper($customer->state) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mt-5 ml-3">
            <h4>Customer's Order Lists</h4>
            <table class="table table-bordered table-striped table-hover datatable datatable-Intended">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.order.fields.id') }}</th>
                        <th>
                            {{ trans('cruds.order.fields.order_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.ref_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_status') }}
                        </th>
                        <th>
                            Product Amount (RM)
                        </th>
                        <th>Payment Mode</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->orders as $order)
                    <tr data-entry-id="{{ $order->id }}">
                        <td></td>
                        <td>{{ $order->id }}</td>
                        <td>
                            {{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y H:i:s') }}
                        </td>
                        <td>
                            #{{ $order->ref_no ?? '' }}
                        </td>
                        <td>
                            {{ Str::upper($order->order_status ?? '') }}
                        </td>
                        <td>
                            {{ Str::upper($order->amount ?? '') }}
                        </td>
                        <td>{{ Str::upper($customer->mode) }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.customers.showInvoice', $order->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/invoice.css') }}"  media="screen,projection"/>
    <link href="{{ mix('/css/pages/invoice.css') }}" rel="stylesheet" media="print" type="text/css">
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
                    visible: false
                }
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        });
        let table = $('.datatable-Intended:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
