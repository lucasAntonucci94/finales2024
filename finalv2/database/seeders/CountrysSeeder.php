<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('countrys')->insert([
            [
                'id_country'=>1,
                'name'=>'Argentina',
                'short_name'=>'ARG',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_country'=>2,
                'name'=>'Estados Unidos',
                'short_name'=>'USA',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_country'=>3,
                'name'=>'Brasil',
                'short_name'=>'BR',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_country'=>4,
                'name'=>'Chile',
                'short_name'=>'CL',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_country'=>5,
                'name'=>'China',
                'short_name'=>'CN',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_country'=>6,
                'name'=>'Colombia',
                'short_name'=>'CO',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id_country'=>7,
                'name'=>'Japon',
                'short_name'=>'JP',
                'created_at'=>now(),
                'updated_at'=>now(),
            ], [
                'id_country'=>8,
                'name'=>'Mexio',
                'short_name'=>'MX',
                'created_at'=>now(),
                'updated_at'=>now(),
            ], [
                'id_country'=>9,
                'name'=>'Australia',
                'short_name'=>'AU',
                'created_at'=>now(),
                'updated_at'=>now(),
            ], [
                'id_country'=>10,
                'name'=>'España',
                'short_name'=>'ES',
                'created_at'=>now(),
                'updated_at'=>now(),
            ], [
                'id_country'=>11,
                'name'=>'uruguay',
                'short_name'=>'UY',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ]);
    }
}
