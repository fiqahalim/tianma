<?php

namespace App\Http\View\Composers;

use App\Models\ProductCategory;
use Illuminate\View\View;

class ProductPageComposer
{
    private $frontCategories;

    public function __construct()
    {
        $this->frontCategories = cache()->remember('frontCategories', 3600, function () {
            return ProductCategory::whereNull('category_id')
                ->with(['childCategories' => function ($query) {
                    $query->withCount('products');
                }, 'childCategories.products'])
                ->get();
            });

        foreach ($this->frontCategories as $parentCategory) {
            foreach($parentCategory->childCategories as $category) {
                $category->products_count = $category->products->count();
            }
            $parentCategory->products_count = $parentCategory->childCategories->sum('products_count');
        }
    }

    public function compose(View $view)
    {
        $view->with('frontCategories', $this->frontCategories);
    }
}
