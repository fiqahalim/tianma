<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Lib\LotLayout;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\BookLocation;
use App\Models\Location;
use App\Models\ProductType;
use App\Models\BuildingType;
use App\Models\Level;
use Carbon\Carbon;
use Alert;

class ProductOrderController extends Controller
{
    public function index()
    {
        $locations = session('bookLocation');

        $products = Product::with('categories.parentCategory')
            ->inRandomOrder()
            ->take(9)
            ->get();

        return view('pages.product.index', compact('products'));
    }

    public function category(ProductCategory $category, ProductCategory $childCategory = null, $childCategory2 = null)
    {
        $products = null;
        $ids = collect();
        $selectedCategories = [];

        if ($childCategory2) {
            $subCategory = $childCategory->childCategories()->where('name', $childCategory2)->firstOrFail();
            $ids = collect($subCategory->id);
            $selectedCategories = [$category->id, $childCategory->id, $subCategory->id];
        } elseif ($childCategory) {
            $ids = $childCategory->pluck('id');
            $selectedCategories = [$category->id];
        } elseif ($category) {
            $category->load('childCategories');
            $ids = collect();
            $selectedCategories[] = $category->id;

            foreach ($category->childCategories as $subCategory) {
                $ids = $ids->merge($subCategory->pluck('id'));
            }
        }

        $products = Product::whereHas('categories', function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            })
            ->with('categories.parentCategory.parentCategory')
            ->paginate(9);

        return view('pages.product.display', compact('products', 'selectedCategories'));
    }

    public function productCategory($category, $childCategory, $childCategory2, Product $product)
    {
        $product->load('categories.parentCategory.parentCategory');
        $childCategory = $product->categories->where('name', $childCategory)->first();
        $selectedCategories = [];

        if ($childCategory &&
            $childCategory->parentCategory &&
            $childCategory->parentCategory->parentCategory
        ) {
            $selectedCategories = [
                $childCategory->parentCategory->parentCategory->id ?? null,
                $childCategory->parentCategory->id ?? null,
                $childCategory->id
            ];
        }

        session(['products' => $product]);

        return view('pages.product.index', compact('product', 'selectedCategories'));
    }

    public function location()
    {
        $locations = Location::pluck('location_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $properties = ProductType::pluck('property_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $buildings = BuildingType::pluck('building_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $levels = Level::pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $category = ProductCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('pages.product.location', compact('locations', 'properties', 'buildings', 'levels', 'category'));
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

        return redirect()->route('admin.product-booking.index');
        // return view('pages.product.booking-lot', compact('bookLocation'));
    }

    public function addOns(Request $request)
    {
        return view('pages.cart.addon');
    }
}
