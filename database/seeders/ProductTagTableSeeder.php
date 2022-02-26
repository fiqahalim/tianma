<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductTag;

class ProductTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'id'          => 1,
                'name'        => 'Luxury',
                'created_at'  => '2022-02-24 12:49:25',
                'created_at'  => '2022-02-24 12:49:25'
            ],
            [
                'id'          => 2,
                'name'        => 'Premium',
                'created_at'  => '2022-02-24 12:49:25',
                'created_at'  => '2022-02-24 12:49:25'
            ],
            [
                'id'          => 3,
                'name'        => 'Standard',
                'created_at'  => '2022-02-24 12:49:25',
                'created_at'  => '2022-02-24 12:49:25'
            ],
        ];

        ProductTag::insert($tags);
    }
}
