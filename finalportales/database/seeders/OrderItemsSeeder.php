<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 1,
                'id_product' => 1,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'id_product' => 3,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'id_product' => 2,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'order_id' => 2,
                'id_product' => 1,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'id_product' => 3,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'id_product' => 2,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'order_id' => 4,
                'id_product' => 1,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4,
                'id_product' => 13,
                'quantity' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 5,
                'id_product' => 12,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'order_id' => 5,
                'id_product' => 5,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 6,
                'id_product' => 3,
                'quantity' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 6,
                'id_product' => 12,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
