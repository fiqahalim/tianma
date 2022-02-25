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
    public function index($category, $childCategory, $childCategory2, $productSlug, Product $product)
    {
        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();

        $product->load('categories.parentCategory.parentCategory');
        $childCategory2 = $product->categories->where('slug', $childCategory2)->first();
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

    public function store(UpdateCustomerRequest $request, $category, $childCategory, $childCategory2, $productSlug, Product $product)
    {
        /**
         * Check if customer exists or not
         */
        $customer = Customer::where('id_number', '=', $request->input('id_number'))->first();

        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();

        if ($customer !== null) {
            $customer->update($request->all());
        } else {
            $customer = null;
            $customer = new Customer;
            $customer->full_name = $request->full_name;
            $customer->id_type = $request->id_type;
            $customer->id_number = $request->id_number;
            $customer->email = $request->email;
            $customer->contact_person_name = $request->contact_person_name;
            $customer->contact_person_no = $request->contact_person_no;
            $customer->postcode = $request->postcode;
            $customer->state = $request->state;
            $customer->city = $request->city;
            $customer->address_1 = $request->address_1;
            $customer->address_2 = $request->address_2;
            $customer->nationality = $request->nationality;
            $customer->country = $request->country;
            $customer->mode = $request->mode;
            $customer->created_by = $request->created_by;
            $customer->created_at = $current = Carbon::now();
            $customer->updated_at = $current = Carbon::now();
            $customer->save();
        }

        $product->load('categories.parentCategory.parentCategory');
        $childCategory2 = $product->categories->where('slug', $childCategory2)->first();
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

        session(['customer' => $customer]);

        return view('pages.product.booking-detail', compact('product', 'selectedCategories', 'customer', 'users'));
    }
}
