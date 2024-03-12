<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'rol_id'=>1,
                'name'=>'SuperAdmin',
                'usu_nombres'=>'Nayeli',
                'usu_telefono'=>'0999999999',
                'email'=>'naye@gmail.com',
                'password'=>bcrypt('123456789')
            ]
        );
        DB::table('users')->insert(
            [
                'rol_id'=>1,
                'name'=>'Paul',
                'usu_nombres'=>'Paul',
                'usu_telefono'=>'0999999999',
                'email'=>'paul@gmail.com',
                'password'=>bcrypt('123456789')
            ]
        );
    }
}