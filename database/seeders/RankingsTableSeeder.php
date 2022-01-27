<?php

namespace Database\Seeders;

use App\Models\Ranking;
use Illuminate\Database\Seeder;

class RankingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rankings = [
            [
                'id'        => 1,
                'position'  => 'SD',
                'category'  => null,
            ],
            [
                'id'    => 2,
                'position' => 'DSD',
                'category'  => null,
            ],
            [
                'id'    => 3,
                'position' => 'BDD_A',
                'category'  => 'A',
            ],
            [
                'id'    => 4,
                'position' => 'BDD_B',
                'category'  => 'B',
            ],
            [
                'id'    => 5,
                'position' => 'CBDD',
                'category'  => null,
            ],
        ];

        Ranking::insert($rankings);
    }
}
