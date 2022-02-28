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
                @include('admin.commissions.components.installment')
            @else
                @include('admin.commissions.components.fullpayment')
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
    <link href="{{ mix('/css/pages/invoice.css') }}" rel="stylesheet" media="print" type="text/css">
@endsection

@section('scripts')
<script>
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
