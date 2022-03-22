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
use App\Models\User;
use Carbon\Carbon;
use Alert;

class ProductBookingController extends Controller
{
    public function index(Request $request, $category, $childCategory, $childCategory2, Product $product)
    {
        $product->load('categories.parentCategory');
        $levels = Level::pluck('level_name', 'id')->prepend(trans('Please select level'), '');

        session(['products' => $product]);

        return view('pages.product.booking-lot', compact('product', 'levels'));
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

    // show seat
    public function showSeat($id)
    {
        $product = Product::with(['bookingSection', 'productBooked'])
            ->where('id', $id)
            ->firstOrFail();

        $lotLayout = new LotLayout($product);

        return view('pages.product.booking-lot');
    }

    public function reviewOrder(Request $request, $category, $childCategory, $childCategory2, Product $product)
    {
        $customer = session('customer');
        $searchCust = session('searchCust');
                
        if (!is_null($searchCust)) {
            foreach($searchCust as $sc) {
                $perAddr = [
                    $sc->address_1,
                    $sc->address_2,
                    $sc->postcode,
                    $sc->state,
                    $sc->city,
                    $sc->country,
                ];

                $corAddr = Customer::with(['correspondenceAddress', 'contactPersons'])
                ->where('id', $sc->id)
                ->get();

                foreach ($corAddr as $k => $addr) {
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
        } else {
            $perAddr = array(
                $customer->address_1,
                $customer->address_2,
                $customer->postcode,
                $customer->state,
                $customer->city,
                $customer->country,
            );

            $corAddr = Customer::with(['correspondenceAddress', 'contactPersons'])
            ->where('id', $customer->id)
            ->get();

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

        $product->load('categories.parentCategory');
        session(['products' => $product]);

        return view('pages.product.booking-detail', compact(
            'product', 'customer' ,'searchCust', 'cust_details', 'corAddr'
        ));
    }
}
