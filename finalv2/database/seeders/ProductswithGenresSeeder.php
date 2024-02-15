<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductswithGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_has_genres')->insert([
            [
                'id_product'=>1,
                'id_genre'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>1,
                'id_genre'=>2,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>2,
                'id_genre'=>5,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>2,
                'id_genre'=>4,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>3,
                'id_genre'=>6,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>3,
                'id_genre'=>9,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>2,
                'id_genre'=>8,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>3,
                'id_genre'=>10,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_product'=>2,
                'id_genre'=>7,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
