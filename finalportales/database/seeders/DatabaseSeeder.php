<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        // Ejecutar un seeder especifico
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CountrysSeeder::class);
        $this->call(ProvidersSeeder::class);
        $this->call(GenresSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ProductswithGenresSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(NewswithGenresSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(OrderItemsSeeder::class);
    }
}
