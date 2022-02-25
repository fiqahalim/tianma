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
                'ranking_id'         => 1,
            ],
        ];

        User::insert($users);
    }
}
