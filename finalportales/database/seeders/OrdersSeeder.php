<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id_user' => 1,
                'status' => 'pago',
                'enabled' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'status' => 'pago',
                'enabled' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'status' => 'pendiente',
                'enabled' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'status' => 'pago',
                'enabled' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'status' => 'pago',
                'enabled' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'status' => 'pago',
                'enabled' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... (puedes agregar más datos aquí)
        ]);
    }
}
