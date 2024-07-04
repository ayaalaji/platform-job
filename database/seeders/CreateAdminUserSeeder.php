<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' =>Hash::make('12345678'),
            'role'=> ["Admin"],
        ]);
        $user2 = User::create([
            'name'=>'Muna Ali',
            'email'=>'munaali@gmail.com',
            'password'=>Hash::make('11111111'),
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Focal X Agency',
        ]);
        $user3 = User::create([
            'name'=>'Alaa Essa',
            'email'=>'alaaessa@gmail.com',
            'password'=>Hash::make('22222222'),
            'role' => ["Manager"],
            'company_he_belongs_to'=>'INFO Strategic',
        ]);
        $user4 = User::create([
            'name'=>'Ahmad Deeb',
            'email'=>'ahmaddeeb@gmail.com',
            'password'=>Hash::make('33333333'),
            'role' => ["Manager"],
            'company_he_belongs_to'=>'IRAM',
        ]);
        $user5 = User::create([
            'name'=>'Ali Soubh',
            'email'=>'alisoubh@gmail.com',
            'password'=>Hash::make('44444444'),
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Vica',
        ]);
        $user6 = User::create([
            'name'=>'Leen Mohammad',
            'email'=>'leenmohammad@gmail.com',
            'password'=>Hash::make('55555555'),
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Code95',
        ]);
        $user7 = User::create([
            'name'=>'Lubna Ahmad',
            'email'=>'lubnaahmad@gmail.com',
            'password'=>Hash::make('66666666'),
            'role' => ["Manager"],
            'company_he_belongs_to'=>'Idea To Life',
        ]);
        $user8 = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('useruser'),
            'role' => ["User"],
        ]);
    $role = Role::create(['name' => 'Admin']);
    $roleManager = Role::create(['name' => 'Manager']);
    $roleUser = Role::create(['name' => 'User']);
     
        $permissions = Permission::pluck('id','id')->all();
        $permissionsmanager = Permission::whereBetween('id', [25, 38])->pluck('id')->all();
   
        $role->syncPermissions($permissions);
        $roleManager->syncPermissions($permissionsmanager);
     
        $user1->assignRole([$role->id]);
        $user2->assignRole($roleManager->id);
        $user3->assignRole($roleManager->id);
        $user4->assignRole($roleManager->id);
        $user5->assignRole($roleManager->id);
        $user6->assignRole($roleManager->id);
        $user7->assignRole($roleManager->id);
        $user8->assignRole($roleUser->id);
    }
}
