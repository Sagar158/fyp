<?php

use Illuminate\Database\Seeder;
use App\Models\Promotions;
class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    ['name' => 'Meeting', 'created_by' => 1],
                    ['name' => 'Business Promotion', 'created_by' => 1],
                    ['name' => 'Business Product Launching', 'created_by' => 1],
                    ['name' => 'Business Software Launching', 'created_by' => 1],
                    ['name' => 'Business Branch Opening', 'created_by' => 1],
                    ['name' => 'Task Management', 'created_by' => 1]
                ];
        Promotions::insert($data);
    }
}
