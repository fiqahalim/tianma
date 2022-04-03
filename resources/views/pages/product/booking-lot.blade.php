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
        <form method="POST" action="{{ route('admin.product-booking.store', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}" enctype="multipart/form-data" id="bookingForm">
            @csrf

            <img src="{{ $product->photo->url ?? '/images/product/luxury_1.png' }}" class="rounded mx-auto d-block" style="height: 300px; width: 485px;">
            <div class="movie-container">
                <h5><strong>Category Selected:</strong> {{ $product->product_name }}
                </h5>

                {{-- select rooms --}}
                <select class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} mb-3" name="rooms" required id="rooms">
                    @forelse($rooms as $r => $room)
                        <option value="{{ $room }}" {{ old('name', '') === (string) $room ? 'selected' : '' }}>
                            {{ $room }}
                        </option>
                    @empty
                        <option>No rooms founds</option>
                    @endforelse
                </select>

                {{-- select sections --}}
                {{-- <select class="form-control {{ $errors->has('sections') ? 'is-invalid' : '' }}" name="sections" id="sections" required>
                    @forelse($sections as $sc => $section)
                        <option value="{{ $sc }}" {{ old('section', '') === (string) $sc ? 'selected' : '' }}>
                            {{ $section }}
                        </option>
                    @empty
                        <option>No section founds</option>
                    @endforelse
                </select>
                @if($errors->has('sections'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_status_helper') }}</span> --}}

                <select class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="wings" required>
                    <option selected>{{ trans('global.pleaseSelect') }} section</option>
                    <option value="DA">DA</option>
                    <option value="DB">DB</option>
                    {{-- <option value="DC">DC</option>
                    <option value="DD">DD</option> --}}
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

            @if(isset($locations->product_type) && !empty($locations->product_type == 'Niche'))
                @if($locations->build_type == 'Tower 1')
                    @if($room == 'Room A')
                        <div class="container">
                            <div id="container-seats">
                                <div class="DA GFG">
                                    @include('pages.product.components.room_a.da')
                                </div>
                                <div class="DB GFG">
                                    @include('pages.product.components.room_a.db')
                                </div>
                                <div class="DC GFG">
                                    @include('pages.product.components.room_a.dc')
                                </div>
                                <div class="DD GFG">
                                    @include('pages.product.components.room_a.dd')
                                </div>
                            </div>

                              <div class="text-center">
                                <input type="text" name="seat" hidden>
                                <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div id="container-seats">
                                <div class="DA GFG">
                                    @include('pages.product.components.room_b.da')
                                </div>
                                <div class="DB GFG">
                                    @include('pages.product.components.room_b.db')
                                </div>
                                <div class="DC GFG">
                                    @include('pages.product.components.room_b.dc')
                                </div>
                                <div class="DD GFG">
                                    @include('pages.product.components.room_b.dd')
                                </div>
                            </div>

                              <div class="text-center">
                                <input type="text" name="seat" hidden>
                                <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                            </div>
                        </div>
                    @endif
                @elseif($locations->build_type == 'Tower 2')
                    @if($room == 'Room A')
                        <div class="container">
                            <div id="container-seats">
                                <div class="DA GFG">
                                    @include('pages.product.components.tower_2.room_a.da')
                                </div>
                                <div class="DB GFG">
                                    @include('pages.product.components.tower_2.room_a.db')
                                </div>
                                <div class="DC GFG">
                                    @include('pages.product.components.tower_2.room_a.dc')
                                </div>
                                <div class="DD GFG">
                                    @include('pages.product.components.tower_2.room_a.dd')
                                </div>
                            </div>

                              <div class="text-center">
                                <input type="text" name="seat" hidden>
                                <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div id="container-seats">
                                <div class="DA GFG">
                                    @include('pages.product.components.tower_2.room_b.da')
                                </div>
                                <div class="DB GFG">
                                    @include('pages.product.components.tower_2.room_b.db')
                                </div>
                                <div class="DC GFG">
                                    @include('pages.product.components.tower_2.room_b.dc')
                                </div>
                                <div class="DD GFG">
                                    @include('pages.product.components.tower_2.room_b.dd')
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="text" name="seat" hidden>
                                <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn" onclick="updateTextArea()">
                                    {{ trans('global.products.product_select') }}
                                </button>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </form>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="bookConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Confirm Booking')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure to book these lot(s)?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btnBookConfirm">@lang("Confirm")</button>
                </div>
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

        //confirmation modal
        $(document).on('click', '#btnBookConfirm', function(e) {
            var modal = $('#bookConfirm');
            modal.modal('hide');
            document.getElementById("bookingForm").submit();
        });
    </script>
@endsection
