<?php

use Illuminate\Database\Seeder;
use App\Models\Roles;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    ['usertypeId' => 1 ],
                    ['usertypeId' => 2 ],
                    ['usertypeId' => 2 ],
                ];

        Roles::insert($data);

    }
}
