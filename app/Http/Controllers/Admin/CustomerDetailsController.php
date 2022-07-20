<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\Customer;
use App\Models\ContactPerson;
use App\Models\PaymentMode;
use App\Models\CorresspondenceAddress;
use Carbon\Carbon;
use Alert;

class CustomerDetailsController extends Controller
{
    public function index($category, $childCategory, $childCategory2, Product $product)
    {
        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();

        $product->load('categories.parentCategory');
        session(['products' => $product]);

        return view('pages.customer.customer-detail', compact('product', 'users'));
    }

    public function store(Request $request, $category, $childCategory, $childCategory2, Product $product)
    {
        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();

        $product->load('categories.parentCategory');
        session(['products' => $product]);

        $validated = $request->validate([
            'full_name' => 'required',
            'id_number' => 'required|unique:customers',
            'email' => 'required|unique:customers',
            'mobile' => 'required|numeric',
            'gender' => 'required',
            'postcode' => 'required',
            'contact_person_name' => 'required',
            'contact_person_no' => 'required|numeric',
            'cperson_id_number' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address_1' => 'required',
            'mode' => 'required',
            'created_by' => 'required',
            'payment_name' => 'required',
        ]);

        $customer = Customer::where('id_number', '=', $request->input('id_number'))->first();

        if ($customer === null) {
            $customer = new Customer();
            $customer->full_name = $request->full_name;
            $customer->id_type = $request->id_type;
            $customer->id_number = $request->id_number;
            $customer->email = $request->email;
            $customer->mobile = $request->mobile;
            $customer->gender = $request->gender;
            $customer->contact_person_name = $request->contact_person_name;
            $customer->contact_person_no = $request->contact_person_no;
            $customer->cperson_id_number = $request->cperson_id_number;
            $customer->postcode = $request->postcode;
            $customer->state = $request->state;
            $customer->city = $request->city;
            $customer->address_1 = $request->address_1;
            $customer->address_2 = $request->address_2;
            $customer->nationality = $request->nationality;
            $customer->country = $request->country;
            $customer->mode = $request->mode;
            $customer->created_by = $request->created_by;
            $customer->save();

            // save intended user
            foreach ($request->addMoreInputFields as $key => $value) {
                ContactPerson::create([
                    'customer_id' => $customer->id,
                    'cperson_name' => $value['cperson_name'],
                    'cid_number' => $value['cid_number'],
                    'relationships' => $value['relationships']
                ]);
            }

            // save correspondence address
            $curAddr = null;
            $curAddr = new CorresspondenceAddress();
            $curAddr->curpostcode = $request->curpostcode;
            $curAddr->curstate = $request->curstate;
            $curAddr->curcity = $request->curcity;
            $curAddr->curaddress_1 = $request->curaddress_1;
            $curAddr->curaddress_2 = $request->curaddress_2;
            $curAddr->curnationality = $request->curnationality;
            $curAddr->curcountry = $request->curcountry;
            $curAddr->customer_id = $customer->id;
            $curAddr->save();

            // save payments
            $payments = null;
            $payments = new PaymentMode();
            $payments->payment_name = $request->payment_name;
            $payments->customer_id = $customer->id;
            $payments->save();
        } else {
            $customer->update(
                ['full_name' => request('full_name')],
                ['id_type' => request('id_type')],
                ['id_number' => request('id_number')],
                ['email' => request('email')],
                ['mobile' => request('mobile')],
                ['gender' => request('gender')],
                ['contact_person_name' => request('contact_person_name')],
                ['contact_person_no' => request('contact_person_no')],
                ['cperson_id_number' => request('cperson_id_number')],
                ['postcode' => request('postcode')],
                ['state' => request('state')],
                ['city' => request('city')],
                ['address_1' => request('address_1')],
                ['address_2' => request('address_2')],
                ['nationality' => request('nationality')],
                ['country' => request('country')],
                ['mode' => request('mode')],
                ['created_by' => request('created_by')]
            );
        }

        session(['customer' => $customer]);

        return redirect()->route('admin.reviewOrder', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]);
    }

    public function searchCustomer(Request $request, $category, $childCategory, $childCategory2, Product $product)
    {
        $query = $request->input('query');


        $searchCust = Customer::where('id_number', 'like', "%$query")
            ->get();

        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();

        $product->load('categories.parentCategory');

        if (count($searchCust) > 0) {
            session(['searchCust' => $searchCust]);

            $corAddr = Customer::with(['correspondenceAddress', 'contactPersons'])
            ->where('id', $searchCust[0]->id)
            ->get();
            
            alert()->info(__('Record found! This is returning purchaser'))->toToast();
            return view('pages.customer.customer-update', compact('product', 'users', 'searchCust', 'corAddr'));
        } else {
            alert()->info(__('No records found. This is new purchaser!'))->toToast();
            return view('pages.customer.customer-detail', compact('product', 'users'));
        }

    }
}
