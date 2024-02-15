<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('roles')->insert([
            [
                'id_role'=>1,
                'name'=>'Administrador',
                'detail'=>'Role que otorga todos los permisos del sistema.',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],

            [
                'id_role'=>2,
                'name'=>'Usuario',
                'detail'=>'Role asignado a los usuarios del sistema.',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
