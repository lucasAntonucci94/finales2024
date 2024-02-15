<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            [
                'id_provider'=>1,
                'name'=>'IVREA',
                'location'=>'Argentina',
                'phone'=>'+541125337744',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
              [
                'id_provider'=>2,
                'name'=>'PANINI',
                'location'=>'Italia',
                'phone'=>'+541125337744',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],   [
                'id_provider'=>3,
                'name'=>'SEKAI EDITORIAL',
                'location'=>'España',
                'phone'=>'+541125337744',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],   [
                'id_provider'=>4,
                'name'=>'MANGALINE',
                'location'=>'España',
                'phone'=>'+541125337744',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
