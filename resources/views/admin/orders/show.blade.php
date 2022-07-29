@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.order.title') }}</li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row text-right">
        <div class="col-lg-12">
            <div class="page-tools">
                <div class="action-buttons">
                    {{-- <a class="btn btn-primary mx-1px text-95" href="#">
                        Tax Invoice
                    </a> --}}
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print" onclick="printReport()">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card" id="invoicePrint">
        <div class="card-body">
            <div class="form-group">
                @if($order->customer->mode == 'Installment')
                    @include('admin.orders.components.installment')
                @else
                    @include('admin.orders.components.fullpayment')
                @endif
            </div>
        </div>
    </div>

    <div class="card" id="itemPrint">
        <div class="card-body">
            <div class="form-group">
                @if($order->customer->mode == 'Installment')
                    @include('admin.orders.components.all-details')
                @else
                    @include('admin.orders.components.fullpayment-details')
                @endif
            </div>
        </div>
    </div>

    <div class="row ml-2">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
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
        var prtContent = document.getElementById("invoicePrint");
        var WinPrint = window.open();
        // WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.write( "<link rel='stylesheet' href='/public/css/pages/invoice.css' type='text/css' media='print'/>" );
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
