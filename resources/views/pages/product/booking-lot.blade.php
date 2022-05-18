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
            <input type="text" name="price" hidden="">

            <img src="{{ $product->photo->url ?? '/images/product/luxury_1.png' }}" class="rounded mx-auto d-block" style="height: 300px; width: 485px;">
            <div class="movie-container">
                <h5><strong>Category Selected:</strong> {{ $product->product_name }}
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

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="seat-overview-wrapper">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="rooms" class="form-label font-weight-bold">Room</label>
                                <select class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} mb-3" name="rooms" required id="rooms">
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
                                <select class="form-control {{ $errors->has('sections') ? 'is-invalid' : '' }}" name="sections" id="sections" required>
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
                                <span class="help-block">{{ trans('cruds.order.fields.order_status_helper') }}</span>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-outline-dark mt-2 book-bus-btn btn-block">
                                {{ trans('global.products.product_select') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="seat-overview-wrapper">
                        <div class="booked-seat-details d-none">
                            <label class="form-label font-weight-bold">Selected Lots</label>
                            <div class="list-group seat-details-animate">
                                <span class="list-group-item d-flex bg--base text-white justify-content-between">
                                    Lots Details
                                </span>
                                <div class="selected-seat-details"></div>
                            </div>
                        </div>
                        <input type="text" name="seats" hidden="">
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4 col-md-6">
                    <h6 class="title">@lang('Click on Lot to select or deselect')</h6>
                    @foreach ($trip->bookingSection as $seat)
                        <div class="seat-plan-inner">
                            <div class="single">
                                @php
                                    echo $lotLayout->getDeckHeader($loop->index);
                                @endphp

                                @php
                                    $totalRow = $lotLayout->getTotalRow($seat);
                                    $lastRowSeat = $lotLayout->getLastRowSit($seat);
                                    $chr = 'A';
                                    $deckIndex = $loop->index + 1;
                                    $seatlayout = $lotLayout->lotLayouts();
                                    $rowItem = $seatlayout->left + $seatlayout->right;
                                @endphp

                                @for($i = 1; $i <= $totalRow; $i++)
                                    @php
                                        if($lastRowSeat==1 && $i==$totalRow -1)
                                        break;
                                        $seatNumber = $chr;
                                        $chr++;
                                        $seats = $lotLayout->getLots($deckIndex,$seatNumber);
                                    @endphp

                                    <div class="seat-wrapper">
                                        @php echo $seats->left; @endphp
                                        @php echo $seats->right; @endphp
                                    </div>
                                @endfor

                                @if($lastRowSeat == 1)
                                    @php $seatNumber++ @endphp
                                    <div class="seat-wrapper justify-content-center">
                                        @for ($lsr=1; $lsr <= $rowItem+1; $lsr++) @php echo $lotLayout->generateLots($lsr,$deckIndex,$seatNumber); @endphp
                                            @endfor
                                    </div>
                                @endif

                                @if($lastRowSeat > 1)
                                    @php $seatNumber++ @endphp
                                    <div class="seat-wrapper justify-content-center">
                                        @for($l = 1; $l <= $lastRowSeat; $l++) @php echo $lotLayout->generateLots($l,$deckIndex,$seatNumber); @endphp
                                        @endfor
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
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
@endsection
