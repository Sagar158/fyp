<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    [
                        'email' => 'admin@iqra.com',
                        'password' => bcrypt('test123'),
                        'name' => 'admin',
                        'usertype_id' => 1,
                        'mobile' =>  '03351257417',
                    ],
                    [
                        'email' => 'waheed.39028@iqra.edu.pk',
                        'password' => bcrypt('test123'),
                        'name' => 'Waheed',
                        'usertype_id' => 2,
                        'mobile' =>  '03472507207',
                    ],
                    [
                        'email' => 'zain.43060@iqra.edu.pk',
                        'password' => bcrypt('test123'),
                        'name' => 'Zain',
                        'usertype_id' => 2,
                        'mobile' =>  '03213222673',
                    ],

                ];

        Users::insert($data);
    }
}
