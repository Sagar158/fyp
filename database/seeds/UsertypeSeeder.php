<?php

use Illuminate\Database\Seeder;
use App\Models\Usertype;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
                    ['type' => 'admin','name' => 'Admin', 'created_by' => 1],
                    ['type' => 'business_person' , 'name' => 'Business Person', 'created_by' => 1],
                    ['type' => 'employee','name' => 'Employee', 'created_by' => 1],
                ];

        Usertype::insert($data);

    }
}
