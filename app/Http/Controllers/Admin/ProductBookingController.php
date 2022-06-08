<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Lib\LotLayout;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductBooking;
use App\Models\BookingSection;
use App\Models\Customer;
use App\Models\Level;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Alert;

class ProductBookingController extends Controller
{
    public function index(Request $request)
    {
        $locations = session('bookLocation');
        // $product->load('categories.parentCategory');
        $rooms = Room::pluck('name', 'id')->prepend(trans('Please select room'), '');
        $sections = BookingSection::pluck('section', 'id')->prepend(trans('Please select section'), '');

        $reserveLots = ProductBooking::all('seats');

        $deceased = ProductBooking::join('orders', 'orders.product_bookings_id', '=', 'product_bookings.id')
            ->whereMonth('orders.expiry_date', '<=', Carbon::now()->month)
            ->whereYear('orders.expiry_date', '<=', Carbon::now()->year)
            ->get(['orders.expiry_date']);

        // session(['products' => $product]);

        // $trip = Product::with(['bookingSection', 'productBooked'])
        //     ->where('id', $product->id)
        //     ->firstOrFail();

        // $lotLayout = new LotLayout($trip);

        return view('pages.product.booking-lot', compact('rooms', 'sections', 'locations', 'reserveLots', 'deceased'));
    }

    // save booking
    public function store(Request $request)
    {
        $products = session('products');
        $locations = session('bookLocation');

        $booking = null;
        $booking = new ProductBooking;
        $booking->seats = $request->seats;
        // $booking->product_id = $products->id;
        $booking->book_locations_id = $locations->id;
        $booking->save();

        session(['reservedLot' => $booking]);

        return redirect()->route('admin.customer-details.index');
    }

    // save booking lot
    public function productBooked(Request $request, $id)
    {
        $request->validate([
            "seats"           => "required|string",
        ],[
            "seats.required"  => "Please Select at Least One Lot"
        ]);

        $booked_ticket  = ProductBooking::whereJsonContains('seats', rtrim($request->seats, ","))->get();

        $seats = array_filter((explode(',', $request->seats)));
        $pnr_number = getTrx(10);
        $bookedTicket = new ProductBooking();
        $bookedTicket->customer_id = $customer->id;
        $bookedTicket->seats = $seats;
        $bookedTicket->ticket_count = sizeof($seats);
        $bookedTicket->pnr_number = $pnr_number;
        $bookedTicket->status = 0;
        $bookedTicket->save();
        session()->put('pnr_number',$pnr_number);
    }

    public function reviewOrder(Request $request)
    {
        $customer = session('customer');
        $locations = session('bookLocation');

        $perAddr = array(
                $customer->address_1,
                $customer->address_2,
                $customer->postcode,
                $customer->state,
                $customer->city,
                $customer->country,
            );

            $corAddr = Customer::with(['correspondenceAddress', 'contactPersons', 'payments'])
            ->where('id', $customer->id)
            ->get();

            if (!is_null($corAddr)) {
                foreach($corAddr as $k => $addr) {
                    $corrAddr = [
                        $addr->correspondenceAddress->curaddress_1,
                        $addr->correspondenceAddress->curaddress_2,
                        $addr->correspondenceAddress->curpostcode,
                        $addr->correspondenceAddress->curstate,
                        $addr->correspondenceAddress->curcity,
                        $addr->correspondenceAddress->curcountry,
                    ];
                }

                $concat_perAddr = implode(" ", $perAddr);
                $cust_details['per_address'] = $concat_perAddr;

                $concat_corAddr = implode(" ", $corrAddr);
                $cust_details['cor_address'] = $concat_corAddr;
            }

        // $product->load('categories.parentCategory');
        // session(['products' => $product]);

        return view('pages.product.booking-detail', compact('customer', 'cust_details', 'corAddr', 'locations'
        ));
    }

    public function getSection(Request $request)
    {
        $sections = BookingSection::where("lot_layout_id", $request->lot_layout_id)
            ->pluck("name", "id");
        return response()->json($sections);
    }
}
