<?php

use Illuminate\Database\Seeder;
use App\Models\Companies;
class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    ['name' => 'Alkaram', 'user_id' => 2, 'created_by' => 1],
                    ['name' => 'Outfiters', 'user_id' => 2, 'created_by' => 1],
                    ['name' => 'Ideas', 'user_id' => 2, 'created_by' => 1],
                    ['name' => 'J.', 'user_id' => 2, 'created_by' => 1],
                ];
        Companies::insert($data);
    }
}
