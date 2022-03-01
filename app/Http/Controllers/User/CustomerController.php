<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index($category, $childCategory, $childCategory2, Product $product)
    {
        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();

        $product->load('categories.parentCategory');
        $childCategory2 = $product->categories->where('name', $childCategory2)->first();
        $selectedCategories = [];

        if ($childCategory2 &&
            $childCategory2->parentCategory &&
            $childCategory2->parentCategory->parentCategory
        ) {
            $selectedCategories = [
                $childCategory2->parentCategory->parentCategory->id ?? null,
                $childCategory2->parentCategory->id ?? null,
                $childCategory2->id
            ];
        }

        return view('pages.customer.customer-detail', compact('product', 'selectedCategories', 'users'));
    }

    public function store(Request $reqs, UpdateCustomerRequest $request, $category, $childCategory, $childCategory2, Product $product)
    {
        /**
         * Check if customer exists or not
         */
        $customer = Customer::where('id_number', '=', $request->input('id_number'))->first();

        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();


        $product->load('categories.parentCategory');
        $childCategory2 = $product->categories->where('name', $childCategory2)->first();
        $selectedCategories = [];

        if ($childCategory2 &&
            $childCategory2->parentCategory &&
            $childCategory2->parentCategory->parentCategory
        ) {
            $selectedCategories = [
                $childCategory2->parentCategory->parentCategory->id ?? null,
                $childCategory2->parentCategory->id ?? null,
                $childCategory2->id
            ];
        }

        if ($customer !== null) {
            $customer->update($request->all());
        } else {
            $customer = null;
            $customer = new Customer;
            $customer->full_name = $reqs->full_name;
            $customer->id_type = $reqs->id_type;
            $customer->id_number = $reqs->id_number;
            $customer->email = $reqs->email;
            $customer->contact_person_name = $reqs->contact_person_name;
            $customer->contact_person_no = $reqs->contact_person_no;
            $customer->postcode = $reqs->postcode;
            $customer->state = $reqs->state;
            $customer->city = $reqs->city;
            $customer->address_1 = $reqs->address_1;
            $customer->address_2 = $reqs->address_2;
            $customer->nationality = $reqs->nationality;
            $customer->country = $reqs->country;
            $customer->mode = $reqs->mode;
            $customer->created_by = $reqs->created_by;
            $customer->created_at = $current = Carbon::now();
            $customer->updated_at = $current = Carbon::now();
            $customer->save();
        }

        session(['customer' => $customer]);

        return view('pages.product.booking-detail', compact('product', 'selectedCategories', 'customer', 'users'));
    }
}
