@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.new-order.index') }}">{{ trans('global.products.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('global.products.bookingView') }}</li>
            <li class="breadcrumb-item">{{ $product->product_name }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('global.products.bookingLot') }}</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <form method="POST" action="#" enctype="multipart/form-data" id="bookingForm">
            @method('PUT')
            @csrf
            <img src="{{ $product->photo->url ?? '/images/product/luxury_1.png' }}" class="rounded mx-auto d-block" style="height: 300px; width: 485px;">
            <div class="movie-container">
                <h5><strong>Category Selected:</strong> {{ $product->product_name }}
                </h5>

                {{-- select rooms --}}
                <select class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} mb-3" name="name" required>
                    @forelse($rooms as $r => $room)
                        <option value="{{ $r }}" {{ old('name', '') === (string) $r ? 'selected' : '' }}>
                            {{ $room }}
                        </option>
                    @empty
                        <option>No rooms founds</option>
                    @endforelse
                </select>

                {{-- select sections --}}
                <select class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="wings" required>
                    <option selected>{{ trans('global.pleaseSelect') }} section</option>
                    <option value="DA">DA</option>
                    <option value="DB">DB</option>
                    <option value="DC">DC</option>
                    <option value="DD">DD</option>
                </select>
                @if($errors->has('section'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_status_helper') }}</span>
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
                <div id="container-seats">
                    {{-- @php
                        echo $lotLayout->getDeckHeader($loop->index);
                    @endphp

                    @php
                        $totalRow = $lotLayout->getTotalRow($seat);
                        $lastRowSeat = $lotLayout->getLastRowSit($seat);
                        $chr = 'A';
                        $seatlayout = $lotLayout->lotLayouts();
                        $rowItem = $seatlayout->left + $seatlayout->right;
                    @endphp --}}
                    <div class="DA GFG">
                        @include('pages.product.components.da')
                    </div>
                    <div class="DB GFG">
                        @include('pages.product.components.db')
                    </div>
                    <div class="DC GFG">
                        @include('pages.product.components.dc')
                    </div>
                    <div class="DD GFG">
                        @include('pages.product.components.dd')
                    </div>
                </div>

                <p class="text-center mt-3">
                    You have selected <span id="count">
                        0
                    </span> lot(s)
                </p>

                  <div class="text-center">
                    <a class="btn btn-outline-primary mt-2" id="bookConfirm" href="{{ route('admin.customer-details.index', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}">
                        {{ trans('global.products.product_select') }}
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- modal --}}

@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/booking.css') }}"  media="screen,projection"/>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/js/pages/booking.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("select").on('change', function() {
                $(this).find("option:selected").each(function() {
                    var geeks = $(this).attr("value");
                    if (geeks) {
                        $(".GFG").not("." + geeks).hide();
                        $("." + geeks).show();
                    } else {
                        $(".GFG").hide();
                    }
                });
            }).change();
        });

        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();
            let selectedSeats = $('.seat.selected');
            if (selectedSeats.length > 0) {
                var modal = $('#bookConfirm');
                modal.modal('show');
            } else {
                notify('error', 'Select at least one lot.');
            }
        });
    </script>
@endsection
