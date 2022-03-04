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
use App\Models\User;
use Carbon\Carbon;
use Alert;

class ProductBookingController extends Controller
{
    public function index()
    {

    }

    // save booking
    public function productBooked(Request $request, $id)
    {
        $customer = session('customer');

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

    public function reviewOrder(Request $request, $category, $childCategory, $childCategory2, Product $product)
    {
        $customer = session('customer');
        $searchCust = session('searchCust');

        $product->load('categories.parentCategory');
        session(['products' => $product]);

        return view('pages.product.booking-detail', compact('product', 'customer' ,'searchCust'));
    }
}
