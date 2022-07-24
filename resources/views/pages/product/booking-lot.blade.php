@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.new-order.index') }}">{{ trans('global.products.title') }}</a></li>
            <li class="breadcrumb-item">{{ trans('global.products.bookingView') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('global.products.bookingLot') }}</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.product-booking.store') }}" enctype="multipart/form-data" id="bookingForm">
            @csrf
            <input type="text" name="price" hidden="">

            @if($locations->category == 'Luxury')
                <img src="{{ $product->photo->url ?? '/images/product/luxury_layout.png' }}" class="rounded mx-auto d-block" style="height: 300px; width: 485px;">
            @elseif($locations->category == 'Premium')
                <img src="{{ $product->photo->url ?? '/images/product/premium_layout.png' }}" class="rounded mx-auto d-block" style="height: 300px; width: 485px;">
            @else
                <img src="{{ $product->photo->url ?? '/images/product/standard_layout.png' }}" class="rounded mx-auto d-block" style="height: 300px; width: 485px;">
            @endif

            <div class="movie-container">
                <h5><strong>Category Selected: {{ $locations->category ?? ''}}</strong>
                </h5>
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

            <div class="row mt-5 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="seat-overview-wrapper">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="rooms" class="form-label font-weight-bold">Room</label>
                                <select class="form-control {{ $errors->has('rooms') ? 'is-invalid' : '' }} mb-3" name="rooms" required id="rooms">
                                    @forelse($rooms as $r => $room)
                                        <option value="{{ $room }}" {{ old('name', '') === (string) $room ? 'selected' : '' }}>
                                            {{ $room }}
                                        </option>
                                    @empty
                                        <option>No rooms founds</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="section" class="form-label font-weight-bold">Section</label>
                                <select class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="wings" required>
                                    <option selected>{{ trans('global.pleaseSelect') }} section</option>
                                    <option value="DE">DE</option>
                                    <option value="DN">DN</option>
                                    <option value="DS">DS</option>
                                    <option value="DW">DW</option>
                                </select>
                                @if($errors->has('sections'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('section') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.order.fields.order_status_helper') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Reservation Lots</th>
                                    <th>Lot ID Number</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p>
                                            {{ strtoupper($locations->build_type) }}, {{ strtoupper($locations->level) }}, {{ strtoupper($locations->category) }}
                                        </p>
                                    </td>
                                    <td id="results">
                                    </td>
                                    <td id="prices"></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <input type="text" name="seats" hidden> --}}
                    </div>
                </div>
            </div>

            @if(isset($locations->product_type) && !empty($locations->product_type == 'Niche'))
                @if($locations->build_type == 'Tower East')
                    @if($locations->category == 'Luxury')
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_east.luxury_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_east.luxury_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_east.luxury_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_east.luxury_a.dw')
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @elseif($locations->category == 'Premium')
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_east.premium_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_east.premium_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_east.premium_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_east.premium_a.dw')
                                    </div>
                                </div>
                                  <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @else
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_east.superior_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_east.superior_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_east.superior_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_east.superior_a.dw')
                                    </div>
                                </div>
                                  <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @endif
                @elseif($locations->build_type == 'Tower North')
                    @if($locations->category == 'Luxury')
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_north.luxury_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_north.luxury_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_north.luxury_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_north.luxury_a.dw')
                                    </div>
                                </div>
                                  <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @elseif($locations->category == 'Premium')
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_north.premium_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_north.premium_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_north.premium_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_north.premium_a.dw')
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">
                                        {{ trans('global.products.product_select') }}
                                    </button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @else
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_north.superior_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_north.superior_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_north.superior_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_north.superior_a.dw')
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">
                                        {{ trans('global.products.product_select') }}
                                    </button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @endif
                @elseif($locations->build_type == 'Tower West')
                    @if($locations->category == 'Luxury')
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_west.luxury_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_west.luxury_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_west.luxury_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_west.luxury_a.dw')
                                    </div>
                                </div>
                                  <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @elseif($locations->category == 'Premium')
                        @if($room == 'Room A')
                            <div class="container">
                                <div class="DE GFG">
                                    @include('pages.product.components.tower_west.premium_a.de')
                                </div>
                                <div class="DN GFG">
                                    @include('pages.product.components.tower_west.premium_a.dn')
                                </div>
                                <div class="DS GFG">
                                    @include('pages.product.components.tower_west.premium_a.ds')
                                </div>
                                <div class="DW GFG">
                                    @include('pages.product.components.tower_west.premium_a.dw')
                                </div>
                                <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">
                                        {{ trans('global.products.product_select') }}
                                    </button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @else
                        @if($room == 'Room A')
                            <div class="container">
                                <div class="DE GFG">
                                    @include('pages.product.components.tower_west.superior_a.de')
                                </div>
                                <div class="DN GFG">
                                    @include('pages.product.components.tower_west.superior_a.dn')
                                </div>
                                <div class="DS GFG">
                                    @include('pages.product.components.tower_west.superior_a.ds')
                                </div>
                                <div class="DW GFG">
                                    @include('pages.product.components.tower_west.superior_a.dw')
                                </div>
                                <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">
                                        {{ trans('global.products.product_select') }}
                                    </button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @endif
                @else
                    @if($locations->category == 'Luxury')
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_south.luxury_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_south.luxury_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_south.luxury_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_south.luxury_a.dw')
                                    </div>
                                </div>
                                  <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">{{ trans('global.products.product_select') }}</button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @elseif($locations->category == 'Premium')
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_south.premium_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_south.premium_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_south.premium_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_south.premium_a.dw')
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">
                                        {{ trans('global.products.product_select') }}
                                    </button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
                    @else
                        @if($room == 'Room A')
                            <div class="container">
                                <div id="container-seats">
                                    <div class="DE GFG">
                                        @include('pages.product.components.tower_south.superior_a.de')
                                    </div>
                                    <div class="DN GFG">
                                        @include('pages.product.components.tower_south.superior_a.dn')
                                    </div>
                                    <div class="DS GFG">
                                        @include('pages.product.components.tower_south.superior_a.ds')
                                    </div>
                                    <div class="DW GFG">
                                        @include('pages.product.components.tower_south.superior_a.dw')
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="text" name="seat" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn">
                                        {{ trans('global.products.product_select') }}
                                    </button>
                                </div>
                            </div>
                        @elseif($room == 'Room B')
                        @else
                        @endif
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
{{--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script type="text/javascript" src="{{ mix('/js/pages/booking.js') }}"></script>
    <script>
        //booking form submit
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
            let selectedSeats = $('.seat.selected');

            if (selectedSeats.length > 0) {
                var modal = $('#bookConfirm');
                modal.modal('hide');
                document.getElementById("bookingForm").submit();
            } else {
                notify('error', 'Select at least one lot.');
            }
        });

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

        // update text area
        $(document).ready(displayCheckbox);
        function displayCheckbox() {
            var checkboxes = $("input[type=checkbox]");
            var results = $("#results");
            var prices = $("#prices");

            $.each(checkboxes, function() {
                $(this).change(printChecked);
                $(this).change(printPrice);
            })

            function printChecked() {
                var checkedValues = [];
                checkboxes.each(function() {
                    if($(this).is(':checked')) {
                        checkedValues.push($(this).attr('value'));
                    }
                });
                results.text(checkedValues);
            }

            function printPrice() {
                var checkedIds = [];
                checkboxes.each(function() {
                    if($(this).is(':checked')) {
                        checkedIds.push($(this).attr('id'));
                    }
                });
                prices.text(checkedIds);
            }
        }
    </script>

    <script>
        // checkbox color changed
        $(function() {
            // current date time
            function padTo2Digits(num) {
                return num.toString().padStart(2, '0');
            }

            function formatDate(date) {
                return ([
                    date.getFullYear(),
                    padTo2Digits(date.getMonth() + 1),
                    padTo2Digits(date.getDate()),
                    ].join('-') + ' ' +
                    [
                    padTo2Digits(date.getHours()),
                    padTo2Digits(date.getMinutes()),
                    padTo2Digits(date.getSeconds()),
                    ].join(':'));
            }
            var currentDate = formatDate(new Date());

            let items = [];

            // program to extract value as an array from an array of objects
            function extractValue(arr, prop) {
                // extract value from property
                let extractedValue = arr.map(item => item[prop]);
                return extractedValue;
            }

            function extractDate(arr, prop) {
                let extractedDateValue = arr.map(item => item[prop]);
                return extractedDateValue;
            }

            const objArray = {!! $reserveLots !!}
            const availableData = {!! $available !!}
            const expiryDate = {!! $deceased !!}

            // passing an array of objects and property 'a' to extract
            const result = extractValue(objArray, 'seats');
            const dateResult = extractDate(expiryDate, 'expiry_date');
            const availResult = extractValue(availableData, 'available');

            var flatArray = Array.prototype.concat.apply([], result);
            var dateArray = Array.prototype.concat.apply([], dateResult);

            console.log(result);
            console.log(flatArray);
            console.log(expiryDate);
            console.log(dateResult);
            console.log(availResult);

            console.log(dateArray);
            console.log(currentDate);

            var seats = document.getElementsByClassName('seat');

            for (var j = 0; j < seats.length; j++) {
                flatArray.map(function(v) {
                    if (seats[j].value === v) {
                        console.log("okay", v)
                        seats[j].setAttribute("disabled", "true");
                        // seats[j].setAttribute("checked", "false");
                    }
                });
            }
        });
    </script>
@endsection
