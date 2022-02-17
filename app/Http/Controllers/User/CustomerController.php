<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\ProductCategory;

class CustomerController extends Controller
{
    public function index($category, $childCategory, $childCategory2, $productSlug, Product $product)
    {
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

        return view('pages.customer.customer-detail', compact('product', 'selectedCategories'));
    }

    public function store(StoreCustomerRequest $request, $category, $childCategory, $childCategory2, $productSlug, Product $product)
    {
        /**
         * Check if customer exists or not
         */
        $customer = Customer::where('id_number', '=', $request->input('id_number'))->first();

        if ($customer !== null) {
            $customer->update($request->all());
        } else {
            $customer = Customer::create($request->all());
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

        return view('pages.product.booking-detail', compact('product', 'selectedCategories', 'customer'));
    }
}
