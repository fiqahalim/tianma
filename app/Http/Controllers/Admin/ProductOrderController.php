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
            $ids = $childCategory->childCategories->pluck('id');
            $selectedCategories = [$category->id, $childCategory->id];
        } elseif ($category) {
            $category->load('childCategories.childCategories');
            $ids = collect();
            $selectedCategories[] = $category->id;

            foreach ($category->childCategories as $subCategory) {
                $ids = $ids->merge($subCategory->childCategories->pluck('id'));
            }
        }

        $products = Product::whereHas('categories', function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            })
            ->with('categories.parentCategory')
            ->paginate(9);

        return view('pages.product.index', compact('products', 'selectedCategories'));
    }

    public function productCategory($category, $childCategory, $childCategory2, Product $product)
    {
        $product->load('categories.parentCategory.parentCategory');
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

        session(['products' => $product]);

        return view('pages.product.index', compact('product', 'selectedCategories'));
    }

    public function location()
    {
        $locations = Location::pluck('location_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $properties = ProductType::pluck('property_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $buildings = BuildingType::pluck('building_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $levels = Level::pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('pages.product.location', compact('locations', 'properties', 'buildings', 'levels'));
    }

    public function store(Request $request)
    {
        $bookLocation = null;
        $bookLocation = new BookLocation;
        $bookLocation->location = $request->location_name;
        $bookLocation->product_type = $request->property_name;
        $bookLocation->build_type = $request->building_name;
        $bookLocation->level = $request->level_name;
        $bookLocation->save();

        session(['bookLocation' => $bookLocation]);

        return redirect()->route('admin.new-order.index');
    }

    public function addOns(Request $request)
    {
        return view('pages.cart.addon');
    }
}
