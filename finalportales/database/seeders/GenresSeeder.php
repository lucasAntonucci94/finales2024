<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('genres')->insert([
            [
                'id_genre'=>1,
                'name'=>'Aventuras',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],

            [
                'id_genre'=>2,
                'name'=>'Acción',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],

            [
                'id_genre'=>3,
                'name'=>'Ciencia Ficción',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],

            [
                'id_genre'=>4,
                'name'=>'Deportes',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],

            [
                'id_genre'=>5,
                'name'=>'Fantasia',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>6,
                'name'=>'Comedia',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>7,
                'name'=>'Romance',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>8,
                'name'=>'Shonen',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>9,
                'name'=>'Artes Marciales',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>10,
                'name'=>'Demonios',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>11,
                'name'=>'Samurai',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>12,
                'name'=>'Terror',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>13,
                'name'=>'Suspenso',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_genre'=>14,
                'name'=>'Infantil',
                'detail'=>'Lorem Ipsum',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
