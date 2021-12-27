<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Faker\Factory as Faker;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            $category = ProductCategory::create([
                'name'        => ucfirst($faker->word),
                'description' => $faker->paragraph,
                'slug'        => ucfirst($faker->word)
            ]);

            for ($j = 1; $j <= 5; $j++) {
                $childCategory = $category->childCategories()->create([
                    'name'        => $faker->sentence(2),
                    'description' => $faker->paragraph,
                    'slug'        => $faker->sentence(2),
                ]);

                for ($k = 1; $k <= 5; $k++) {
                    $childCategory->childCategories()->create([
                        'name'        => $faker->sentence(3),
                        'description' => $faker->paragraph,
                        'slug'        => $faker->sentence(2),
                    ]);
                }
            }
        }
    }
}
