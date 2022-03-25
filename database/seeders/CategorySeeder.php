<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id'    => 1,
                'name' => 'Luxury',
            ],
            [
                'id'    => 2,
                'name' => 'Premium',
            ],
            [
                'id'    => 3,
                'name' => 'Standard',
            ],
        ];

        ProductCategory::insert($categories);
    }
}
