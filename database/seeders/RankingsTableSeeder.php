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
                'category'  => 'SD',
            ],
            [
                'id'    => 2,
                'position' => 'DSD',
                'category'  => 'DSD',
            ],
            [
                'id'    => 3,
                'position' => 'BDD_A',
                'category'  => 'BDD A',
            ],
            [
                'id'    => 4,
                'position' => 'BDD_B',
                'category'  => 'BDD B',
            ],
            [
                'id'    => 5,
                'position' => 'CBDD',
                'category'  => 'CBDD',
            ],
        ];

        Ranking::insert($rankings);
    }
}
