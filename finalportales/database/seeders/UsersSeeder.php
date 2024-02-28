<?php

namespace Database\Seeders;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Lucas Antonucci',
                'email' => 'lucas.e.antonucci@gmail.com',
                'password' => Hash::make('Ab123456'),
                'id_role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Jorge Perez',
                'email' => 'jorge.perez@gmail.com',
                'password' => Hash::make('Ab123456'),
                'id_role' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Nayla Pecorelli',
                'email' => 'nayla.pecorelli@gmail.com',
                'password' => Hash::make('Ab123456'),
                'id_role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Juan Sanches',
                'email' => 'sanches.juan@gmail.com',
                'password' => Hash::make('Ab123456'),
                'id_role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Monica Patricia',
                'email' => 'monic@gmail.com',
                'password' => Hash::make('Ab123456'),
                'id_role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
