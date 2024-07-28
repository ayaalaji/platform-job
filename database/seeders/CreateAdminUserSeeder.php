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
            'email' => 'alajiaya27@gmail.com',
            'password' =>Hash::make('#aya#yasser%123'),
            'role'=> ["Admin"],
        ]);
        $user2 = User::create([
            'name'=>'Muna Ali',
            'email'=>'munaali@gmail.com',
            'password'=>Hash::make('11111111'),
            'role' => ["Manager"],
            'company_id'=>1,
            
        ]);
        $user3 = User::create([
            'name'=>'Alaa Essa',
            'email'=>'alaaessa@gmail.com',
            'password'=>Hash::make('22222222'),
            'role' => ["Manager"],
            'company_id'=>2,
            
        ]);
        $user4 = User::create([
            'name'=>'Ahmad Deeb',
            'email'=>'ahmaddeeb@gmail.com',
            'password'=>Hash::make('33333333'),
            'role' => ["Manager"],
            'company_id'=>3,
            
        ]);
        $user5 = User::create([
            'name'=>'Ali Soubh',
            'email'=>'alisoubh@gmail.com',
            'password'=>Hash::make('44444444'),
            'role' => ["Manager"],
            'company_id'=>4,
            
        ]);
        $user6 = User::create([
            'name'=>'Leen Mohammad',
            'email'=>'leenmohammad@gmail.com',
            'password'=>Hash::make('55555555'),
            'role' => ["Manager"],
            'company_id'=>5,
           
        ]);
        $user7 = User::create([
            'name'=>'Lubna Ahmad',
            'email'=>'lubnaahmad@gmail.com',
            'password'=>Hash::make('66666666'),
            'role' => ["Manager"],
            'company_id'=>6,
            
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
        
        $excludedPermissions = [13, 14, 15, 18, 19, 20, 29, 30, 31, 32,35, 36, 37, 38, 40, 41];

// تصفية الصلاحيات للحصول على الصلاحيات المسموحة فقط
$adminPermissions = array_diff($permissions, $excludedPermissions);


        $permissionsmanager = Permission::whereBetween('id', [27, 41])->pluck('id')->all();
   
        $role->syncPermissions($adminPermissions);
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
