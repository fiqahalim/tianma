@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.products.index') }}">{{ trans('global.products.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('global.products.bookingView') }}</li>
            <li class="breadcrumb-item">{{ $product->product_name }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('global.products.bookingLot') }}</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <img src="{{ $product->photo->url ?? '/images/product/luxury_1.png' }}" class="rounded mx-auto d-block" >
        <div class="movie-container">
            <h5><strong>Category Selected:</strong> {{ $product->product_name }}
            </h5>
            <select class="form-select" aria-label="Default select example" id="wings">
                <option selected>Please choose</option>
                <option value="1">DA</option>
                <option value="2">DB</option>
                <option value="3">DC</option>
                <option value="4">DD</option>
            </select>
        </div>
        <ul class="showcase">
            <li>
                <div class="seat"></div>
                <small class="font-weight-bold">Available</small>
            </li>
            <li>
                <div class="seat selected"></div>
                <small class="font-weight-bold">Selected</small>
            </li>
            <li>
                <div class="seat occupied"></div>
                <small class="font-weight-bold">Occupied</small>
            </li>
        </ul>

        <div class="container">
            <form method="POST" action="#">
                @csrf
                <div id="container-seats">
                    <div class="row-seat">
                        <div id="1" class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                    </div>
                    <div class="row-seat">
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                    </div>
                    <div class="row-seat">
                        <div class="seat"></div>
                        <div class="seat occupied"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat occupied"></div>
                        <div class="seat"></div>
                    </div>
                    <div class="row-seat">
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                    </div>
                    <div class="row-seat">
                        <div class="seat occupied"></div>
                        <div class="seat"></div>
                        <div class="seat occupied"></div>
                        <div class="seat"></div>
                        <div class="seat occupied"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                    </div>
                    <div class="row-seat">
                        <div class="seat occupied"></div>
                        <div class="seat occupied"></div>
                        <div class="seat"></div>
                        <div class="seat occupied"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                        <div class="seat"></div>
                    </div>
                </div>
            </form>

            <p class="text-center mt-3">
                You have selected <span id="count">
                    0
                </span> lot(s)
            </p>

              <div class="text-center">
                <a class="btn btn-outline-primary mt-2" href="{{ route('user.customerdetails.index', [$product->categories->first()->parentCategory->parentCategory->slug,
                    $product->categories->first()->parentCategory->slug, $product->categories->first()->slug, $product->slug, $product]) }}">
                        {{ trans('global.products.product_select') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/booking.css') }}"  media="screen,projection"/>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/js/pages/booking.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#wings').on('change', function() {
                alert($(this).val());
            });
        });
    </script>
@endsection
