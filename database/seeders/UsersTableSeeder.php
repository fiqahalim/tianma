<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2021-12-27 06:10:57',
                'id_type'            => 'NRIC',
                'id_number'          => '770707-71-7777',
                'username'           => 'admin001',
                'contact_no'         => '60123456789',
                'agent_code'         => 'ADM0001',
                'verification_token' => '',
                'address_1'          => 'No. 77, Taman Perdana Utama',
                'address_2'          => 'Jalan 12/2J, Seksyen 14',
                'state'              => 'Selangor',
                'city'               => 'Setia Alam',
                'postcode'           => '50100',
                'country'            => 'Malaysia',
                'nationality'        => 'MALAYSIAN',
                'created_at'         => '2021-12-25 13:30:27',
                'ranking_id'         => 5,
            ],
            [
                'id'                 => 2,
                'name'               => 'Agent Kenji',
                'email'              => 'agent@agent.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2021-12-27 06:10:57',
                'id_type'            => 'Passport',
                'id_number'          => 'JPN098765',
                'username'           => 'agent001',
                'contact_no'         => '60123456789',
                'agent_code'         => 'AGT1010',
                'verification_token' => '',
                'address_1'          => 'No. 403, Cornelia Streets',
                'address_2'          => 'Greenwich Village',
                'state'              => 'New York',
                'city'               => 'New Rochelle',
                'postcode'           => '50100',
                'country'            => 'USA',
                'nationality'        => 'USA',
                'created_at'         => '2021-12-25 13:43:15'
                'ranking_id'         => 1,
            ],
        ];

        User::insert($users);
    }
}
