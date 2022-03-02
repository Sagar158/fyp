<?php

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
        $this->call(UserSeeder::class);
        $this->call(UsertypeSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(RolesSeeder::class);
    }
}
