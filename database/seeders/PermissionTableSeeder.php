<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'المستخدمين',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',

            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',


            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',

            'إدارة طلبات التوظيف',
            'طلبات التوظيف',
            
            
            'رؤية كل الاعمال',
            'رؤية المقالات',
            'رؤية البوستات',
            
            
            'التعليقات',
            'ادارة التعليقات',
            'اضافة تعليق',
            'تعديل تعليق',
            'حذف تعليق',
            
            'الشركات',
            'ادارة الشركات',
            'اضافة شركة',
            'تعديل شركة',
            'حذف شركة',
            'استعادة شركة',

           'البوستات',
           'ادارة البوستات',
           'اضافة بوست',
           'تعديل بوست',
           'حذف بوست',
           'استعادة بوست',

           'المقالات',
           'ادارة المقالات',
           'اضافة مقالة',
           'تعديل مقالة',
           'حذف مقالة',
           'استعادة مقالة',
           
           'الاطلاع على طلبات التوظيف',
           'قبول او رفض طلب توظيف',
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    
    }
}
