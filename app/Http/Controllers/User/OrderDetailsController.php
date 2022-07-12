<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\User;
use App\Models\Location;
use App\Models\ProductType;
use App\Models\BuildingType;
use App\Models\Level;
use App\Models\Room;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductBooking;
use App\Models\BookingSection;
use App\Models\BookLocation;

use Carbon\Carbon;
use NumberToWords\NumberToWords;

class OrderDetailsController extends Controller
{
    public function index()
    {
        $myOrders = Order::where([
                ['created_by', auth()->user()->id]
            ])
            ->get();

        return view('pages.order.index', compact('myOrders'));
    }

    public function show($id)
    {
        $order = Order::find($id);

        $order->load('customer', 'createdBy', 'products', 'bookLocations', 'installments', 'fullPayments');

        if($order->customer->mode == 'Installment') {
            $amount = isset($order->installments->downpayment) ? $order->installments->downpayment : '0.00';
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);

            $today = Carbon::today();
            $date = $today->addMonth(1);
        } else {
            $amount = isset($order->amount) ? $order->amount : null;
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);

            $today = Carbon::today();
            $date = $today->addMonth(1);
        }

        return view('pages.order.show', compact('order', 'date', 'amountFormat'));
    }

    public function location()
    {
        $locations = Location::pluck('location_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $properties = ProductType::pluck('property_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $buildings = BuildingType::pluck('building_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $levels = Level::pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $category = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('pages.order.location', compact('locations', 'properties', 'buildings', 'levels', 'category'));
    }

    public function store(Request $request)
    {
        $bookLocation = null;
        $bookLocation = new BookLocation;
        $bookLocation->location = $request->location_name;
        $bookLocation->product_type = $request->property_name;
        $bookLocation->build_type = $request->building_name;
        $bookLocation->level = $request->level_name;
        $bookLocation->category = $request->name;
        $bookLocation->save();

        session(['bookLocation' => $bookLocation]);

        return redirect()->route('user.reviewLot');
    }

    public function reviewLot(Request $request)
    {
        $locations = session('bookLocation');
        $rooms = Room::pluck('name', 'id')->prepend(trans('Please select room'), '');
        $sections = BookingSection::pluck('section', 'id')->prepend(trans('Please select section'), '');

        $reserveLots = ProductBooking::all('seats');
        $available = ProductBooking::all('available');

        $deceased = ProductBooking::join('orders', 'orders.product_bookings_id', '=', 'product_bookings.id')
            ->whereMonth('orders.expiry_date', '<=', Carbon::now()->month)
            ->whereYear('orders.expiry_date', '<=', Carbon::now()->year)
            ->get(['orders.expiry_date']);

        return view('pages.order.booking-lot', compact('rooms', 'sections', 'locations', 'reserveLots', 'deceased', 'available'));
    }
}
