<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PlansTableSeeder::class,
            TenantsTableSeeder::class,
            UsersTableSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
        // \App\Models\Plan::factory(5)->create();
    }
}
