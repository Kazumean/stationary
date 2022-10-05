<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('Orders')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'customer_id' => 1,
                'stationary_id' => 1,
                'quantity' => 5,
                'status' => 0,
                'user_id' => 1
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'customer_id' => 2,
                'stationary_id' => 2,
                'quantity' => 8,
                'status' => 0,
                'user_id' => 2
            ],
        ]);
    }
}
