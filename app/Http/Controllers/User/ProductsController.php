<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('categories.parentCategory.parentCategory')
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
            ->with('categories.parentCategory.parentCategory')
            ->paginate(9);
            
        return view('pages.product.index', compact('products', 'selectedCategories'));
    }

    public function productCategory($category, $childCategory, $childCategory2, $productSlug, Product $product)
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

        return view('pages.product.booking-lot', compact('product', 'selectedCategories'));
    }
}
