<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name'=>'Muna Ali',
            'email'=>'munaali@gmail.com',
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Focal X Agency',
            'password'=>Hash::make('11111111'),
        ]  ,

        [
            'name'=>'Alaa Essa',
            'email'=>'alaaessa@gmail.com',
            'role' => ["Manager"],
            'company_he_belongs_to'=>'INFO Strategic',
            'password'=>Hash::make('22222222'),
        ]  ,

        [
            'name'=>'Ahmad Deeb',
            'email'=>'ahmaddeeb@gmail.com',
            'role' => ["Manager"],
            'company_he_belongs_to'=>'IRAM',
            'password'=>Hash::make('33333333'),
        ]    ,

        [
            'name'=>'Ali Soubh',
            'email'=>'alisoubh@gmail.com',
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Vica',
            'password'=>Hash::make('44444444'),
        ]    ,

        [
            'name'=>'Leen Mohammad',
            'email'=>'leenmohammad@gmail.com',
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Code95',
            'password'=>Hash::make('55555555'),
        ]    ,

        [
            'name'=>'Lubna Ahmad',
            'email'=>'lubnaahmad@gmail.com',
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Idea To Life',
            'password'=>Hash::make('66666666'),
        ]    ,
        ]);
       
    }
}
