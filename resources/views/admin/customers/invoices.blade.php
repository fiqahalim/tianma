@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
            <li class="breadcrumb-item">{{ trans('cruds.customer.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">View Order Details</li>
        </ol>
    </nav>

    <div style="margin-bottom: 10px;" class="row text-right mr-2">
        <div class="col-lg-12">
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95 print-window" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="card">
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

                    <h4 class="mt-5 text-center"><u>{{ __('REVIEW ORDER') }}</u></h4>
                    <form method="POST" action="#" enctype="multipart/form-data" id="review-order">
                    @csrf
                        <div class="card-body">
                            {{-- Purchaser Info --}}
                            @include('admin.customers.includes.purchaser-info')

                            {{-- Intended User Details --}}
                            @include('admin.customers.includes.intended-info')

                            {{-- Product Info --}}
                            @include('admin.customers.includes.product-info')

                            {{-- Reservation Information --}}
                            @include('admin.customers.includes.reservation-info')

                            {{-- Payment Information --}}
                            @include('admin.customers.includes.payment-info')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-3">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
