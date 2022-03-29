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
            <a class="btn btn-dark" href="#" data-toggle="modal" data-target="#invoiceDetailsModal">
                Invoice Settings
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                @if($order->customer->mode == 'Installment')
                    @include('admin.commissions.components.installment')
                @else
                    @include('admin.commissions.components.fullpayment')
                @endif

                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.orders.components.modal')
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
