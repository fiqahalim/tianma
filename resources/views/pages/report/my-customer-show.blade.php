@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">My {{ trans('cruds.customer.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.customer.title') }}</li>
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
                    <h4 class="mt-5 text-center">Review Order</h4>
                    <form method="POST" action="#" enctype="multipart/form-data" id="review-order">
                    @csrf
                        <div class="card-body">
                            {{-- Purchaser Info --}}
                            @include('pages.report.includes.purchaser-info')

                            {{-- Intended User Details --}}
                            @include('pages.report.includes.intended-info')

                            {{-- Product Info --}}
                            @include('pages.report.includes.product-info')

                            {{-- Reservation Information --}}
                            @include('pages.report.includes.reservation-info')

                            {{-- Payment Information --}}
                            @include('pages.report.includes.payment-info')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-3">
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('user.myCustomers') }}">
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
