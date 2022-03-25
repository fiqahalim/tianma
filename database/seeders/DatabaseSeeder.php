<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RankingsTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            ProductTagTableSeeder::class,
            CategorySeeder::class,
            // ProductCategoriesTableSeeder::class,
        ]);
    }
}
