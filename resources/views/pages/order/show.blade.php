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
                    @if($order->customer->mode == 'Installment')
                        <a class="btn btn-primary mx-1px text-95" href="{{ route('user.transaction.index', [$order->id]) }}">
                            View Installment Details
                        </a>
                    @endif
                    <a class="btn bg-white btn-light mx-1px text-95 print-window" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                @if(isset($order->customer) ?? $order->customer->mode == 'Installment')
                    @include('pages.order.components.installment')
                @else
                    @include('pages.order.components.fullpayment')
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                @if($order->customer->mode == 'Installment')
                    @include('pages.order.components.all-details')
                @else
                    @include('pages.order.components.fullpayment-details')
                @endif
            </div>
        </div>
    </div>

    <div class="row ml-2">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('user.my-orders.index') }}">
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
<script>
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
