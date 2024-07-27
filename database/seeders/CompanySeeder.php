<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([ 
            [
                'name' =>  'Focal X Agency',
                'email' => 'focalx@gmail.com',
                'password' => Hash::make('focalx123'),
                'address'=>'Syria-Lattakia',
                'descraption'=>'A Company that works in Programming,Marketing',
                'manager'=>'Muna Ali',
                'manager_phone'=>'0912149768',
                'logo'=>'/images/logos/logo.svg',
                'color'=>'#ff8500',
               
            ],
            [
                'name' =>  'INFO Strategic',
                'email' => 'infostrategic@gmail.com',
                'password' => Hash::make('infostrategic123'),
                'address'=>'Syria-Tartous',
                'descraption'=>'A Company that works in Programming,Graphic Design',
                'manager'=>'Alaa Essa',
                'manager_phone'=>'0966649768',
                'logo'=>'/images/logos/infostrat.png',
                'color'=>'#010610',
               
            ],
            [
                'name' =>  'IRAM',
                'email' => 'iram@gmail.com',
                'password' => Hash::make('iramiram123'),
                'address'=>'Syria-Lattakia',
                'descraption'=>'A Company that works in Programming, Architecture, and Civil Engineering',
                'manager'=>'Ahmad Deeb',
                'manager_phone'=>'0912871542',
                'logo'=>'/images/logos/iramGroup.png',
                'color'=>'#dab26d',
                
            ],
            [
                'name' =>  'Vica',
                'email' => 'vicaweb@gmail.com',
                'password' => Hash::make('vicaweb123'),
                'address'=>'Syria-Damascus',
                'descraption'=>'A Company that works in Programming',
                'manager'=>'Ali Soubh',
                'manager_phone'=>'0912111542',
                'logo'=>'/images/logos/vica.svg',
                'color'=>'#ffffff',
                
            ],
            [
                'name' =>  'Code95',
                'email' => 'code95@gmail.com',
                'password' => Hash::make('code95123'),
                'address'=>'Syria-Damascus',
                'descraption'=>'A Company that works in Programming',
                'manager'=>'Leen Mohammad',
                'manager_phone'=>'0912142942',
                'logo'=>'/images/logos/code95.png',
                'color'=>'#252525',
               
            ],
            [
                'name' =>  'Idea To Life',
                'email' => 'ideatolife@gmail.com',
                'password' => Hash::make('ideatolife'),
                'address'=>'Syria-Damascus',
                'descraption'=>'A Company that works in Programming',
                'manager'=>'Lubna Ahmad',
                'manager_phone'=>'0912149768',
                'logo'=>'/images/logos/ideatolife.svg',
                'color'=>'#041d3c',
               
            ]
            
        ]);
    }
}
